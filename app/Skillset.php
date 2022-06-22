<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skillset extends Model
{
     protected $table='skills';
      protected $fillable=[
           'skill_name',
          'skill_status'
          ]; 
          
          
}
