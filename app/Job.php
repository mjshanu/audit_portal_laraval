<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
     protected $table='job';
      protected $fillable=[
           'job_id',
          'job_branch_id',
          'job_post',
          'job_skillset',
          'job_openings',
          'job_experience',
          'job_status',
          'job_date_open',
          'job_date_close',
          'job_location',
          'job_description'
          ]; 
     
}
