<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Carbon\Carbon;

class PropertyController extends Controller
{
    //

    public function index(){
        return view('Property.index');
    }

    public function wew(){
        return view('Property.index');
    }

    public function properties(){
        return view('Property.properties');
    }

    public function store_property(Request $request){

        $request->validate([
            'image1'             => 'required|mimes:png,jpeg',
            'image2'             => 'required|mimes:png,jpeg',
            'image3'             => 'required|mimes:png,jpeg',
            'mothlyrate'         => 'required',
            'toilets'            => 'required',
            'carpark'            => 'required',
            'bathroom'           => 'required',
            'bed_rooms'          => 'required',
            'sq_meter'           => 'required',
            'description'        => 'required',
            'completeaddress'    => 'required',
            'propertyname'       => 'required',
         
         
            
        ]);


        $property  = new Property();
        if (Property::where('property_name', $request->propertyname)->exists()) {
            // Handle the case where the property_name already exists, for example, return an error response
            return response()->json(['exist' => 'Property name already exist'], 422);
        }
        
        $text = "PN-";
        $now = Carbon::now()->format('Y');
        $property_no = Property::IDGenerator(new Property,'property_no', 4,$text.$now);
        $property->property_no      =   $property_no;
        $property->property_name    =   $request->propertyname;
        $property->type    =   $request->selectedPropertyType;
        $property->complete_address =   $request->completeaddress;
        $property->description      =   $request->description;
        $property->bedrooms         =   $request->bed_rooms;
        $property->sq               =   $request->sq_meter;
        $property->carpark          =   $request->carpark;
        $property->toilet           =   $request->toilets;
        $property->bath             =   $request->bathroom;
        $property->monthlyrate      =   $request->mothlyrate;
        $property->property_type    = "Real State";
        $property->status_type      = "For Rent";
        $property->status           = "Available";
        $property->rentedidle       = "Available";
        
    
        $rootName = str_replace(' ', '_', strtoupper($request->input('propertyname')));
        $images = ['image1', 'image2', 'image3'];

        foreach ($images as $index => $imageField) {

            if ($request->hasFile($imageField)) {
                $file = $request->file($imageField);
                if ($file->isValid()) {
                    $now = Carbon::now();
                    $ext = $file->extension();
                    $fileName = $now->year . '-' . $rootName . '.' . $property_no . '-' . ($index + 1) . '.' . $ext;
                    $file->move(public_path('property/furnishing/' . $property_no), $fileName);
    
                    // Save file name to the property model
                    $property->{$imageField} = $fileName;
                }
            }
        }
    
       
        $property->save();
        if ($property) {
            return response()->json(['status' => 'New Property Successfully Saved'], 200);
        } else {
            return response()->json(['error' => 'Something went Wrong. Please Try Again'], 202);
        }
    
    }
     public function update_property(Request $request, $id)
            {
                // Validate the request data
                $request->validate([
                    'propertyname'   => 'required',
                    'completeaddress'         => 'required',
                    'description'         => 'required',
                    'sq_meter'            => 'required',
                    'bed_rooms'            => 'required',
                    'carpark'        => 'required',
                    'toilets'          => 'required',
                    'date_created'          => 'required',
                    'mothlyrate'     => 'required',
                    // 'furnishings'      => 'required|mimes:pdf',
                    // 'image1'           => 'required|mimes:png,jpeg',
                ]);

                // Find the property by ID
                 $property = Property::find($id);

                 // Check if property name is modified
            // Check if property name is modified
            if ($request->hasFile('furnishings')) {
                $file = $request->file('furnishings');
                if ($file->isValid()) {
                    $now = Carbon::now();
                    $ext = $file->extension();
                    $rootName = str_replace(' ', '_', strtoupper($request->propertyname));
                    $track = str_replace(' ', '_', $request->property_no);
                    $fileName = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
                    $file->move(public_path('property/furnishing/' . $request->property_no), $fileName);
                    $property->furnishing = $fileName;
                }
            }
            if ($request->hasFile('image1')) {
                $file = $request->file('image1');
                if ($file->isValid()) {
                    $now = Carbon::now();
                    $ext = $file->extension();
                    $rootName = str_replace(' ', '_', strtoupper($request->propertyname));
                    $track = str_replace(' ', '_', $request->property_no);
                    $fileName1 = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
                    $file->move(public_path('property/furnishing/' . $request->property_no), $fileName1);
                    $property->image1 = $fileName1;
                }
            }   
            if ($request->hasFile('image3')) {
                $file = $request->file('image3');
                if ($file->isValid()) {
                    $now = Carbon::now();
                    $ext = $file->extension();
                    $rootName = str_replace(' ', '_', strtoupper($request->propertyname));
                    $track = str_replace(' ', '_', $request->property_no);
                    $fileName2 = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
                    $file->move(public_path('property/furnishing/' . $request->property_no), $fileName2);
                    $property->image2 = $fileName2;
                }
            }   
            if ($request->hasFile('image3')) {
                $file = $request->file('image3');
                if ($file->isValid()) {
                    $now = Carbon::now();
                    $ext = $file->extension();
                    $rootName = str_replace(' ', '_', strtoupper($request->propertyname));
                    $track = str_replace(' ', '_', $request->property_no);
                    $fileName3 = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
                    $file->move(public_path('property/furnishing/' . $request->property_no), $fileName3);
                    $property->image3 = $fileName3;
                }
            }   
                $property->property_name    =   $request->propertyname;
                $property->complete_address =   $request->completeaddress;
                // $property->date_created     =   $request->date_created;
                $property->type      =   $request->selectedPropertyType;
                $property->description      =   $request->description;
                $property->bedrooms         =   $request->bed_rooms;
                $property->sq               =   $request->sq_meter;
                $property->carpark          =   $request->carpark;
                $property->toilet           =   $request->toilets;
                $property->bath             =   $request->bathroom;
                $property->monthlyrate      =   $request->mothlyrate;
                $property->property_no      =   $request->property_no;

                $property->save();
                // Return a success response
                return response()->json(['status' => 'Property successfully updated'], 200);
            }

