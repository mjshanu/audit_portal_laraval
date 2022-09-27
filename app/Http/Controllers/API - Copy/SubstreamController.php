<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Substream;
use DB;
class SubstreamController extends Controller {

    public function store(Request $request) {

        $substream = new Substream;
        $substream->fk_stream_id = $request->stream_name;
        $substream->sub_stream_name = $request->substream_name;
         $substream->save();
        return response()->json([
                    'status' => 200,
                    'message' => 'Sub Stream added successfully',
        ]);
    }
    
    public function getSubstreamname($id)
    {
          //$getsubstream=Substream::where('fk_stream_id', $id)->get();
           $getsubstream = DB::table('audit_stream')
                ->select('sub_stream_name','stream_name','audit_stream.id as auid','audit_sub_stram.id as subid')
                ->join('audit_sub_stram', 'audit_sub_stram.fk_stream_id', '=', 'audit_stream.id')
                ->where('audit_stream.id', '=', $id)
                  ->get();
             return response()->json([
                    'status' => 200,
                    'options' => $getsubstream,
        ]);
    }

}
