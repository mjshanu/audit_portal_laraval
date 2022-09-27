<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stream;
use DB;
class StreamController extends Controller {

    public function store(Request $request) {
      
        $stream = new Stream;
        $stream->stream_name = $request->stream_name;
        $stream->save();
        return response()->json([
                    'status' => 200,
                    'message' => 'Stream added successfully',
        ]);
    }
    public function index()
    {
          $getstream = Stream::all();
        return response()->json([
                    'status' => 200,
                    'stream' => $getstream,
        ]);
    }
     public function getstreamsubValue() {
      
     $stream= Stream::get(['id','stream_name']);  
     $i=0;
    foreach($stream as $stm)
    {
        $id=$stm['id'];
        
   
      $substream = DB::table('audit_sub_stram')
                ->select('id as bid','sub_stream_name')
              
                ->where('fk_stream_id', '=', $id)
                  ->get();
      
      $stream[$i]['substream']=$substream;
               $i++;
    }
   
     
       return response()->json([
                    'sta' => 200,
                    'stream' => $stream,
        ]);
        
    }

}
