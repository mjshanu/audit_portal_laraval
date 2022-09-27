<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_Post;
class JobpostController extends Controller
{
     public function index()
    {
        $post= Job_Post::all();
        return response()->json([
                    'sta' => 200,
                    'post' => $post,
        ]);
        
    }
}
