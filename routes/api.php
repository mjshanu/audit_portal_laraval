<?php
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\OrganizationController;
use App\Http\Controllers\API\BranchController;
use App\Http\Controllers\API\JobpostController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\CandidateController;
use App\Http\Controllers\API\Audit_EmployeeController;
use App\Http\Controllers\API\HolidayController;
use App\Http\Controllers\API\HolidaycalendarController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\DesignationController;
use App\Http\Controllers\API\EmployeebasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('/getcandidates',[EmployeeController::class,'index']);
Route::get('/getcandidates_schedule',[EmployeeController::class,'scheduleresponse']);
Route::get('/getcandidates_rejection',[EmployeeController::class,'rejectionreponse']);
Route::get('/getcandidates_waiting',[EmployeeController::class,'waitingresponse']);
Route::get('/getcandidates_release',[EmployeeController::class,'releaseresponse']);
Route::get('/getOrgnaization_type',[EmployeeController::class,'org_type']);
Route::post('/add_employee_first',[EmployeeController::class,'store']);
Route::post('/updatecolumn',[EmployeeController::class,'updatecolumn']);
Route::post('/add_schedule',[CandidateController::class,'add_schedule']);
Route::post('/add_rejection',[CandidateController::class,'rejection']);
Route::post('/add_offerletter',[CandidateController::class,'generate_offer_letter']);
Route::get('/getcandidates_release_details',[CandidateController::class,'release_employee']);
Route::get('/editfecthbasicdata/{id}',[CandidateController::class,'basic_data_edit']);
Route::get('/getscheduledata/{id}',[CandidateController::class,'schedule_data_edit']);
Route::get('/getrejectdata/{id}',[CandidateController::class,'reject_data_edit']);
Route::get('/getreleasedata/{id}',[CandidateController::class,'release_data_edit']);
Route::get('/getcandidatesdetails',[CandidateController::class,'getcandidatesdetails']);
Route::post('/Updateboarddetails',[CandidateController::class,'Updateboarddetails']);
Route::get('/getCandidatefullDetails/{id}',[CandidateController::class,'getcandidate']);
Route::get('/viewlog/{id}',[CandidateController::class,'viewlog']);
Route::get('/editfetchCandidatefulldata/{id}',[CandidateController::class,'editfetchCandidatefulldata']);
Route::get('/editfetchCandidatestatusdata/{id}',[CandidateController::class,'editfetchCandidatestatusdata']);
Route::post('/add_organization',[OrganizationController::class,'store']);
Route::get('/getOrganization',[OrganizationController::class,'index']);
Route::get('/editfecthscheduledata/{id}',[EmployeeController::class,'editschedule']);
Route::get('/getOrganizationvalues',[OrganizationController::class,'getorgbranchvalues']);
Route::get('/getOrgnaizationname',[OrganizationController::class,'organaisationname']);
Route::get('/getLocation',[OrganizationController::class,'locationname']);
Route::get('/editfecthorgdata/{id}',[OrganizationController::class,'edit']);
Route::post('/Addemployee',[Audit_EmployeeController::class,'store']);
Route::put('/update_organization',[OrganizationController::class,'update']);
Route::post('/updaterecruitement',[CandidateController::class,'update_recruitement']);
Route::post('/edit_column_name_ref',[CandidateController::class,'edit_column_name_ref']);
Route::delete('/delete_organization/{id}',[OrganizationController::class,'destroy']);
Route::get('/deleteCandidate/{id}',[CandidateController::class,'deleteCandidate']);
Route::post('/add_branches',[BranchController::class,'store']);
Route::get('/getLocationBranch',[BranchController::class,'location']);
Route::get('/editfecthbranchdata/{id}',[BranchController::class,'edit']);
Route::put('/update_branch',[BranchController::class,'update']);
Route::delete('/delete_branches/{id}',[BranchController::class,'destroy']);
Route::get('/getposttype',[JobpostController::class,'index']);
Route::post('/add_jobs',[JobController::class,'store']);
Route::get('/getJobs',[JobController::class,'index']);
Route::get('/editfecthjobdata/{id}',[JobController::class,'edit']);
Route::put('/update_job',[JobController::class,'update']);
Route::post('/user-login',[Audit_EmployeeController::class,'userLogin']);
Route::post('/add_holidays',[HolidayController::class,'store']);
Route::get('/getHolidays',[HolidayController::class,'index']);
Route::get('/getHolidayslist',[HolidayController::class,'holidaylist']);
Route::delete('/delete_holidays/{id}',[HolidayController::class,'destroy']);
Route::get('/edit_holidays/{id}',[HolidayController::class,'edit']);
Route::get('/getRemainingholidays/{id}',[HolidayController::class,'getRemainingholidays']);
Route::put('/update_holidays',[HolidayController::class,'update']);
Route::post('/add_holidays_calendar',[HolidaycalendarController::class,'store']);
Route::post('/addtoExistingValue',[HolidaycalendarController::class,'addtoExistingValue']);
Route::get('/getHolidaynames',[HolidaycalendarController::class,'getHolidaynames']);
Route::get('/getholidysbyid/{id}',[HolidaycalendarController::class,'viewholidaysbyid']);
Route::get('/getupdateholiday/{id}',[HolidaycalendarController::class,'optionalholidayupdate']);
Route::post('/add_departments',[DepartmentController::class,'store']);
Route::get('/getDepartmentValues',[DepartmentController::class,'index']);
Route::get('/getDepartmentName',[DepartmentController::class,'departmentname']);
Route::post('/add_designation',[DesignationController::class,'store']);
Route::get('/getDesignationall',[DesignationController::class,'index']);
Route::get('/getDepartmentValues',[DepartmentController::class,'getdepartmentdesignation']);
Route::get('/delete_holidaynames/{id}',[HolidaycalendarController::class,'delete_holidaynames']);
Route::post('/add_audit_employees',[EmployeebasicController::class,'store']);
Route::get('/getEmployeeDetails',[EmployeebasicController::class,'viewlist']);
Route::get('/editfecthdepdata/{id}',[DepartmentController::class,'edit']);
Route::put('/update_department',[DepartmentController::class,'update']);
Route::put('/update_designation',[DesignationController::class,'update']);
Route::delete('/delete_departments/{id}',[DepartmentController::class,'destroy']);
Route::get('/editfecthdesdata/{id}',[DesignationController::class,'edit']);
Route::get('/GetEmployeeFullDetails/{id}',[EmployeebasicController::class,'GetEmployeeFullDetails']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
