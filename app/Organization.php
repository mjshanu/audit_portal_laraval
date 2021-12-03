<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //
    protected $table='organization';
     protected $fillable=[
         'org_name',
         'org_code',
         'org_type',
         'org_category',
         'org_registration',
         'org_location'
         ]; 
}
