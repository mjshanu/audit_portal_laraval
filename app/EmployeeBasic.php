<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeBasic extends Model {

    protected $table = 'audit_employee_basics';
    protected $fillable = [
        'emp_name',
        'emp_code',
        'emp_fk_des_id',
        'emp_joining_date',
        'emp_company_email_id',
        'emp_contact_number',
        'emp_gender',
        'emp_location',
        'emp_holiday_calander',
        'emp_region',
        'fk_emp_reporting',
        'fk_emp_functional_manager',
    ];

}
