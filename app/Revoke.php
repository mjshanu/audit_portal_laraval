<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revoke extends Model
{
     protected $table='revoke';
       protected $fillable=[
           'fk_rel_id',
           'reason',
         
          ]; 
}
