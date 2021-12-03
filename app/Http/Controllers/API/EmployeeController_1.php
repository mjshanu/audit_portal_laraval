<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller {
  public function index()
  {
     
      $users = DB::table('basic_information')
            ->select()
			->where('status', 'Inprogress')
            ->get();
      $ulist=json_encode($users);
      return response()->json([
         'status'=>200,
         'candidate' =>$ulist,
     ]);     
       
    
      
  }
  public function scheduleresponse()
  {
	   $users = DB::table('basic_information')
            ->select()
			->where('status', 'Schedule')
            ->get();
      $ulist=json_encode($users);
      return response()->json([
         'status'=>200,
         'candidate' =>$ulist,
     ]);     
       
  }
  public function rejectionreponse()
  {
	  $users = DB::table('basic_information')
            ->select()
			->where('status', 'Rejection')
            ->get();
      $ulist=json_encode($users);
      return response()->json([
         'status'=>200,
         'candidate' =>$ulist,
     ]);    
	  
  }
  public function waitingresponse()
  {
	   $users = DB::table('basic_information')
            ->select()
			->where('status', 'Waiting')
            ->get();
      $ulist=json_encode($users);
      return response()->json([
         'status'=>200,
         'candidate' =>$ulist,
     ]);   
  }
    public function store(Request $request) {
        //return $request->all();

        $insert = DB::table('basic_information')->insertGetId(
                array(
                    'name' => $request->username,
                    'post' => $request->postvalue,
                    'email' => $request->p_email,
                    'contact_number' => $request->phonenumber,
                    'education' => $request->qualification,
                    'exp_ctc' => $request->expect_ctc,
                    'ctc' => $request->ctc,
                    'skillset'=>$request->skillset,
                    'total_exp' =>$request->exp,
                    'dob' =>$request->dob,
                    'location' =>$request->location,
                     'c_company' =>$request->current_company,
                    'domain_exp' =>$request->domain_exp,
                    'primary_skill' =>$request->primary_skill,
                     'sec_skill' =>$request->secskill,
                    'ref' =>$request->ref,
                    'applied_date' =>$request->app_date,
                    'notice_prd' =>$request->noticeprd,
					'status'=>'Inprogress'
                    
                )
        );
        //  return $insert;
//    }
        DB::table('schedule_details')->insert(
                array(
                    'b_id' => $insert,
                    'panelmembers' => $request->p_members,
                    'interview_time' => $request->idatetime,
                    'job_title' => $request->jobtitle,
                    'i_place' => $request->iplace,
                    'department' => $request->department_team,
                    'rating' => '5',
                    'commemts' => 'test',
                )
        );
        
        
   DB::table('rejection_reason')->insert(
     array(
            'b_id'     =>   $insert, 
            'c_status'   =>   $request->c_status,
            'reasons'   =>   $request->reason,
     )
);     
        
     return response()->json([
         'status'=>200,
         'message' =>"added successfully"
     ]);     
       
    }
    public function updatecolumn(Request $request)
    {
      $column= $request->column['name'];
	  $id=$request->id;
	  $index=$request->index;
	 $update = \DB::table('basic_information') ->where('id', $id) ->limit(1) ->update( [ 'status' => $column, 'position'=>$index ]); 
	  return response()->json([
         'status'=>200,
         'message' =>"updated successfully"
     ]);     
       
    }

}
