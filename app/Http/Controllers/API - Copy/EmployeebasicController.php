<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmployeeBasic;
use DB;
use DateTime;

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
        $employee = new EmployeeBasic;
        $employees = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as empid', 'audit_employee_basics.*', 'audit_designation.*', 'audit_department.*', 'audit_employee_skillset.primary_skill as primary_skill', 'audit_employee_notice.id as notice_id', 'audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                ->orderBy('emp_code', 'ASC')
                ->where('status', '!=', 'inactive')
                ->get();

        // $employees = EmployeeBasic::all();
        //   $activecount=EmployeeBasic::where('status', 'active')->count();
        $empcount = $employees->count();
        $active = \DB::table('audit_employee_basics')->where('status', '=', 'active')->count();
        $noticecount = \DB::table('audit_employee_basics')->where('status', '=', 'notice')->count();
        $inactivecount = \DB::table('audit_employee_basics')->where('status', '=', 'inactive')->count();
//$employees->countactive=10;


        $i = 0;
        foreach ($employees as $emp) {

            $joingdate = new DateTime($emp->emp_joining_date);
            $today = new DateTime();
            $interval = $today->diff($joingdate);
            //$totatlexp=$interval->format('%y years and %m months');
            $year = $interval->format("%y");
            if ($year == 0) {
                $btotatlexp = $interval->format('%m months');
                $badge = "gray";

                $otalexp = $interval->format('%m') + $emp->fk_emp_previous_exp;
            } else {
                $btotatlexp = $interval->format('%y years');
                $otalexp = $interval->format('%y') + $emp->fk_emp_previous_exp;
                if ($btotatlexp < 5) {
                    $badge = "gray";
                } elseif ($btotatlexp >= 5 && $btotatlexp < 10) {
                    $badge = "silver";
                } else {
                    $badge = "gold";
                }
            }


            $employees[$i]->bourntecexp = $btotatlexp;
            $employees[$i]->exp = $otalexp;
            $employees[$i]->badge = $badge;
            $i++;
        }


        return response()->json([
                    'status' => 200,
                    'emp' => $employees,
                    'countactive' => $active,
                    'countnotice' => $noticecount,
                    'inactivecount' => $inactivecount
        ]);
    }

    public function GetEmployeeFullDetails($id) {
        $employees = DB::table('audit_employee_basics')
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                ->leftJoin('audit_personalinformation', 'audit_personalinformation.p_fk_emp_id', '=', 'audit_employee_basics.id')
                ->leftJoin('audit_personal_education', 'audit_personal_education.ed_fk_emp_id', '=', 'audit_employee_basics.id')
                ->where('audit_employee_basics.id', $id)
                ->limit(1)
                ->get();

        // $employees = EmployeeBasic::all();
        return response()->json([
                    'status' => 200,
                    'emp' => $employees,
        ]);
    }

    public function destroy($id) {
        $employee = EmployeeBasic::find($id);
        $employee->delete();
        DB::table('audit_employee_skillset')->delete($id);
        return response()->json([
                    'status' => 200,
                    'message' => 'Employee Deleted successfully',
        ]);
    }
 public function getEmployeebylocation(Request $request) {

        $hol_data = json_decode($request->emp_lo);
        // echo '<pre>';print_r($hol_data);
        //echo '<pre>';print_r($hol_data->skillset_items);
        $location = $hol_data->location_items;
        $skills = $hol_data->skillset_items;

        $designation = $hol_data->designation_items;

        $loc_name = "";
        $des_name = "";
        $skill_name = [];
        $skill_name1 = "";
        $skill_namez = "";
        foreach ($location as $locaitems) {

            if ($locaitems->value != "*") {
                $loc_name .= $locaitems->value . ',';
            }
        }
        $locvar = 'Kochi,Hydarabad,Buwaneswar';
        $loc_name1 = trim($loc_name, ",");
        $varl = explode(',', $loc_name1);

        foreach ($designation as $des) {
            if ($des->value != "*") {
                $des_name .= $des->value . ',';
            }
        }

        $des_name1 = trim($des_name, ",");
        foreach ($skills as $skil) {
            if ($skil->value != "*") {
                $skill_namez .= $skil->value . ',';
                $skill_name[] = $skil->value;
            }
        }
        $skill_name1 = trim($skill_namez, ",");

        // echo '<pre>';print_r($skill_name);


        if ($loc_name1 != "" && $des_name1 != "" && $skill_name1 != "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                     ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
             $activecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                     ->where('status', '=', 'active')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
               $noticecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                     ->where('status', '=', 'notice')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
                 $inactivecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                     ->where('status', '=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
               
            
            
        } elseif ($loc_name1 != "" && $des_name1 != "" && $skill_name1 == "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                     ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
             $activecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                     ->where('status', '=', 'active')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
             $noticecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                     ->where('status', '=', 'notice')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
             $inactivecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                     ->where('status', '=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
        } elseif ($loc_name1 != "" && $des_name1 == "" && $skill_name1 != "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '!=', 'inactive')
                    ->distinct()
                    ->get();
             $activecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '=', 'active')
                    ->distinct()
                    ->count();
              $noticecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '=', 'notice')
                    ->distinct()
                    ->count();
               $inactivecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '=', 'inactive')
                    ->distinct()
                    ->count();
            
        } elseif ($loc_name1 == "" && $des_name1 != "" && $skill_name1 != "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
             $activecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '=', 'active')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
              $noticecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '=', 'noticess')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
               $inactivecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
        } elseif ($loc_name1 != "" && $des_name1 == "" && $skill_name1 == "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                      ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
					$activecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                      ->where('status', '=', 'active')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
              $noticecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                      ->where('status', '=', 'notice')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
               $inactivecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                      ->where('status', '=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
        } elseif ($loc_name1 == "" && $des_name1 != "" && $skill_name1 == "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                      ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                      ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
             $activecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                      ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                      ->where('status', '=', 'active')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
               $noticecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                      ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                      ->where('status', '=', 'notice')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
                $inactivecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                      ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                      ->where('status', '=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
        } elseif ($loc_name1 == "" && $des_name1 == "" && $skill_name1 != "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
             $activecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '=', 'active')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
              $noticecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '=', 'notice')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
               $inactivecount = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->count();
        } else {
            $employees = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as empid', 'audit_employee_basics.*', 'audit_designation.*', 'audit_department.*', 'audit_employee_skillset.primary_skill as primary_skill', 'audit_employee_notice.id as notice_id', 'audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                ->orderBy('emp_code', 'ASC')
                ->where('status', '!=', 'inactive')
                ->get();

        // $employees = EmployeeBasic::all();
        //   $activecount=EmployeeBasic::where('status', 'active')->count();
        $empcount = $employees->count();
        $activecount = \DB::table('audit_employee_basics')->where('status', '=', 'active')->count();
        $noticecount = \DB::table('audit_employee_basics')->where('status', '=', 'notice')->count();
        $inactivecount = \DB::table('audit_employee_basics')->where('status', '=', 'inactive')->count();
              
        }
        $i = 0;
        foreach ($employees as $emp) {

            $joingdate = new DateTime($emp->emp_joining_date);
            $today = new DateTime();
            $interval = $today->diff($joingdate);
            //$totatlexp=$interval->format('%y years and %m months');
            $year = $interval->format("%y");
            if ($year == 0) {
                $btotatlexp = $interval->format('%m months');
                $badge = "gray";

                $otalexp = $interval->format('%m') + $emp->fk_emp_previous_exp;
            } else {
                $btotatlexp = $interval->format('%y years');
                $otalexp = $interval->format('%y') + $emp->fk_emp_previous_exp;
                if ($btotatlexp < 5) {
                    $badge = "gray";
                } elseif ($btotatlexp >= 5 && $btotatlexp < 10) {
                    $badge = "silver";
                } else {
                    $badge = "gold";
                }
            }


            $employees[$i]->bourntecexp = $btotatlexp;
            $employees[$i]->exp = $otalexp;
            $employees[$i]->badge = $badge;
            $i++;
        }
         $empcount = $employees->count();
      

        return response()->json([
                    'status' => 200,
                    'emp' => $employees,
            'countactive' => $activecount,
                    'countnotice' => $noticecount,
                    'inactivecount' => $inactivecount,
					'empcount'=> $empcount
        ]);
        
    }
    public function getEmployeebylocation_copy(Request $request) {

        $hol_data = json_decode($request->emp_lo);
        // echo '<pre>';print_r($hol_data);
        //echo '<pre>';print_r($hol_data->skillset_items);
        $location = $hol_data->location_items;
        $skills = $hol_data->skillset_items;

        $designation = $hol_data->designation_items;

        $loc_name = "";
        $des_name = "";
        $skill_name = [];
        $skill_name1 = "";
        $skill_namez = "";
        foreach ($location as $locaitems) {

            if ($locaitems->value != "*") {
                $loc_name .= $locaitems->value . ',';
            }
        }
        $locvar = 'Kochi,Hydarabad,Buwaneswar';
        $loc_name1 = trim($loc_name, ",");
        $varl = explode(',', $loc_name1);

        foreach ($designation as $des) {
            if ($des->value != "*") {
                $des_name .= $des->value . ',';
            }
        }

        $des_name1 = trim($des_name, ",");
        foreach ($skills as $skil) {
            if ($skil->value != "*") {
                $skill_namez .= $skil->value . ',';
                $skill_name[] = $skil->value;
            }
        }
        $skill_name1 = trim($skill_namez, ",");

        // echo '<pre>';print_r($skill_name);


        if ($loc_name1 != "" && $des_name1 != "" && $skill_name1 != "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                     ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
        } elseif ($loc_name1 != "" && $des_name1 != "" && $skill_name1 == "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                     ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
        } elseif ($loc_name1 != "" && $des_name1 == "" && $skill_name1 != "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                    ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '!=', 'inactive')
                    ->distinct()
                    ->get();
        } elseif ($loc_name1 == "" && $des_name1 != "" && $skill_name1 != "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
        } elseif ($loc_name1 != "" && $des_name1 == "" && $skill_name1 == "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_location', explode(',', $loc_name1))
                      ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
        } elseif ($loc_name1 == "" && $des_name1 != "" && $skill_name1 == "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                      ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->whereIn('audit_employee_basics.emp_fk_des_id', explode(',', $des_name1))
                      ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
        } elseif ($loc_name1 == "" && $des_name1 == "" && $skill_name1 != "") {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                    ->where('primary_skill', 'regexp', '(' . implode("|", $skill_name) . ')')
                      ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
        } else {
            $employees = DB::table('audit_employee_basics')
                    ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                            , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                    ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                    ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                    ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                     ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                     ->where('status', '!=', 'inactive')
                    ->orderBy('emp_code', 'ASC')
                    ->distinct()
                    ->get();
        }
        $i = 0;
        foreach ($employees as $emp) {

            $joingdate = new DateTime($emp->emp_joining_date);
            $today = new DateTime();
            $interval = $today->diff($joingdate);
            //$totatlexp=$interval->format('%y years and %m months');
            $year = $interval->format("%y");
            if ($year == 0) {
                $btotatlexp = $interval->format('%m months');
                $badge = "gray";

                $otalexp = $interval->format('%m') + $emp->fk_emp_previous_exp;
            } else {
                $btotatlexp = $interval->format('%y years');
                $otalexp = $interval->format('%y') + $emp->fk_emp_previous_exp;
                if ($btotatlexp < 5) {
                    $badge = "gray";
                } elseif ($btotatlexp >= 5 && $btotatlexp < 10) {
                    $badge = "silver";
                } else {
                    $badge = "gold";
                }
            }


            $employees[$i]->bourntecexp = $btotatlexp;
            $employees[$i]->exp = $otalexp;
            $employees[$i]->badge = $badge;
            $i++;
        }
 $empcount = $employees->count();
        return response()->json([
                    'status' => 200,
                    'emp' => $employees,
					 'countactive' => $empcount,
                    'countnotice' => 0,
                    'inactivecount' => 0
        ]);
        /*  $getid=explode("&&",$id);

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
          ]); */
    }

    public function searchbyButton($id) {
        $employees = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                        , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                 ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                  ->where('status', '!=', 'inactive')
                ->where('emp_name', 'like', "%{$id}%")
                ->orWhere('emp_code', 'like', "%{$id}%")
                ->orderBy('emp_code', 'ASC')
                ->distinct()
                ->get();
        $empcount = $employees->count();
		 $activecount = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                        , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                 ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                  ->where('status', '=', 'active')
                ->where('emp_name', 'like', "%{$id}%")
                ->orWhere('emp_code', 'like', "%{$id}%")
                ->orderBy('emp_code', 'ASC')
                ->distinct()
                ->count();
                 $noticecount = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                        , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                 ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                  ->where('status', '=', 'notice')
                ->where('emp_name', 'like', "%{$id}%")
                ->orWhere('emp_code', 'like', "%{$id}%")
                ->orderBy('emp_code', 'ASC')
                ->distinct()
                ->count();
                  $inactivecount = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location','audit_employee_basics.status as status'
                        , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                 ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                  ->where('status', '=', 'inactive')
                ->where('emp_name', 'like', "%{$id}%")
                ->orWhere('emp_code', 'like', "%{$id}%")
                ->orderBy('emp_code', 'ASC')
                ->distinct()
                ->count();
       // $active = $employees->where('status', '=', 'active')->count();
       // $noticecount = $employees->where('status', '=', 'notice')->count();
       // $inactivecount = $employees->where('status', '=', 'inactive')->count();
        $i = 0;
        foreach ($employees as $emp) {

            $joingdate = new DateTime($emp->emp_joining_date);
            $today = new DateTime();
            $interval = $today->diff($joingdate);
            //$totatlexp=$interval->format('%y years and %m months');
            $year = $interval->format("%y");
            if ($year == 0) {
                $btotatlexp = $interval->format('%m months');
                $badge = "gray";

                $otalexp = $interval->format('%m') + $emp->fk_emp_previous_exp;
            } else {
                $btotatlexp = $interval->format('%y years');
                $otalexp = $interval->format('%y') + $emp->fk_emp_previous_exp;
                if ($btotatlexp < 5) {
                    $badge = "gray";
                } elseif ($btotatlexp >= 5 && $btotatlexp < 10) {
                    $badge = "silver";
                } else {
                    $badge = "gold";
                }
            }


            $employees[$i]->bourntecexp = $btotatlexp;
            $employees[$i]->exp = $otalexp;
            $employees[$i]->badge = $badge;
            $i++;
        }
        return response()->json([
                    'status' => 200,
                    'emp' => $employees,
					'countactive' => $activecount,
                    'countnotice' => $noticecount,
                    'inactivecount' => $inactivecount
                   
        ]);
    }

    public function searchbycount($id) {
       
       
        if($id=='notice')
        {
             $employees = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location'
                        , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_basics.status as status','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                 ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                ->where('status', '=', "$id")
                ->distinct()
                ->get();
             $noticecount = $employees->count();
            $active=0;
            $inactivecount=0;
             
        }
        elseif($id=='active')
        {
            $employees = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location'
                        , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_basics.status as status','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                 ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                ->where('status', '!=', "inactive")
                ->distinct()
                ->get();
             $active = $employees->count();
             $noticecount=0;
             $inactivecount=0;
             
        }
        else {
             $employees = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as empid', 'emp_name', 'emp_code', 'designation_name', 'emp_company_email_id', 'emp_contact_number', 'emp_gender', 'emp_location'
                        , 'department_name', 'emp_joining_date', 'fk_emp_previous_exp', 'image', 'primary_skill','audit_employee_basics.status as status','audit_employee_notice.date_of_resign as date_of_resign', DB::raw("DATEDIFF(date_of_releave,date_of_resign)AS Days"))
                ->join('audit_department', 'audit_employee_basics.emp_fk_dep', '=', 'audit_department.id')
                ->join('audit_employee_skillset', 'audit_employee_skillset.fk_emp_id', '=', 'audit_employee_basics.id')
                ->join('audit_designation', 'audit_designation.id', '=', 'audit_employee_basics.emp_fk_des_id')
                 ->leftJoin('audit_employee_notice', 'audit_employee_notice.fk_employee_id', '=', 'audit_employee_basics.id')
                ->where('status', '=', "$id")
                ->distinct()
                ->get();
            $inactivecount = $employees->count();
            $active = 0;
             $noticecount=0;
        }
       
        $i = 0;
        foreach ($employees as $emp) {

            $joingdate = new DateTime($emp->emp_joining_date);
            $today = new DateTime();
            $interval = $today->diff($joingdate);
            //$totatlexp=$interval->format('%y years and %m months');
            $year = $interval->format("%y");
            if ($year == 0) {
                $btotatlexp = $interval->format('%m months');
                $badge = "gray";

                $otalexp = $interval->format('%m') + $emp->fk_emp_previous_exp;
            } else {
                $btotatlexp = $interval->format('%y years');
                $otalexp = $interval->format('%y') + $emp->fk_emp_previous_exp;
                if ($btotatlexp < 5) {
                    $badge = "gray";
                } elseif ($btotatlexp >= 5 && $btotatlexp < 10) {
                    $badge = "silver";
                } else {
                    $badge = "gold";
                }
            }


            $employees[$i]->bourntecexp = $btotatlexp;
            $employees[$i]->exp = $otalexp;
            $employees[$i]->badge = $badge;
            $i++;
        }
        return response()->json([
                    'status' => 200,
                    'emp' => $employees,
                    'countactive' => $active,
                    'countnotice' => $noticecount,
                    'inactivecount' => $inactivecount
        ]);
    }

    public function getAllemployeesub($id) {
        $val = explode('_', $id);
        // echo '<pre>';print_r($val);
        // $employees = DB::select("SELECT sm.*, eb.emp_name as emp_name,eb.emp_code as emp_code FROM `audit_employee_basics` eb left join audit_stream_mapping sm on eb.`id` = sm.fk_employee_id)");
        $employees = DB::table('audit_employee_basics')
                ->select('audit_employee_basics.id as id', 'emp_name', 'emp_code', 'fk_stream_id', 'fk_sub_strea_id', 'fk_employee_id')
                ->leftJoin('audit_stream_mapping', 'audit_stream_mapping.fk_employee_id', '=', 'audit_employee_basics.id')
                ->get();
        $i = 0;
        foreach ($employees as $emp) {
            if ($emp->fk_stream_id == "") {
                $employees[$i]->status = 0;
            } elseif ($emp->fk_stream_id == $val[0]) {
                $employees[$i]->status = 1;
            } else {
                $employees[$i]->status = 2;
            }
            $i++;
        }



        return response()->json([
                    'status' => 200,
                    'emp' => $employees,
        ]);
    }

}
