<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AuditEmployeeNotice;

class NoticeController extends Controller {

    public function store(Request $request) {
     
        $notice = new AuditEmployeeNotice;
        $notice->date_of_resign = $request->emp_dateofresign;
        $notice->date_of_releave = $request->emp_dateofrelieving;
        $notice->frequency = $request->emp_frequency;
        $notice->fk_employee_id  = $request->emp_id;
         $notice->fk_map_id  =1;
        $notice->save();
        return response()->json([
                    'status' => 200,
                    'message' => 'Resign added successfully',
        ]);
    }

}
