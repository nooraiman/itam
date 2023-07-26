<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCount = [
            "assets" => Asset::count(),
            "models" => AssetModel::count(),
            "categories" => Category::count(),
        ];

        $assets = Auth::user()->assets()->with('assetModel', 'assetModel.manufacturer', 'assetModel.category')->get();

        return view("dashboard")->with("totalCount", $totalCount)->with("assets", $assets);
    }
}
