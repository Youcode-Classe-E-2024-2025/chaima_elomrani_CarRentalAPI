<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use Carbon\Carbon;


class PaymentController extends Controller
{
    public function __construct()
    {
        if (!config('services.stripe.secret')) {
            throw new \Exception('Stripe API key not configured. Please check your .env file.');
        }
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * @OA\Post(
     *     path="/api/payments/{rentalId}",
     *     summary="Créer un Payment Intent pour une location",
     *     tags={"Payments"},
     *     @OA\Parameter(
     *         name="rentalId",
     *         in="path",
     *         required=true,
     *         description="L'ID de la location",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Payment Intent créé avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="client_secret", type="string", example="pi_123456_secret_abc"),
     *             @OA\Property(property="rental_id", type="integer", example=1),
     *             @OA\Property(property="daily_price", type="number", example=150.00),
     *             @OA\Property(property="publishable_key", type="string", example="pk_test_123456"),
     *             @OA\Property(property="message", type="string", example="Payment intent created successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erreur de validation",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Invalid rental period")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="An error occurred while processing your payment")
     *         )
     *     )
     * )
     */

    public function createPaymentIntent($rentalId)
    {
        try {
            $rental = Rental::findOrFail($rentalId);
            $car = Car::findOrFail($rental->car_id); // Assuming 'cars' table has 'daily_price'
    
            if (!$rental->rental_date || !$rental->return_date) {
                return response()->json(['error' => 'Invalid rental period'], 400);
            }
    
            // Calculate rental days
            $rentalDays = Carbon::parse($rental->rental_date)->diffInDays(Carbon::parse($rental->return_date));
            $rentalDays = max($rentalDays, 1); // Ensure at least 1-day charge
    
            // Calculate total price
            $price = $rentalDays * $car->daily_price;
    
            if (!is_numeric($price) || $price <= 0) {
                return response()->json(['error' => 'Invalid rental price - price must be a positive number'], 400);
            }
    
            // Convert price to cents for Stripe
            $stripeAmount = (int)($price * 100);
    
            // **Ensure minimum charge of 50 cents (Stripe USD limit)**
            if ($stripeAmount < 50) {
                $stripeAmount = 50; // Set to minimum allowed
            }
    
            // Create Stripe Payment Intent
            $paymentIntent = PaymentIntent::create([
                'amount' => $stripeAmount, 
                'currency' => 'usd',
                'metadata' => ['rental_id' => $rental->id]
            ]);
    
            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'rental_id' => $rental->id,
                'total_price' => $price,
                'publishable_key' => config('services.stripe.key'),
                'message' => 'Payment intent created successfully'
            ]);
        } catch (ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your payment'], 500);
        }
    }
    

}