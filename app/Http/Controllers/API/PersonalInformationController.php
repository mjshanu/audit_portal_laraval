<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PersonalInformation;

class PersonalInformationController extends Controller {

   public function store(Request $request) {

        //return $request->all();

     

        $pi = new PersonalInformation;

        $pi->p_fk_emp_id = $request->p_fk_emp_id;

        $pi->aadhar_number = $request->aadhar_number;

        $pi->permenent_adress = $request->permenent_adress;

        $pi->f_m_s_name = $request->f_m_s_name;

        $pi->temp_adress = $request->temp_address;

        $pi->emergency_contact_number = $request->emergency_contact_number;

        $pi->of_dob = $request->of_dob;

        $pi->p_email_adress = $request->p_email_adress;

        $pi->tot_exp = $request->tot_exp;

        $pi->m_status = $request->m_status;

        $pi->save();

        return response()->json([

                    'status' => 200,

                    'message' => 'Personal Information added successfully',

        ]);

    }
    
    

}
