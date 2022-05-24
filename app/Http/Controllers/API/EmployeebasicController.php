<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmployeeBasic;
use DB;

class EmployeebasicController extends Controller {

    public function store(Request $request) {
        //return $request->all();
        $employee = new EmployeeBasic;
        $employee->emp_name = $request->emp_name;
        $employee->emp_code = $request->emp_code;
        $employee->emp_fk_des_id = $request->emp_desigination;
        $employee->emp_joining_date = $request->emp_joindate;
        $employee->emp_company_email_id = $request->emp_email;
        // $employee->emp_reportperson = 1;
        $employee->fk_emp_previous_exp = $request->emp_prev_exp;
        $employee->emp_gender = $request->emp_gender;
        $employee->emp_holiday_calander = $request->emp_holiday_calender;
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
    public function viewlist()
    {
         $employees = EmployeeBasic::all();
           return response()->json([
                    'status' => 200,
                    'emp' => $employees,
        ]);
    }

}
