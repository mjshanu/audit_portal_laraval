<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
class CandidateController extends Controller {

    public function add_schedule(Request $request) {
         //return $request->all();
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
        $candidate_status = DB::table('candidate_log')->insert(
                array(
                    'fk_can_id' => $request->s_id,
                    'status_name' => 'Schedule an Interview',
                )
        );
        $update = \DB::table('basic_information')->where('id', $request->s_id)->limit(1)->update(['status' => 'Schedule', 'position' => 1]);
        return response()->json([
                    'status' => 200,
                    'message' => "added successfully"
        ]);
    }

    public function rejection(Request $request) {

        DB::table('rejection_reason')->insert(
                array(
                    'b_id' => $request->r_id,
                    'c_status' => $request->rejectionstatus,
                    'reasons' => $request->reason,
                    'remarks' => $request->remark,
                )
        );
        $candidate_status = DB::table('candidate_log')->insert(
                array(
                    'fk_can_id' => $request->r_id,
                    'status_name' => 'Rejected',
                )
        );
        $update = \DB::table('basic_information')->where('id', $request->r_id)->limit(1)->update(['status' => 'Rejection', 'position' => 1]);
        return response()->json([
                    'status' => 200,
                    'message' => "added successfully"
        ]);
    }

    public function generate_offer_letter(Request $request) {
       
        $releaseid = $request->release_id;
        $joiningdate = $request->release_date;

        //  $newjoingdate = str_replace('_', ' ', $joiningdate);
        $offerdate = str_replace('-', '', $joiningdate);

        $todaydate = date('Y-m-d');
        $offertoday = str_replace('-', '', $todaydate);
//    echo $releaseid;
//    //$ecode=200+$releaseid;
//   // $codename="ENS/CHR/OL/112021/01122021/".$ecode;
        $place = DB::table('schedule_details')
                ->select('i_place')
                ->where('b_id', $releaseid)
                ->get();

        $place = $place[0]->i_place;
        $offid = 200 + $releaseid;
        $offercode = 'ENS' . '/' . $place . '/' . 'OL' . '/' . $offertoday . '/' . $offerdate . '/' . $offid;

        DB::table('offer_letter')->insert(
                array(
                    'fk_can_id' => $releaseid,
                    'offer_code' => $offercode,
                    'offer_release_date'=>$joiningdate,
                    
                )
        );
        $candidate_status = DB::table('candidate_log')->insert(
                array(
                    'fk_can_id' => $releaseid,
                    'status_name' => 'Offer letter genereted',
                )
        );
        $update = \DB::table('basic_information')->where('id', $releaseid)->limit(1)->update(['status' => 'Release', 'position' => 1]);
        return response()->json([
                    'status' => 200,
                    'message' => "Updated successfully",
        ]);
    }

    public function basic_data_edit($id) {
        $users = DB::table('basic_information')
                ->select()
                ->where('id', $id)
                ->get();
        return response()->json([
                    'status' => 200,
                    'candidate' => $users,
        ]);
    }

    public function schedule_data_edit($id) {

        $users = DB::table('schedule_details')
                ->select()
                ->where('b_id', $id)
                ->get();
        return response()->json([
                    'status' => 200,
                    'schedule' => $users,
        ]);
    }

    public function reject_data_edit($id) {
        $users = DB::table('rejection_reason')
                ->select()
                ->where('b_id', $id)
                ->get();
        return response()->json([
                    'status' => 200,
                    'rejectdata' => $users,
        ]);
    }

    public function release_data_edit($id) {
        $users = DB::table('offer_letter')
                ->select()
                ->where('offer_id', $id)
                ->get();
        return response()->json([
                    'status' => 200,
                    'releasedata' => $users,
        ]);
    }

    public function getcandidatesdetails() {
        $users = DB::table('basic_information')
                ->select()
                ->orderBy('id', 'ASC')
                ->get();
        //  $ulist = json_encode($users);
        return response()->json([
                    'status' => 200,
                    'candidate' => $users,
        ]);
    }

