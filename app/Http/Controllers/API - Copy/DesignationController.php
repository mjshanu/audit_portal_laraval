<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Designation;
use DB;

class DesignationController extends Controller
{
    public function store(Request $request) {
       
        $designation = new Designation;
        $designation->designation_name = $request->designation_name;
         $designation->designation_code = strtoupper($request->designation_code);
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
         $designation = Designation::all('id as value', 'designation_name as label');
          return response()->json([
                    'status' => 200,
                    'designation' => $designation,
        ]);
    }
    public function edit($id)
    {
        $results = DB::table('audit_designation')
                ->select('audit_designation.*','department_name','audit_department.id as did')
                ->join('audit_department', 'audit_designation.fk_department_id', '=', 'audit_department.id')
                ->where('audit_designation.id', '=', $id)
                  ->get();
     return response()->json([
                    'status' => 200,
                    'designation' => $results,
        ]);
    }
    
    public function update(Request $request)
{
    $id=$request->id;
    $designation= Designation::find($id);
           $designation->designation_name= $request->edit_designation_name;
           $designation->designation_code= strtoupper($request->edit_designation_code);
             $designation->level_type= $request->edit_level_type;
              $designation->fk_department_id= $request->edit_department_name;
           $designation->update();
             return response()->json([
                    'status' => 200,
                    'message' => 'Designation updated successfully',
        ]);
}
   
}
