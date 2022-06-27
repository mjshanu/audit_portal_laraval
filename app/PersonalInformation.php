<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    protected $table='audit_personalinformation';
      protected $fillable=[
           'p_fk_emp_id',
          'aadhar_number',
          'permenent_adress',
          'f_m_s_name',
          'temp_adress',
          'emergency_contact_number',
          'of_dob',
          'p_email_adress',
          'tot_exp',
            'm_status'
          ]; 
}
