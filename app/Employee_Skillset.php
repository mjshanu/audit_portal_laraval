<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Skillset extends Model
{
    protected $table='audit_employee_skillset';
      protected $fillable=[
           'fk_emp_id',
          'primary_skill',
          'secondary_skill'
          ]; 
}
