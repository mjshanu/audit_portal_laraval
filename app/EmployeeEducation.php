<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
      protected $table='audit_personal_education';
      protected $fillable=[
           'ed_fk_emp_id',
             'education_name',
            'institution',
            'year_of_pass',
            'specialization'
          ]; 
}
