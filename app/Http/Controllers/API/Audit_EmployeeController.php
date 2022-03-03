<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Audit_Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\AuditMail;
use Validator;
use Crypt;
class Audit_EmployeeController extends Controller {

    public function store(Request $request) {
        // return $request->all();
        $audit_employee = new Audit_Employee;
        $audit_employee->name = $request->e_name;
        // $audit_employee->e_designation = $request->e_designation;
        $audit_employee->fk_c_id = $request->e_c_id;
        $audit_employee->e_code = $request->e_id;
        $audit_employee->e_company_email_id = $request->e_email;
        $audit_employee->e_joining_date = $request->e_joining_date;
       // $audit_employee->password = Hash::make('Global12$');
        $audit_employee->password = md5('Global12$');
      // return $audit_employee->password;
        // echo  $audit_employee->login_password;
        $audit_employee->save();
        $email_to = "shanukk89@gmail.com,mjshanukk@gmail.com";
        $myEmail = $email_to;
        $dataArray['name'] = $request->e_name;
        $dataArray['E_id'] = $request->e_id;
        $dataArray['password'] = 'Global12$';
        $dataArray['username'] = $request->e_email;
        Mail::to('shanu.kk@bourntec.com')->send(new AuditMail($dataArray));
        $update = \DB::table('basic_information')->where('id', $request->e_c_id)->update(['emp_status' => 1]);
        $updatecode = \DB::table('audit_employeeid')->where('emp_id', $request->e_id)->update(['code_status' => 1]);
        $joingdate = \DB::table('offer_letter')->where('fk_can_id', $request->e_c_id)->update(['offer_release_date' => $request->e_joining_date]);
        return response()->json([
                    'status' => 200,
                    'message' => 'Status added successfully',
        ]);
    }

    public function userLogin(Request $request) {
       // return $request->all();
        $validator = Validator::make($request->all(),
                        [
                            "email" => "required|email",
                            "password" => "required"
                        ]
        );
 
// return Hash::check('Global12$1', '$2y$10$dfFGiDAzGXYuQMyOIqrogei04pzgp8sUf9rgNqru1gQsvz9Omwwfi');
        if ($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }
        
//return md5($request->password)
        // check if entered email exists in db
        $email_status = Audit_Employee::where("e_company_email_id", $request->email)->first();
       //  echo $email_status; 
        // if email exists then we will check password for the same email

        if (!is_null($email_status)) {
            $password_status = Audit_Employee::where("e_company_email_id", $request->email)->where("password", md5($request->password))->first();

            // if password is correct
            if (!is_null($password_status)) {
                $user = $this->userDetail($request->email);

                return response()->json(["status" => 200, "success" => true, "message" => "You have logged in successfully", "user" => $user]);
            } else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Incorrect password."]);
            }
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Email doesn't exist."]);
        }
    }

    public function userDetail($email) {
        $user = array();
        if ($email != "") {
            $user = Audit_Employee::where("e_company_email_id", $email)->first();
            return $user;
        }
    }

}
