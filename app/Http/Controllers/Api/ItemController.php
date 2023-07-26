<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Item::all()
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
        $item = Item::create($input);

        return response()->json([
            'message' => 'Item has been created.',
            'data' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return response()->json([
            'data' => $item
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
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
        $item->update($input);

        return response()->json([
            'message' => 'Item has been updated.',
            'data' => $item
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json([
            'message' => 'Item has been deleted.'
        ], 200);
    }
}
