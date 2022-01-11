<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate_log extends Model
{
    protected $table='candidate_log';
     protected $fillable=[
         'fk_can_id',
         'status_name',
          
       
         ]; 
}
