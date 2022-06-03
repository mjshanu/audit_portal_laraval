<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmployeeBasic;
use DB;

class EmployeebasicController extends Controller {

    public function store(Request $request) {
        //return $request->all();
        // return $request->file('profilepic');
        if ($request->hasFile('profilepic')) {
            $file = $request->file('profilepic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profile', $filename);
        } else {

            if ($request->emp_gender == "male") {

                $filename = "men.png";
            } else {
                $filename = "default-women.png";
            }
        }

        $employee = new EmployeeBasic;
        $employee->emp_name = $request->emp_name;
        $employee->emp_code = strtoupper($request->emp_code);
        $employee->emp_fk_des_id = $request->emp_desigination;
        $employee->emp_joining_date = $request->emp_joindate;
        $employee->emp_company_email_id = $request->emp_email;
        // $employee->emp_reportperson = 1;
        $employee->fk_emp_previous_exp = $request->emp_prev_exp;
        $employee->emp_gender = $request->emp_gender;
        $employee->emp_holiday_calander = $request->emp_holiday_calender;
        $employee->emp_fk_dep = $request->emp_department;
        $employee->emp_location = $request->emp_location;
        $employee->image = $filename;
        $employee->save();
        $lastId = $employee->id;
        DB::table('audit_employee_skillset')->insert(
                ['fk_emp_id' => $lastId, 'primary_skill' => $request->emp_primary_skill, 'secondary_skill' => $request->emp_sec_skill]
        );
        return response()->json([
                    'status' => 200,
                    'message' => 'employees added successfully',
        ]);
    }

    public function viewlist() {
        $employees = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as empid','audit_employee_basics.*','audit_designation.*','audit_department.*')
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                  ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                ->get();
        // $employees = EmployeeBasic::all();
        return response()->json([
                    'status' => 200,
                    'emp' => $employees,
        ]);
    }

    public function GetEmployeeFullDetails($id) {
        $employees = DB::table('audit_employee_basics')
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                  ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                ->where('audit_employee_basics.id', $id)
                ->limit(1)
                ->get();
        // $employees = EmployeeBasic::all();
        return response()->json([
                    'status' => 200,
                    'emp' => $employees,
        ]);
    }
    public function destroy($id)
    {
         $employee= EmployeeBasic::find($id);
     $employee->delete();
     DB::table('audit_employee_skillset')->delete($id);
     return response()->json([
                    'status' => 200,
                    'message' => 'Employee Deleted successfully',
        ]);
    }
    public function getEmployeebylocation($id)
    {
       $getid=explode("&&",$id);
      
      $location=$getid[0];
      $designation=$getid[1];
      
        if(($location!="" && $designation!=""))
        {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid','emp_name','emp_code','designation_name','emp_company_email_id','emp_contact_number','emp_gender','emp_location'
                            ,'department_name','emp_joining_date','fk_emp_previous_exp','image') 
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                  ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                ->where('audit_employee_basics.emp_location', $location)
                 ->where ('audit_employee_basics.emp_fk_des_id',$designation)
                   -> distinct()
                 ->get();   
             
               
        }
        else if(($location!="")&&( $designation==""))
        {
             $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid','emp_name','emp_code','designation_name','emp_company_email_id','emp_contact_number','emp_gender','emp_location'
                            ,'department_name','emp_joining_date','fk_emp_previous_exp','image') 
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                  ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                ->where('audit_employee_basics.emp_location', $location)
               ->distinct()
                ->get();  
        }
        else {
              $employees = DB::table('audit_employee_basics')
                      ->select('audit_employee_basics.id as empid','emp_name','emp_code','designation_name','emp_company_email_id','emp_contact_number','emp_gender','emp_location'
                            ,'department_name','emp_joining_date','fk_emp_previous_exp','image') 
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                  ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                ->where ('audit_employee_basics.emp_fk_des_id',$designation)
                -> distinct()
                ->get();  
        }
        return response()->json([
                    'status' => 200,
                   'emp' => $employees,
        ]);
    }

}
