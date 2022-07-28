<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditEmployeeNotice extends Model
{
     protected $table='audit_employee_notice';
     protected $fillable=[
      'fk_employee_id',
      'date_of_resign',
      'frequency',
      'date_of_releave',
      'nstatus',
      'fk_map_id',
       'last_working'  
         ]; 
}
