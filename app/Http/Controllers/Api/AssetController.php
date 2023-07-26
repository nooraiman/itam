<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AssetRequest;
use App\Models\Asset;
use Illuminate\Http\Request;


class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Asset::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssetRequest $request)
    {
        // // Validate Input
        // $validator = Validator::make($input, [
            
        // ]);
        // // Return error if validation fails
        // $this->validateWith($validator, $request);
        $asset = Asset::create($request->validated());

        return response()->json([
            'data' => $asset
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        return response()->json([
            'data' => $asset
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $input = $request->validate([
            'name' => 'required',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
