<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Designation;
class DesignationController extends Controller
{
    public function store(Request $request) {
       
        $designation = new Designation;
        $designation->designation_name = $request->designation_name;
         $designation->designation_code = $request->designation_code;
          $designation->fk_department_id = $request->department_name;
         $designation->level_type = $request->level_name;
          $designation->designation_status = 1;
        $designation->save();
        return response()->json([
                    'status' => 200,
                    'message' => 'Designation added successfully',
        ]);
    }
    public function index()
    {
         $designation = Designation::all('id', 'designation_name');
          return response()->json([
                    'status' => 200,
                    'designation' => $designation,
        ]);
    }
   
}
