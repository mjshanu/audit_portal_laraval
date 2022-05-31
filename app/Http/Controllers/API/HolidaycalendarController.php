<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Holiday_Calander;
use Illuminate\Support\Facades\DB;
class HolidaycalendarController extends Controller
{
     public function store(Request $request) {
      $hol_data= json_decode($request->holiday_name_drop);
      
     
       $type=$request->calander_type;
       if($type==1)
       {
           $hol_location_project_name=$request->location_name;
       }
       else {
         $hol_location_project_name=$request->project_name;  
       }
           $holidaycalendar = new Holiday_Calander;
           $holidaycalendar->hol_type = $request->calander_type;
           $holidaycalendar->hol_calendar_name = $request->holiday_name;
           $holidaycalendar->hol_location_project_name = $hol_location_project_name;
            $holidaycalendar->fk_hol_id=1;
            $holidaycalendar->created_by='Admin';
              $holidaycalendar->save();
              $lastId = $holidaycalendar->id;
              $id= $lastId;
             foreach($hol_data as $holidaydata) 
             {
                 $holidayname=$holidaydata->hol_name;
                 $holid=$holidaydata->id;
                 DB::table('audit_calendar_map')->insert(
    ['fk_hol_id' => $holid,'fk_hol_map_id'=>$lastId]
);
             }
              return response()->json([
                    'status' => 200,
                     'message' => 'Calendar created successfully',
        ]);
              
    }
    public function getHolidaynames()
    {
     /*  $holidylist = DB::table('audit_holidays_calendar')
    ->select('hol_calendar_name','hol_name','audit_holidays_calendar.id')
    ->join('audit_calendar_map', 'audit_calendar_map.fk_hol_map_id', '=', 'audit_holidays_calendar.id')
   ->join('audit_holidays', 'audit_holidays.id', '=', 'audit_calendar_map.fk_hol_map_id')
   ->distinct()             
    ->get();*/
       $holidylist = DB::select("select distinct `hol_calendar_name`, `audit_holidays_calendar`.`id`,(select count(audit_calendar_map.id) from audit_calendar_map where optional='0' and fk_hol_map_id=audit_holidays_calendar.id)publicount,"
               . "(select count(audit_calendar_map.id) from audit_calendar_map where optional='1' and fk_hol_map_id=audit_holidays_calendar.id)optionalcount from `audit_holidays_calendar` left join `audit_calendar_map` on `audit_calendar_map`.`fk_hol_map_id` = `audit_holidays_calendar`.`id`"
               . " left join `audit_holidays` on `audit_holidays`.`id` = `audit_calendar_map`.`fk_hol_id`");
       return response()->json([
                    'sta' => 200,
                    'holidaylist' => $holidylist,
        ]);
    }
    public function viewholidaysbyid($id)
{
  
    $holidaylist=DB::table('audit_calendar_map')
           ->select('hol_name','audit_calendar_map.id as auid','hol_date','hol_day','optional','hol_calendar_name')  
              ->join('audit_holidays', 'audit_calendar_map.fk_hol_id', '=', 'audit_holidays.id')
             ->join('audit_holidays_calendar', 'audit_holidays_calendar.id', '=', 'audit_calendar_map.fk_hol_map_id')
             ->where('audit_calendar_map.fk_hol_map_id',$id)  
            
            ->get();
       return response()->json([
                    'status' => 200,
                    'holidaylist' => $holidaylist,
        ]);
    }
    public function optionalholidayupdate($id)
    {
       $ids=explode('_',$id);
       $optionid=$ids[1];
    $query=DB::table('audit_calendar_map')
->where('id',$optionid)
->update(['optional'=>$ids[0]]);
   
      return response()->json([
                    'status' => 200,
                    'message' => "updated successfully",
        ]);
    }
    public function delete_holidaynames($id)
{
    DB::table('audit_calendar_map')->delete($id);
    return response()->json([
                    'status' => 200,
                    'message' => "Deleted successfully",
        ]);
}
public function addtoExistingValue(Request $request)
{
    return $request->all();
      $hol_data= json_decode($request->holiday_name_drop);
       $id=$request->id;
         foreach($hol_data as $holidaydata) 
             {
                 $holidayname=$holidaydata->hol_name;
                 $holid=$holidaydata->id;
                 DB::table('audit_calendar_map')->insert(
    ['fk_hol_id' => $holid,'fk_hol_map_id'=>$id]
);
             }
              return response()->json([
                    'status' => 200,
                     'message' => 'Calendar updated successfully',
        ]);
}
}