            // Helper function to upload files
            private function uploadFile($file, $propertyName, $folder)
            {
                $ext = $file->extension();
                $rootName = str_replace(' ', '_', strtoupper($propertyName));
                $fileName = $rootName . '.' . uniqid() . '.' . $ext;

                // Move the file to the specified folder
                $file->move(public_path($folder . '/' . $propertyName), $fileName);

                return $fileName;
            }
    public function getdata_properties(Request $request){
        
		$columns = ['property_no', 'property_name','address','monthlyrate','created_at','status'];
		$length = $request->input('length');
		$column = $request->input('column');
		$dir = $request->input('dir');
		$searchValue = $request->input('search');
		$data = Property::orderBy($columns[$column], $dir);

		if($searchValue){
			$data->where(function($data) use ($searchValue) {
				$data->where('property_no', 'like', '%' . $searchValue . '%')
				->orWhere('property_name', 'like', '%' . $searchValue . '%')
				->orWhere('complete_address', 'like', '%' . $searchValue . '%')
                ->orWhere('bedrooms', 'like', '%' . $searchValue . '%')
                ->orWhere('carpark', 'like', '%' . $searchValue . '%')
                ->orWhere('toilet', 'like', '%' . $searchValue . '%')
                ->orWhere('monthlyrate', 'like', '%' . $searchValue . '%')
				->orWhere('sq', 'like', '%' . $searchValue . '%');
			});
			

		}
		$data = $data->paginate($length);
		return ['data' => $data, 'draw' => $request->input('draw')];

}

public function create_property(){
    return view('Property.create');
}

 public function count_property(){

    $availableCount = Property::where('status', 'Available')->count();
    $occupiedCount = Property::where('status', 'Occupied')->count();
    $overallCount = Property::count();
    return response()->json(['availableCount' => $availableCount,'occupiedCount' => $occupiedCount,'overallCount' => $overallCount,]);


 }
 public function delete_property(Request $request, $id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        // Soft delete the property
        $property->delete();

        return response()->json(['message' => 'Property soft-deleted successfully']);
    }


    public function memorial(){
        return view('Memorial.memorial');
    }
    
}
