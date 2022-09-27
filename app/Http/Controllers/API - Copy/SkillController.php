<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Skillset;
class SkillController extends Controller
{
     public function index() {
          
          $skill = Skillset::all('skill_name as value', 'skill_name as label');
           return response()->json([
                    'status' => 200,
                    'skill' => $skill,
        ]);
     }
}
