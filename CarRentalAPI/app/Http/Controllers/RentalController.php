<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
       /**
     * @OA\Get(
     *     path="/api/rentals",
     *     summary="Display a listing of rentals",
     *     tags={"rentals"},
     *     @OA\Response(response="200", description="Display a listing of rentals")
     * )
     */
    public function index()
    {
        return Rental::all();
    }

     /**
     * @OA\Post(
     *     path="/api/rentals",
     *     summary="Store a newly created rental",
     *     tags={"rentals"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "car_id", "start_date", "end_date"},
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="car_id", type="integer"),
     *             @OA\Property(property="start_date", type="string"),
     *             @OA\Property(property="end_date", type="string")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Rental created successfully")
     * )
     */
    public function store(Request $request)
    {
        return Rental::create($request->all());
    }

        /**
     * @OA\Get(
     *     path="/api/rentals/{id}",
     *     summary="Display the specified rental",
     *     tags={"rentals"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Display the specified rental")
     * )
     */
    public function show(Rental $rental)
    {
        return $rental;
    }

   /**
     * @OA\Put(
     *     path="/api/rentals/{id}",
     *     summary="Update the specified rental",
     *     tags={"rentals"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "car_id", "start_date", "end_date"},
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="car_id", type="integer"),
     *             @OA\Property(property="start_date", type="string"),
     *             @OA\Property(property="end_date", type="string")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Rental updated successfully")
     * )
     */
    public function update(Request $request, string $id)
    {
        $rentals = Rental::update($request->all());
        return $rentals;
    }

  /**
     * @OA\Delete(
     *     path="/api/rentals/{id}",
     *     summary="Remove the specified rental",
     *     tags={"rentals"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Rental deleted successfully")
     * )
     */
    public function destroy(Rental $rentals)
    {
        $rentals->delete();
        return response()->noContent();
    }

    
}
