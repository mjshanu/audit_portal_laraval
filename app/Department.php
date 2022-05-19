<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     protected $table='audit_department';
     protected $fillable=[
         'department_name',
         'department_code',
         
         ]; 
}
