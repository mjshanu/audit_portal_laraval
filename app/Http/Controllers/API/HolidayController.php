<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Holiday;

class HolidayController extends Controller {

    public function store(Request $request) {
      
        $holiday = new Holiday;
        $getmonth = strtotime($request->holiday_date);
        $day = date('D', $getmonth) . 'day';
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
}
