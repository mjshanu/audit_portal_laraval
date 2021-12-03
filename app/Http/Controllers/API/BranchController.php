<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branches;
class BranchController extends Controller
{
    
    public function store(Request $request)
    {
       //return $request->all();
        $branch= new Branches;
        $branch->branch_name=$request->branch_name;
        $branch->branch_code=$request->branch_code;
        $branch->branch_company=$request->branch_company;
         $branch->branch_type=$request->branch_type;
          $branch->branch_location=$request->branch_location;
           $branch->branch_date=$request->branch_date;
           $branch->branch_landline=$request->branch_landline;
            $branch->branch_email=$request->branch_email;
           $branch->save();
           return response()->json([
                    'status' => 200,
                    'message' => 'Branch added successfully',
        ]);
    }
}
