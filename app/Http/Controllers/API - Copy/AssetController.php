<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Asset;
class AssetController extends Controller
{
     public function store(Request $request) {
       // return $request->all();
           $asset = new Asset;
        $asset->asset_category = $request->asset_category;
        $asset->asset_id = $request->asset_id;
        $asset->asset_name = $request->asset_name;
        $asset->brand = $request->brand_name;
        $asset->asset_location = $request->location;
        $asset->branch_date = date('Y-m-d');
        $asset->asset_model = $request->model_name;
        $asset->branch_landline = 123;
        $asset->asset_p_order_number = 123;
        $asset->save();
        return response()->json([
                    'status' => 200,
                    'message' => 'Asset added successfully',
        ]);
      
    }
}
