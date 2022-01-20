<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branches;
use Illuminate\Support\Facades\DB;
class BranchController extends Controller {

    public function store(Request $request) {
        //return $request->all();
        $branch = new Branches;
        $branch->branch_name = $request->branch_name;
        $branch->branch_code = $request->branch_code;
        $branch->branch_company = $request->branch_company;
        $branch->branch_type = $request->branch_type;
        $branch->branch_location = $request->branch_location;
        $branch->branch_date = $request->branch_date;
        $branch->branch_landline = $request->branch_landline;
        $branch->branch_email = $request->branch_email;
        $branch->save();
        return response()->json([
                    'status' => 200,
                    'message' => 'Branch added successfully',
        ]);
    }

    public function edit($id) {
        $editbranch = Branches::find($id);
        return response()->json([
                    'status' => 200,
                    'branch' => $editbranch,
        ]);
    }

    public function update(Request $request) {
        $id = $request->b_id;
        $branch = Branches::find($id);
        $branch->branch_name = $request->branch_name;
        $branch->branch_code = $request->branch_code;
        $branch->branch_company = $request->branch_company;
        $branch->branch_type = $request->branch_type;
        $branch->branch_location = $request->branch_location;
        $branch->branch_date = $request->branch_date;
        $branch->branch_landline = $request->branch_landline;
        $branch->branch_email = $request->branch_email;
        $branch->update();
        return response()->json([
                    'status' => 200,
                    'message' => 'Branch updated successfully',
        ]);
    }
    public function location()
    {
         $location = DB::table('branches')
                ->select('branch_name','branch_location','id')
                ->get();
     
           return response()->json([
                    'status' => 200,
                    'location' =>$location ,
        ]);
    }
    public function destroy($id) {
    $branches= Branches::find($id);
     $branches->delete();
     return response()->json([
                    'status' => 200,
                    'message' => 'Branches Deleted successfully',
        ]);
}


}
