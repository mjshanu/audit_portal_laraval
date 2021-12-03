<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    protected $table='branches';
     protected $fillable=[
         'branch_name',
         'branch_code',
         'branch_company',
         'branch_type',
         'branch_location',
         'branch_date',
         'branch_landline',
         'branch_email'
         ]; 
}
