<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;



class CarController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/cars",
     *     summary="Display a listing of cars",
     *     tags={"cars"},
     *     @OA\Response(response="200", description="Display a listing of cars")
     * )
     */
    public function index()
    {
        return Car::paginate(10);
    }


  /**
     * @OA\Post(
     *     path="/api/cars",
     *     summary="Store a newly created car",
     *     tags={"cars"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"mark", "model", "color", "price", "year"},
     *             @OA\Property(property="mark", type="string"),
     *             @OA\Property(property="model", type="string"),
     *             @OA\Property(property="color", type="string"),
     *             @OA\Property(property="price", type="number"),
     *             @OA\Property(property="year", type="integer")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Car created successfully")
     * )
     */
    public function store(Request $request)
    {
        return Car::create($request->all());
    }

 /**
     * @OA\Get(
     *     path="/api/cars/{id}",
     *     summary="Display the specified car",
     *     tags={"cars"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Display the specified car")
     * )
     */
    public function show(Car $car)
    {
        return $car;
    }


   /**
     * @OA\Put(
     *     path="/api/cars/{id}",
     *     summary="Update the specified car",
     *     tags={"cars"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="mark", type="string"),
     *             @OA\Property(property="model", type="string"),
     *             @OA\Property(property="color", type="string"),
     *             @OA\Property(property="price", type="number"),
     *             @OA\Property(property="year", type="integer")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Car updated successfully")
     * )
     */
    public function update(Request $request, string $id)
    {
        $cars = Car::update($request->all());
        return $cars;
    }


   /**
     * @OA\Delete(
     *     path="/api/cars/{id}",
     *     summary="Remove the specified car",
     *     tags={"cars"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Car deleted successfully")
     * )
     */
    public function destroy(Car $cars)
    {
        $cars->delete();
        return response()->noContent();
    }
}

