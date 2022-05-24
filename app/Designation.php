<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
     protected $table='audit_designation';
     protected $fillable=[
         'designation_name',
         'designation_code',
         'fk_department_id',
         'level_type',
         'designation_status'
         ]; 
}
