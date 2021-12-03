<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_Post extends Model
{
     protected $table='job_post';
     protected $fillable=[
         'post_name',
          ]; 
}
