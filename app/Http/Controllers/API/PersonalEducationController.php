<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\PersonalEducationController;
class PersonalEducationController extends Controller
{
    public function store(Request $request) {
         return $request->all();
     }
}
