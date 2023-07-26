<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetRequest;
use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::with('assetModel', 'assetModel.manufacturer', 'assetModel.category')->get();
        return view('assets.index')->with('assets', $assets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select('id', 'name')->orderBy('name')->get();
        $models = AssetModel::with('manufacturer')->get();
        return view('assets.create')->with('models', $models)->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetRequest $request)
    {
        Asset::create($request->validated());
        return redirect()->route('assets.index')->with('success', 'Asset has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset = Asset::findorFail($id)->with('assetModel', 'assetModel.manufacturer', 'assetModel.category')->get();
        return view('assets.show')->with('asset', $asset[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::select('id', 'name')->orderBy('name')->get();
        $models = AssetModel::with('manufacturer')->get();
        $asset = Asset::findorFail($id)->with('assetModel', 'assetModel.manufacturer', 'assetModel.category')->first();
        return view('assets.edit')->with('asset', $asset)->with('models', $models)->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $asset = Asset::findorFail($id);
        $input = $request->all();

        if (!$request->assigned_to) {
            $input = array_merge($input, ['assigned_to' => null]);
        }

        $input = Validator::make($input, [
            'name' => 'required',
            'serial_number' => 'required',
            'tag' => 'required',
            'model_id' => 'required',
            'status' => 'required',
            'assigned_to' => 'present|nullable'
        ])->validate();

        if($input['assigned_to'] != null) {
            $asset->assigned_to = $input['assigned_to'];
        } else {
            $asset->assigned_to = null;
        }


        $asset->update([
            'name' => $input['name'],
            'serial_number' => $input['serial_number'],
            'tag' => $input['tag'],
            'model_id' => $input['model_id'],
            'status' => $input['status']
            ]
        );
        $asset->save();
        return redirect()->route('assets.index')->with('success', 'Asset has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asset::destroy($id);
        return redirect()->route('assets.index')->with('success', 'Asset has been removed!');
    }
}
