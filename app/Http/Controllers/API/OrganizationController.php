<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
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