    public function edit_column_name_ref(Request $request) {
        //return $request->all();
        $username = $request->username;
        $post = $request->post;
        $skillset = $request->skillset;
        $email = $request->p_email;
        $phonenumber = $request->phonenumber;
        $qualification = $request->qualification;
        $expectsala = $request->expect_ctc;
        $currentctc = $request->current_ctc;
        $exp = $request->exp;
        $noticeprd = $request->noticeprd;
        $dob = $request->dob;
        $location = $request->location;
        $current_company = $request->current_company;
        $domain_exp = $request->domain_exp;
        $appdate = $request->app_date;
        $primary_skill = $request->primary_skill;
        $secskill = $request->secskill;
        $ref = $request->ref;
        $edit_b_id = $request->edit_b_id;
        $edit_basic_column_name = $request->edit_basic_column_name;
        $edit_panel_member = $request->edit_panel_members;
        $edi_idatetime = $request->edi_idatetime;
        $edit_iplace = $request->edit_iplace;
        $edit_jobtitle = $request->edit_jobtitle;
        $edit_department_team = $request->edit_department_team;
        $edit_interview_rating = $request->edit_interview_rating;
        $edit_s_id = $request->edit_s_id;
        $edit_comments = $request->edit_comments;
        
      if($edit_basic_column_name=='Inprogress')
      {
        DB::table('basic_information')
                ->where('id', $request->id)
                ->update([
                    'name' =>  $username ,
                    'post' => $post,
                    'skillset' =>  $skillset,
                    'email' =>  $email,
                    'contact_number' => $phonenumber,
                    'education' => $qualification,
                    'total_exp' => $exp,
                    'ctc' =>  $currentctc ,
                    'exp_ctc' => $expectsala,
                    'notice_prd' =>  $noticeprd,
                    'dob' =>  $dob ,
                    'location' =>$location,
                    'c_company' => $current_company,
                    'domain_exp' => $domain_exp,
                    'primary_skill' =>  $primary_skill,
                    'sec_skill' => $secskill,
                    'applied_date' => $appdate ,
                   
                    'ref' => $ref,
        ]);  
          
      }
       if($edit_basic_column_name=='Schedule')
      {
        DB::table('schedule_details')
                ->where('b_id', $request->id)
                ->update([
                  'panelmembers' => $edit_panel_member,
          'interview_time' =>  $edi_idatetime,
          'job_title' => $edit_jobtitle,
          'department' => $edit_department_team,
          'i_place' => $edit_iplace,
         'rating'=>$edit_interview_rating,
                     'commemts'=>$edit_comments,
        ]); 
          
      }
      
        if($edit_basic_column_name=='Rejection')
      {
        DB::table('rejection_reason')
                ->where('b_id', $request->id)
                ->update([
                  'c_status' => $request->edit_rejectionstatus,
          'reasons' => $request->edit_reason,
          'remarks' => $request->edit_remark,
         
        ]);
          
      }
       if($edit_basic_column_name=='Release')
      {
        DB::table('rejection_reason')
                ->where('b_id', $request->id)
                ->update([
                  'c_status' => $request->edit_rejectionstatus,
          'reasons' => $request->edit_reason,
          'remarks' => $request->edit_remark,
         
        ]);
          
      }
    }

    public function getcandidate($id) {
        $result = DB::table('basic_information')
                ->select('*')
                ->leftJoin('schedule_details', 'basic_information.id', '=', 'schedule_details.b_id')
                ->leftJoin('rejection_reason', 'basic_information.id', '=', 'rejection_reason.b_id')
                ->where('basic_information.id', $id)
                ->get();
        return response()->json([
                    'status' => 200,
                    'candidate' => $result,
        ]);
    }

