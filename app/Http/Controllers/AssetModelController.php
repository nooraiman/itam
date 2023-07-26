<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetModelRequest;
use App\Models\AssetModel;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class AssetModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = AssetModel::with('category')->with('manufacturer')->get();
        return view('models.index')->with('models', $models);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $manufacturers = Manufacturer::all();

        return view('models.create')->with('categories', $categories)->with('manufacturers', $manufacturers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetModelRequest $request)
    {
        AssetModel::create($request->validated());
        return redirect()->route('models.index')->with('success', 'Model has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = AssetModel::findorFail($id)->with('category')->get();
        $model = $model[0];

        return view('models.show')->with('model', $model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = AssetModel::findorFail($id)->with('category')->with('manufacturer')->get();
        $model = $model[0];
        
        $categories = Category::all();
        $manufacturers = Manufacturer::all();

        return view('models.edit')->with('model', $model)->with('categories', $categories)->with('manufacturers', $manufacturers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssetModelRequest $request, $id)
    {
        $model = AssetModel::findorFail($id);

        $model->update($request->validated());

        return redirect()->route('models.index')->with('success', 'Model has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AssetModel::destroy($id);
        return redirect()->route('models.index')->with('success', 'Model has been removed!');
    }
}
