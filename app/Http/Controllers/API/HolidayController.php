<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Holiday;
use DB;
class HolidayController extends Controller {

    public function store(Request $request) {
      
        $holiday = new Holiday;
        $getmonth = strtotime($request->holiday_date);
        $day = date('l', $getmonth);
       
        $holiday->hol_name = $request->holiday_name;
        $holiday->hol_date = $request->holiday_date;
        $holiday->hol_day = $day;
        $holiday->save();
        return response()->json([
                    'status' => 200,
                    'message' => 'Hoilday added successfully',
        ]);
    }

     public function index()
     {
         $holidays = Holiday::all();
         $i=0;
        foreach($holidays as $newholidays)
        {
           $date = $newholidays['hol_date'];
            $holidays[$i]['date']= date('d-F-Y', strtotime($date));
            $i++;
            
        }
        
          return response()->json([
                    'status' => 200,
                    'holiday' => $holidays,
        ]);
     }
       public function destroy($id) {
    $branches= Holiday::find($id);
     $branches->delete();
     return response()->json([
                    'status' => 200,
                    'message' => 'Holiday  Deleted successfully',
        ]);
}
 public function edit($id) {
        $editholidays = Holiday::find($id);
        return response()->json([
                    'status' => 200,
                    'branch' => $editholidays,
        ]);
    }
 public function update(Request $request) {
  $id=$request->id;
  $holiday= Holiday::find($id);
   $getmonth = strtotime($request->hol_date);
        $day = date('l', $getmonth);
  $holiday->id = $request->id;
   $holiday->hol_name = $request->hol_name;
    $holiday->hol_day = $day;
     $holiday->hol_date = $request->hol_date;
   $holiday->update();
             return response()->json([
                    'status' => 200,
                    'message' => 'Holiday updated successfully',
        ]);
 }
 public function holidaylist(){
   $holidays=  Holiday::all('id', 'hol_name');
     return response()->json([
                    'status' => 200,
                    'holiday' => $holidays,
        ]);
 }
public function getRemainingholidays($id)
{
     $holidylist = DB::select("SELECT * FROM audit_holidays WHERE id NOT IN (SELECT fk_hol_id FROM audit_calendar_map where fk_hol_map_id=$id)");
      return response()->json([
                    'status' => 200,
                    'holiday' => $holidylist,
        ]);
}
}