    public function update_recruitement(Request $request) {

            //return $request->all();
        /* $sql= DB::table('basic_information as bi')
          ->join("schedule_details as sc", "bi.id", "=", "sc.b_id")
          ->join("rejection_reason as rr", "bi.id", "=", "rr.b_id")
          ->where("bi.id", "=", $request->id)
          ->toSql()
          ->update(
          ['name' => $request->username,
          'post' => $request->post,
          'skillset' => $request->skillset,
          'email' => $request->p_email,
          'contact_number' => $request->phonenumber,
          'education' => $request->qualification,
          'total_exp' => $request->total_exp,
          'ctc' => $request->ctc,
          'exp_ctc' => $request->expect_ctc,
          'notice_prd' => $request->noticeprd,
          'dob' => $request->dob,
          'location' => $request->location,
          'c_company' => $request->current_company,
          'domain_exp' => $request->domain_exp,
          'primary_skill' => $request->primary_skill,
          'sec_skill' => $request->secskill,
          'applied_date' => $request->app_date,
          'sec_skill' => $request->secskill,
          'ref' => $request->ref,
          'panelmembers' => $request->p_members,
          'interview_time' => $request->idatetime,
          'job_title' => $request->jobtitle,
          'department' => $request->department_team,
          'i_place' => $request->iplace,
          'i_place' => $request->iplace,
          ]
          );
          echo $sql; */
        DB::table('basic_information')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->username,
                    'post' => $request->postvalue,
                    'skillset' => $request->skillset,
                    'email' => $request->p_email,
                    'contact_number' => $request->phonenumber,
                    'education' => $request->qualification,
                    'total_exp' => $request->exp,
                    'ctc' => $request->ctc,
                    'exp_ctc' => $request->expect_ctc,
                    'notice_prd' => $request->noticeprd,
                    'dob' => $request->dob,
                    'location' => $request->location,
                    'c_company' => $request->current_company,
                    'domain_exp' => $request->domain_exp,
                    'primary_skill' => $request->primary_skill,
                    'sec_skill' => $request->secskill,
                    'applied_date' => $request->app_date,
                   
                    'ref' => $request->ref,
        ]);
         DB::table('schedule_details')
                ->where('b_id', $request->id)
                ->update([
                  'panelmembers' => $request->p_members,
          'interview_time' => $request->idatetime,
          'job_title' => $request->jobtitle,
          'department' => $request->department_team,
          'i_place' => $request->iplace,
         'rating'=>$request->interview_rating,
                     'commemts'=>$request->comments,
        ]);
          DB::table('rejection_reason')
                ->where('b_id', $request->id)
                ->update([
                  'c_status' => $request->c_status,
          'reasons' => $request->reason,
          'remarks' => $request->remark,
         
        ]);
        
        return response()->json([
                    'status' => 200,
                    'message' => "Update content successfully",
        ]);
    }
    public function deleteCandidate($id)
    {
      DB::table('basic_information')->where('id', $id)->delete();
       DB::table('schedule_details')->where('b_id', $id)->delete();
          DB::table('rejection_reason')->where('b_id', $id)->delete();
           DB::table('offer_letter')->where('fk_can_id', $id)->delete();
           $candidate_status = DB::table('candidate_log')->insert(
                array(
                    'fk_can_id' => $id,
                    'status_name' => 'Delete Employee',
                )
        );
            return response()->json([
                    'status' => 200,
                    'message' => "Delete content successfully",
        ]);
    }
  public function Updateboarddetails(Request $request) {
     //return $request->all();
    // return $request->file('resume');
     
    
     $column_name=$request->edit_basic_column_name;
      $username = $request->username;
        $post = $request->post;
        $skillset = $request->skillset;
        $email = $request->p_email;
        $phonenumber = $request->phonenumber;
        $qualification = $request->qualification;
        $expectsala = $request->expect_ctc;
        $currentctc = $request->current_ctc;
        $exp = $request->exp;
        $noticeprd = $request->noticeprd;
        $dob = $request->dob;
        $location = $request->location;
        $current_company = $request->current_company;
        $domain_exp = $request->domain_exp;
        $appdate = $request->app_date;
        $primary_skill = $request->primary_skill;
        $secskill = $request->secskill;
        $ref = $request->ref;
         $edit_panel_member = $request->edit_panel_members;
          $edi_idatetime = $request->edi_idatetime;
        $edit_iplace = $request->edit_iplace;
        $edit_jobtitle = $request->edit_jobtitle;
        $edit_department_team = $request->edit_department_team;
        $edit_interview_rating = $request->edit_interview_rating;
        $edit_s_id = $request->edit_s_id;
        $edit_comments = $request->edit_comments;
         $resume=DB::table('basic_information')->where('id', $request->edit_b_id)->select('resume')->get();
         
        if($request->hasFile('resume')){
       
         $file=$request->file('resume');
          $extension=$file->getClientOriginalExtension();
           $filename= time().'.'.$extension;
          
        
          if (File::exists(public_path('uploads/resume/'.$resume[0]->resume))) {
               File::delete(public_path('uploads/resume/'.$resume[0]->resume));
          }
           $file->move('uploads/resume',$filename);
    }
    if($column_name==='Inprogress')
     {
        $file=(!empty($filename))?$filename:$resume[0]->resume;
      
         DB::table('basic_information')
                ->where('id', $request->edit_b_id)
                ->update([
                    'name' =>  $username ,
                    'post' => $post,
                    'skillset' =>  $skillset,
                    'email' =>  $email,
                    'contact_number' => $phonenumber,
                    'education' => $qualification,
                    'total_exp' => $exp,
                    'ctc' =>  $currentctc ,
                    'exp_ctc' => $expectsala,
                    'notice_prd' =>  $noticeprd,
                    'dob' =>  $dob ,
                    'location' =>$location,
                    'c_company' => $current_company,
                    'domain_exp' => $domain_exp,
                    'primary_skill' =>  $primary_skill,
                    'sec_skill' => $secskill,
                    'applied_date' => $appdate ,
                    'resume' =>$file,
                    'ref' => $ref,
        ]);  
     }
       else if($column_name=='Schedule')
      {
        DB::table('schedule_details')
                ->where('s_id', $edit_s_id)
                ->update([
                  'panelmembers' => $edit_panel_member,
          'interview_time' =>  $edi_idatetime,
          'job_title' => $edit_jobtitle,
          'department' => $edit_department_team,
          'i_place' => $edit_iplace,
         'rating'=>$edit_interview_rating,
                     'commemts'=>$edit_comments,
        ]); 
          
      }
       else if($column_name=='Rejection')
      {
         
        DB::table('rejection_reason')
                ->where('r_id', $request->edit_r_id)
                ->update([
                  'c_status' => $request->edit_rejectionstatus,
          'reasons' => $request->edit_reason,
          'remarks' => $request->edit_remark,
         
        ]);
          
      }
      else {
            $releaseid = $request->edit_release_id;
        $joiningdate = $request->edit_release_date;

        //  $newjoingdate = str_replace('_', ' ', $joiningdate);
        $offerdate = str_replace('-', '', $joiningdate);

        $todaydate = date('Y-m-d');
        $offertoday = str_replace('-', '', $todaydate);
//    echo $releaseid;
//    //$ecode=200+$releaseid;
//   // $codename="ENS/CHR/OL/112021/01122021/".$ecode;
        $place = DB::table('schedule_details')
                ->select('i_place')
                ->where('b_id', $releaseid)
                ->get();

        $place = $place[0]->i_place;
        $offid = 200 + $releaseid;
        $offercode = 'ENS' . '/' . $place . '/' . 'OL' . '/' . $offertoday . '/' . $offerdate . '/' . $offid;
          DB::table('offer_letter')
                ->where('offer_id', $request->edit_release_id)
                ->update([
                  'offer_code' => $offercode,
          'offer_release_date' => $joiningdate,
         ]);
      }
     return response()->json([
                    'status' => 200,
                    'message' => "Data updated successfully",
        ]);
  }  
  public function release_employee() {
     
       $users = DB::table('basic_information')
            ->join('offer_letter', 'basic_information.id', '=', 'offer_letter.fk_can_id')
             ->select('*')
             
            ->get();
         return response()->json([
                    'status' => 200,
                    'users' => $users,
        ]);
  }
  public function viewlog($id)
  {
      $viewlog=DB::table('candidate_log')->where('fk_can_id', $id)->select()->get();
       return response()->json([
                    'status' => 200,
                    'log' => $viewlog,
        ]);
  }
  public function editfetchCandidatefulldata($id)
  {
      $users = DB::table('basic_information')
            ->join('offer_letter', 'basic_information.id', '=', 'offer_letter.fk_can_id')
             ->select('*')
              ->where('fk_can_id', $id)
            ->get();
       return response()->json([
                    'status' => 200,
                    'users' => $users,
        ]); 
   /*  $users = DB::table('basic_information')
            ->join('offer_letter', 'basic_information.id', '=', 'offer_letter.fk_can_id')
             ->select('*')
             
            ->get();
         return response()->json([
                    'status' => 200,
                    'users' => $users,
        ]); 
  }*/
 
}
public function editfetchCandidatestatusdata($id)
  {
      $users = DB::table('basic_information')
            ->join('offer_letter', 'basic_information.id', '=', 'offer_letter.fk_can_id')
             ->select('*')
              ->where('fk_can_id', $id)
            ->get();
      
      $ecode=200;
      $getlstcode= DB::table('audit_employeeid')->select('*')->orderBy('id', 'desc')->take(1)->get();
     // echo '<pre>';print_r($getlstcode);
    if(empty($getlstcode->toArray()))
{
   $last_id='200';  
}
else 
{
    $last_id=$getlstcode[0]->emp_id+1;
}
DB::table('audit_employeeid')->insert(
    ['emp_id' => $last_id, 'branch_name' => 'CHN']
);
$users[0]->empcode=$last_id;

 return response()->json([
                    'status' => 200,
                    'users' => $users,
        ]); 
     /* if(!empty($getlstcode))
      {
      $last_id=$getlstcode[0]->emp_id;
      }
      else {
        $last_id='200';  
      }
      echo $last_id;
     /*if($last_id=='')
     {
         echo 'null';
     }
     else {
         echo $last_id;
     }*/
    /*   return response()->json([
                    'status' => 200,
                    'users' => $users,
        ]); */
   /*  $users = DB::table('basic_information')
            ->join('offer_letter', 'basic_information.id', '=', 'offer_letter.fk_can_id')
             ->select('*')
             
            ->get();
         return response()->json([
                    'status' => 200,
                    'users' => $users,
        ]); 
  }*/
 
}

}
