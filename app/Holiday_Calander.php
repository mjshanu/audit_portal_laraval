<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday_Calander extends Model
{
     protected $table = 'audit_holidays_calendar';
    protected $fillable = [
        'fk_hol_id',
        'hol_calendar_name',
        'hol_type',
        'hol_location_name',
        'hol_project_name'
    ];

}
