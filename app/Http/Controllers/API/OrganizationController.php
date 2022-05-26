<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
use DB;

class OrganizationController extends Controller
{
    public function store(Request $request)
    {
      // return $request->all();
        $organization= new Organization;
        $organization->org_code=$request->org_code;
        $organization->org_name=$request->org_name;
        $organization->org_type=$request->org_type;
         $organization->org_category=$request->org_category;
          $organization->org_registration=$request->org_registration;
           $organization->org_location=$request->org_location;
           $organization->save();
           return response()->json([
                    'status' => 200,
                    'message' => 'Organization added successfully',
        ]);
    }
    public function index()
    {
        $organaization= Organization::all();
        return response()->json([
                    'sta' => 200,
                    'org' => $organaization,
        ]);
        
    }
    public function getorgbranchvalues() {
      
     $organization= Organization::get(['id','org_name', 'org_code', 'org_type','org_location']);  
     $i=0;
    foreach($organization as $org)
    {
        $id=$org['id'];
        
   
      $branches = DB::table('branches')
                ->select('id as bid','branch_name','branch_code','branch_type','branch_location')
              
                ->where('branch_company', '=', $id)
                  ->get();
      $organization[$i]['branch']=$branches;
               $i++;
    }
   
     
       return response()->json([
                    'sta' => 200,
                    'org' => $organization,
        ]);
        
    }
    public function edit($id)
    {
        $editorgaization=Organization::find($id);
           return response()->json([
                    'status' => 200,
                    'org' => $editorgaization,
        ]);
    }
public function update(Request $request)
{
    $id=$request->id;
    $organization= Organization::find($id);
        $organization->org_code=$request->org_code;
        $organization->org_name=$request->org_name;
        $organization->org_type=$request->org_type;
         $organization->org_category=$request->org_category;
          $organization->org_registration=$request->org_registration;
           $organization->org_location=$request->org_location;
           $organization->update();
             return response()->json([
                    'status' => 200,
                    'message' => 'Organization updated successfully',
        ]);
}
public function destroy($id) {
    $organization= Organization::find($id);
     $organization->delete();
     return response()->json([
                    'status' => 200,
                    'message' => 'Organization Deleted successfully',
        ]);
}
public function organaisationname()
{
    $distorg=Organization::distinct()->get(['org_name','id']);
    
    return response()->json([
                    'status' => 200,
                    'org' => $distorg,
        ]);
}
public function locationname() {
     $distorg_location=Organization::distinct()->get(['org_location']);
    return response()->json([
                    'status' => 200,
                    'location' => $distorg_location,
        ]);
}

}
