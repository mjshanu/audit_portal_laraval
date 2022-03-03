<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit_Employee extends Model
{
    protected $table='audit_employee';
    protected $fillable=[
        'fk_c_id',
        'e_name',
        'e_code',
        'e_desination',
        'e_joining_date',
        'e_company_email_id',
        'e_contact_number',
        'e_reporting_head',
        'e_gender',
        'e_location',
        'password'
    ];
 
}
