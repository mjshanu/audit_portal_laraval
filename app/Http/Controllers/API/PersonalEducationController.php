<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmployeeEducation;

class PersonalEducationController extends Controller {

    public function store(Request $request) {
        //   return $request->all();
        $pe = new EmployeeEducation;
        $pe->ed_fk_emp_id = $request->cmid;
        $pe->education_name = $request->employee_education;
        $pe->institution = $request->employee_institution;
        $pe->year_of_pass = $request->employee_yearofgrad;
        $pe->specialization = $request->employee_specialization;
        $pe->save();
         return response()->json([
                    'status' => 200,
                    'message' => 'Education added successfully',
        ]);
    }

}
