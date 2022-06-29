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
        $pi->aadhar_number = $request->adhaar_no;
        $pi->permenent_adress = $request->Perm_address;
        $pi->f_m_s_name = $request->parent_name;
        $pi->temp_adress = $request->temp_address;
        $pi->emergency_contact_number = $request->em_contact_no;
        $pi->of_dob = $request->dob;
        $pi->p_email_adress = $request->personal_email_id;
        $pi->tot_exp = $request->total_experience;
        $pi->m_status = $request->marital_status;
        $pi->save();
        return response()->json([
                    'status' => 200,
                    'message' => 'Personal Information added successfully',
        ]);
    }

    
    

}
