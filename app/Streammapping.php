<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Streammapping extends Model
{
    protected $table='audit_stream_mapping';
      protected $fillable=[
           'fk_stream_id',
          'fk_employee_id',
          'fk_sub_strea_id'
          ]; 
}
