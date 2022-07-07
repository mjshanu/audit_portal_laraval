<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
     protected $table='audit_stream';
      protected $fillable=[
           'stream_name',
          'stream_status'
          ]; 
}
