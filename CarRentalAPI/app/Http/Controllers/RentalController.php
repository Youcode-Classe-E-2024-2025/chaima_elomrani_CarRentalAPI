<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Rental::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Rental::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        return $rental;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rentals = Rental::update($request->all());
        return $rentals;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rentals)
    {
        $rentals->delete();
        return response()->noContent();
    }

    
}
