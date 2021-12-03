<?php
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\OrganizationController;
use App\Http\Controllers\API\BranchController;
use App\Http\Controllers\API\JobpostController;
use App\Http\Controllers\API\JobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('/getcandidates',[EmployeeController::class,'index']);
Route::get('/getcandidates_schedule',[EmployeeController::class,'scheduleresponse']);
Route::get('/getcandidates_rejection',[EmployeeController::class,'rejectionreponse']);
Route::get('/getcandidates_waiting',[EmployeeController::class,'waitingresponse']);
Route::get('/getOrgnaization_type',[EmployeeController::class,'org_type']);
Route::post('/add_employee_first',[EmployeeController::class,'store']);
Route::post('/updatecolumn',[EmployeeController::class,'updatecolumn']);
Route::post('/add_organization',[OrganizationController::class,'store']);
Route::get('/getOrganization',[OrganizationController::class,'index']);
Route::get('/getOrgnaizationname',[OrganizationController::class,'organaisationname']);
Route::get('/getLocation',[OrganizationController::class,'locationname']);
Route::get('/editfecthorgdata/{id}',[OrganizationController::class,'edit']);
Route::put('/update_organization',[OrganizationController::class,'update']);
Route::delete('/delete_organization/{id}',[OrganizationController::class,'destroy']);
Route::post('/add_branches',[BranchController::class,'store']);
Route::get('/getposttype',[JobpostController::class,'index']);
Route::post('/add_jobs',[JobController::class,'store']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
