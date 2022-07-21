<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Substream extends Model
{
     protected $table='audit_sub_stram';
      protected $fillable=[
           'sub_stream_name',
          'sub_stream_status',
          'fk_stream_id'
          ]; 
}
