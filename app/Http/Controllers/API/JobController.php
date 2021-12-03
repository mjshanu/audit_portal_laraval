<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job;
class JobController extends Controller
{
    public function store(Request $request)
    {
       // return $request->all();
         $job= new Job;
         $job->job_id=$request->job_id;
        $job->job_post=$request->job_post;
        $job->job_skillset=$request->job_skillset;
         $job->job_branch_id=1;
          $job->job_openings=$request->job_openings;
           $job->job_experience=$request->job_experience;
           $job->job_status=$request->job_status;
            $job->job_date_open=$request->job_date_open;
             $job->job_date_close=$request->job_date_close;
              $job->job_location=$request->job_location;
               $job->job_description=$request->job_description;
               $job->save();
           return response()->json([
                    'status' => 200,
                    'message' => 'Job added successfully',
        ]);
    }
}
