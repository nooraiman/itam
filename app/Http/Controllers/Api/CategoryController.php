<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Category::all()
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
        $category = Category::create($input);

        return response()->json([
            'message' => 'Category has been created.',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'data' => $category
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
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
        $category->update($input);

        return response()->json([
            'message' => 'Category has been updated.',
            'data' => $category
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category has been deleted.'
        ], 200);
    }
}
