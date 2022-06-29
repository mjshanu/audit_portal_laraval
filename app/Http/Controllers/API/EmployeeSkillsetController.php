<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee_Skillset;
class EmployeeSkillsetController extends Controller
{
    public function update_profileskills(Request $request) {
        $id = $request->fk_emp_id;
        // $employee= PersonalInformation::find($id);
        $employee = Employee_Skillset::where('fk_emp_id', '=', $id)->first();
        $employee->primary_skill = $request->primary_skill;
          $employee->secondary_skill = $request->secondary_skill;
        $employee->update();
        return response()->json([
                    'status' => 200,
                    'message' => 'Skillset updated successfully',
        ]);
    }

}
