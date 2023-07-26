<?php

namespace App\Http\Controllers\Api;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Manufacturer::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        // Validate Input
        $validator = Validator::make($input, [
            'name' => 'required',
            'website' => 'required',
        ]);
        // Return error if validation fails
        $this->validateWith($validator, $request);

        $input = $validator->validated();
        $manufacturer = Manufacturer::create($input);

        return response()->json([
            'message' => 'Manufacturer has been created.',
            'data' => $manufacturer
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Manufacturer $manufacturer)
    {
        return response()->json([
            'message' => 'success',
            'data' => $manufacturer
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        $input = $request->all();
        
        // Validate Input
        $validator = Validator::make($input, [
            'name' => 'required',
            'website' => 'required',
        ]);
        // Return error if validation fails
        $this->validateWith($validator, $request);

        $input = $validator->validated();
        $manufacturer->update($input);

        return response()->json([
            'message' => 'Manufacturer has been updated.',
            'data' => $manufacturer
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        return response()->json([
            'message' => 'Manufacturer has been deleted.'
        ], 200);
    }
}
