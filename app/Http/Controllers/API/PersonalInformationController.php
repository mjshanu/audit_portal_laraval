<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PersonalInformation;
class PersonalInformationController extends Controller
{
     public function store(Request $request) {
         return $request->all();
     }
}
