<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Revoke;
use DB;
class RevokeController extends Controller
{
     public function store(Request $request) {
        // return $request->all();
          $revoke = new Revoke;
            $revoke->fk_rel_id = $request->emp_id;
              $revoke->reason = $request->revoke_reason;
              $revoke->save();
               DB::table('audit_employee_basics')
->where('id', $request->emp_id)
->update(['status'=>'Active']);
        DB::table('audit_employee_noticelog')->insert(
    ['fk_n_employee_id' => $request->emp_id, 'activity_name' => 'Revoke','byname'=>'admin']
);
        DB::table('audit_employee_notice')->where('fk_employee_id',  $request->emp_id)->delete();
         return response()->json([
                    'status' => 200,
                    'message' => 'Resign Revoke successfully',
        ]);
     }
}
