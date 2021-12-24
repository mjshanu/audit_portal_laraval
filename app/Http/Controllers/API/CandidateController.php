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
    public function rejection(Request $request)
    {
     
         DB::table('rejection_reason')->insert(
                array(
                    'b_id' => $request->r_id,
                    'c_status' => $request->rejectionstatus,
                    'reasons' => $request->reason,
                    'remarks' => $request->remark,
                )
        );
$update = \DB::table('basic_information')->where('id', $request->r_id)->limit(1)->update(['status' => 'Rejection', 'position' => 1]);
        return response()->json([
                    'status' => 200,
                    'message' => "added successfully"
        ]);
    }
    public function generate_offer_letter(Request $request)
    {
        return $request->all();
    $releaseid=$request->release_id;
//    echo $releaseid;
//    //$ecode=200+$releaseid;
//   // $codename="ENS/CHR/OL/112021/01122021/".$ecode;
//   $datecode = DB::table('users')
//            ->select('name', 'email as user_email')
//            ->get();
    }
}
