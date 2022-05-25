<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use DB;
class DepartmentController extends Controller
{
      public function store(Request $request) {
      //return  $request->all();
          $department=new Department;
          $department->department_name	= $request->department_name;
           $department->department_code	= $request->department_code;
           $department->save();
           return response()->json([
                    'status' => 200,
                    'message' => 'Department added successfully',
        ]);
       
    }
     public function index() {
          $departments = Department::all();
           return response()->json([
                    'status' => 200,
                    'departments' => $departments,
        ]);
     }
     public function departmentname()
     {
          $department=Department::distinct()->get(['department_name','id']);
    
    return response()->json([
                    'status' => 200,
                    'department' => $department,
        ]);
     }
      public function getdepartmentdesignation()
    {
      $organization= Department::get(['id','department_name', 'department_code']);
        $i=0;
         foreach($organization as $org)
    {
        $id=$org['id'];
        
   
      $des= DB::table('audit_designation')
                ->select('id as bid','designation_name','designation_code','level_type')
              
                ->where('fk_department_id', '=', $id)
                  ->get();
      $organization[$i]['des']=$des;
               $i++;
    }
   
     
       return response()->json([
                    'sta' => 200,
                    'org' => $organization,
        ]);
    }
    
        public function edit($id)
    {
        $editorgaization=Department::find($id);
           return response()->json([
                    'status' => 200,
                    'dep' => $editorgaization,
        ]);
    }

}
