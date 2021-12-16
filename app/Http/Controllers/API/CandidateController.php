<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CandidateController extends Controller
{
    public function add_schedule(Request $request)
    {
       // return $request->all();
       DB::table('schedule_details')->insert(
                array(
                    'b_id' => $request->s_id,
                    'panelmembers' => $request->panel_members,
                    'interview_time' => $request->idatetime,
                    'job_title' => $request->jobtitle,
                    'i_place' => $request->iplace,
                    'department' => $request->department_team,
                    'rating' => $request->interview_rating,
                     
                    'commemts' => $request->comments
                )
        );  
       
         $update = \DB::table('basic_information')->where('id', $request->s_id)->limit(1)->update(['status' => 'Schedule', 'position' => 1]);
        return response()->json([
                    'status' => 200,
                    'message' => "added successfully"
        ]);
    }
}
