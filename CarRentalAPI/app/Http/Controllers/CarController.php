<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      title="Car Rental API",
 *      version="1.0.0",
 *      description="Documentation de l'API de location de voitures"
 * )
 * 
 * @OA\Tag(
 *     name="Cars",
 *     description="Gestion des voitures"
 * )
 */

class CarController extends Controller
{

    /**
     * @OA\Get(
     *     path="/cars",
     *     summary="Afficher toutes les voitures",
     *     tags={"Cars"},
     *     @OA\Response(
     *         response=200,
     *         description="Liste des voitures",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Car"))
     *     )
     * )
     */

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Car::all();
    }


/**
     * @OA\Post(
     *     path="/cars",
     *     summary="Ajouter une nouvelle voiture",
     *     tags={"Cars"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Car")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Voiture ajoutée avec succès"
     *     )
     * )
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Car::create($request->all());
    }

 /**
     * @OA\Get(
     *     path="/cars/{id}",
     *     summary="Afficher une voiture spécifique",
     *     tags={"Cars"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails de la voiture",
     *         @OA\JsonContent(ref="#/components/schemas/Car")
     *     )
     * )
     */

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return $car;
    }


    /**
     * @OA\Put(
     *     path="/cars/{id}",
     *     summary="Mettre à jour une voiture",
     *     tags={"Cars"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Car")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Voiture mise à jour avec succès"
     *     )
     * )
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cars = Car::update($request->all());
        return $cars;
    }


       /**
     * @OA\Delete(
     *     path="/cars/{id}",
     *     summary="Supprimer une voiture",
     *     tags={"Cars"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Voiture supprimée avec succès"
     *     )
     * )
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $cars)
    {
        $cars->delete();
        return response()->noContent();
    }
}

/**
 * @OA\Schema(
 *     schema="Car",
 *     type="object",
 *     required={"model", "brand", "daily_price"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="model", type="string", example="Tesla Model 3"),
 *     @OA\Property(property="brand", type="string", example="Tesla"),
 *     @OA\Property(property="daily_price", type="number", format="float", example=99.99),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
