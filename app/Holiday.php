<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Holiday extends Model {

   

    protected $table = 'audit_holidays';
    protected $fillable = [
        'hol_name',
        'hol_date',
        'ho_day'
    ];

}
