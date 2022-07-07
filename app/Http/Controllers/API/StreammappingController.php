<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Streammapping;
use DB;
class StreammappingController extends Controller
{
    public function add_map_stream(Request $request)
{
        
   $stream = new Streammapping;
 $ids=explode('_',$request->id);
 
 if($ids[3]==1){
 $stream->fk_stream_id  = $ids[1];
  $stream->fk_employee_id   = $ids[0];
   $stream->fk_sub_strea_id    = $ids[2];
  $stream->save();
        return response()->json([
                    'status' => 200,
                    'message' => 'Mapping added successfully',
        ]);
 }
 else {
    DB::table('audit_stream_mapping')->where('fk_employee_id', $ids[0])->delete();
       return response()->json([
                    'status' => 200,
                    'message' => 'Mapping disabled successfully',
        ]);
 }
}
}
