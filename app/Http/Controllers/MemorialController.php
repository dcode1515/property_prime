<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memorial;
use App\Models\Client;
use Carbon\Carbon;
class MemorialController extends Controller
{
    //
    public function store_memorial(Request $request){

        $request->validate([

            'date_created'          => 'required',
            'memorial_name'          => 'required',
            'memorial_address'       => 'required',
            'sq_meter'               => 'required',
            'amount'                 => 'required|integer',
            'documents'              => 'required|mimes:pdf',
            'image'                  => 'required|mimes:png,jpeg',
        ]);

        $memorial = new Memorial;
        if (Memorial::where('memorial_name', $request->memorial_name)->exists()) {
            // Handle the case where the property_name already exists, for example, return an error response
            return response()->json(['exist' => 'Memorial name already exist'], 422);
        }
     
        $now = Carbon::now()->format('Y');
        $memorial_no = Memorial::IDGenerator(new Memorial,'memorial_no', 4,$now);
        $memorial->date_created = $request->date_created;
        $memorial->memorial_no = $memorial_no;
        $memorial->memorial_name = $request->memorial_name;
        $memorial->memorial_address = $request->memorial_address;
        $memorial->sq_meter = $request->sq_meter;
        $memorial->amount = $request->amount;
        $memorial->status = "For Sale";
        $memorial->rentedidle = "Available";

        if ($request->hasFile('documents')) {
            $file = $request->file('documents');
            if ($file->isValid()) {
                $now = Carbon::now();
                $ext = $file->extension();
                $rootName = str_replace(' ', '_', strtoupper($request->memorial_name));
                $track = str_replace(' ', '_', $memorial_no);
                $fileName = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
                $file->move(public_path('memorial/documents/' . $memorial_no), $fileName);
                $memorial->documents = $fileName;
            }
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $now = Carbon::now();
                $ext = $file->extension();
                $rootName = str_replace(' ', '_', strtoupper($request->memorial_name));
                $track = str_replace(' ', '_', $memorial_no);
                $fileName1 = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
                $file->move(public_path('memorial/documents/' . $memorial_no), $fileName1);
                $memorial->image = $fileName1;
            }
        }

        $memorial->save();
        if ($memorial) {
            return response()->json(['status' => 'New Memorial Successfully Saved'], 200);
        } else {
            return response()->json(['error' => 'Something went Wrong. Please Try Again'], 202);
        }
      
    }
    public function get_data_memorial(Request $request){
        
		$columns = ['memorial_no', 'memorial_name','memorial_address','sq_meter','amount','status','rentedidle'];
		$length = $request->input('length');
		$column = $request->input('column');
		$dir = $request->input('dir');
		$searchValue = $request->input('search');
		$data = Memorial::orderBy($columns[$column], $dir);

		if($searchValue){
			$data->where(function($data) use ($searchValue) {
				$data->where('memorial_no', 'like', '%' . $searchValue . '%')
				->orWhere('memorial_name', 'like', '%' . $searchValue . '%')
				->orWhere('memorial_address', 'like', '%' . $searchValue . '%')
                ->orWhere('sq_meter', 'like', '%' . $searchValue . '%')
                ->orWhere('amount', 'like', '%' . $searchValue . '%')
                ->orWhere('status', 'like', '%' . $searchValue . '%')
                ->orWhere('rentedidle', 'like', '%' . $searchValue . '%');
			
			});
			

		}
		$data = $data->paginate($length);
		return ['data' => $data, 'draw' => $request->input('draw')];

}

public function update_memorial(Request $request,$id){
    $request->validate([
        'date_created'          => 'required',
        'memorial_name'          => 'required',
        'memorial_address'       => 'required',
        'sq_meter'               => 'required',
        'amount'                 => 'required|integer',
      
    ]);

    $memorial =  Memorial::find($id);
 
    $now = Carbon::now()->format('Y');
    $memorial->date_created = $request->date_created;
    $memorial->memorial_no = $request->memorial_no;
    $memorial->memorial_name = $request->memorial_name;
    $memorial->memorial_address = $request->memorial_address;
    $memorial->sq_meter = $request->sq_meter;
    $memorial->amount = $request->amount;
   

    if ($request->hasFile('documents')) {
        $file = $request->file('documents');
        if ($file->isValid()) {
            $now = Carbon::now();
            $ext = $file->extension();
            $rootName = str_replace(' ', '_', strtoupper($request->memorial_name));
            $track = str_replace(' ', '_', $request->memorial_no);
            $fileName = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
            $file->move(public_path('memorial/documents/' .$request->memorial_no), $fileName);
            $memorial->documents = $fileName;
        }
    }
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        if ($file->isValid()) {
            $now = Carbon::now();
            $ext = $file->extension();
            $rootName = str_replace(' ', '_', strtoupper($request->memorial_name));
            $track = str_replace(' ', '_', $request->memorial_no);
            $fileName1 = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
            $file->move(public_path('memorial/documents/' .$request->memorial_no), $fileName1);
            $memorial->image = $fileName1;
        }
    }

    $memorial->save();
    if ($memorial) {
        return response()->json(['status' => 'Memorial Successfully Updated'], 200);
    } else {
        return response()->json(['error' => 'Something went Wrong. Please Try Again'], 202);
    }

}
public function delete_memorial($id){
    $memorial = Memorial::find($id);

    if (!$memorial) {
        return response()->json(['message' => 'Memorial not found'], 404);
    }

    // Soft delete the property
    $memorial->delete();

    return response()->json(['message' => 'Memorial soft-deleted successfully']);
}
public function delete_client(Request $request,$id){
    $client = Client::find($id);

    if (!$client) {
        return response()->json(['message' => 'Client not found'], 404);
    }

    // Soft delete the property
    if($client->delete()){
        $memorial = Memorial::find($client->memorial_id);
        if ($memorial) {
            $memorial->rentedidle = "Available";
            $memorial->save();
    
        }
    
    }
    

    return response()->json(['message' => 'Client soft-deleted successfully']);
}

public function counts_memorial(){

    $overAll = Memorial::count();
    $occupiedMemorial = Memorial::where('rentedidle','=','Sold')->count();
    $availableMemorial = Memorial::where('rentedidle','=','Available')->count();
    $totalAmount = Memorial::sum('amount');
          
    return response()->json([
        'overAll' => $overAll,
        'totalAmount' => $totalAmount,
        'occupiedMemorial' => $occupiedMemorial,
        'availableMemorial' => $availableMemorial,
      
    ]);

}

    public function update_memorial_client($id){

        $memorial = Memorial::find($id);
        return view('Memorial.update_client',compact('memorial'));

        
    }

    public function client(){
        return view('Memorial.index');
    }
    public function getMemorial(){
        $memorial  = Memorial::where('rentedidle','=','Available')->get();
        return response()->json($memorial);

    }


    public function store_client(Request $request){
        $request->validate([
            // 'selectedProperty'   => 'required',
            'proofofpayment' => 'required|mimes:png,jpeg,pdf',
            'date_paid'        => 'required',
            'amount'        => 'required|integer',
            'acct_no'      => $request->mode_of_payment == 'Cash' ? 'nullable' : 'required',
            'mode_of_payment'        => 'required',
            'address'       => 'required',
            'contact_no'        => 'required',
            'client_name'        => 'required',
            'date_created'        => 'required',
            'date_paid'        => 'required',
            'memorial_name'        => 'required',
  
        ]);

        $client =  new Client();
        $now = Carbon::now()->format('Y');
        $code_no = Client::IDGenerator(new Client,'code_no', 4,$now);
        $client->memorial_id = $request->memorial_name;
        $client->code_no = $code_no;
        $client->date_created = $request->date_created;
        $client->customer_name = $request->client_name;
        $client->customer_address = $request->address;
        $client->contact_number = $request->contact_no;
        $client->customer_address = $request->address;
        $client->mode_of_payment = $request->mode_of_payment;
        $client->account_number = $request->acct_no;
        $client->amount_paid = $request->amount;
        $client->date_paid = $request->date_paid;
        $client->status = "Paid";
        
        if ($request->hasFile('proofofpayment')) {
            $file = $request->file('proofofpayment');
            if ($file->isValid()) {
                $now = Carbon::now();
                $ext = $file->extension();
                $rootName = str_replace(' ', '_', strtoupper($request->client_name));
                $track = str_replace(' ', '_', $code_no);
                $fileName = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
                $file->move(public_path('client/' . $code_no), $fileName);
                $client->proof_of_payment = $fileName;
            }
        }

        if($client->save()){
            $memorial = Memorial::find($request->memorial_name);
            $memorial->rentedidle = "Sold";
            $memorial->save();

        }
        return response()->json(['message' => 'Client Successfully Saved!']);
        

    }
    public function get_data_client(Request $request){
        
		$columns = ['customer_name', 'customer_address','date_paid','mode_of_payment','amount','rentedidle'];
		$length = $request->input('length');
		$column = $request->input('column');
		$dir = $request->input('dir');
		$searchValue = $request->input('search');
		$data = Client::with('memorial')->orderBy($columns[$column], $dir);

		if($searchValue){
			$data->where(function($data) use ($searchValue) {
				$data->where('customer_name', 'like', '%' . $searchValue . '%')
				->orWhere('customer_address', 'like', '%' . $searchValue . '%')
				->orWhere('date_paid', 'like', '%' . $searchValue . '%')
                ->orWhere('mode_of_payment', 'like', '%' . $searchValue . '%')
                ->orWhere('amount_paid', 'like', '%' . $searchValue . '%')
                ->orWhere('status', 'like', '%' . $searchValue . '%')
                ->orWhereHas('memorial', function ($data) use ($searchValue) {
                    $data->where('memorial_name', 'LIKE', '%'.$searchValue.'%');
                    });
               
			});
			

		}
		$data = $data->paginate($length);
		return ['data' => $data, 'draw' => $request->input('draw')];

}

        public function update_client(Request $request,$id){

            $request->validate([
                // 'selectedProperty'   => 'required',
          
                'date_paid'        => 'required',
                'amount'        => 'required|integer',
                'acct_no'      => $request->mode_of_payment == 'Cash' ? 'nullable' : 'required',
                'mode_of_payment'        => 'required',
                'address'       => 'required',
                'contact_no'        => 'required',
                'client_name'        => 'required',
                'date_created'        => 'required',
                'date_paid'        => 'required',
           
            ]);
    
            $client =   Client::find($id);
            $now = Carbon::now()->format('Y');
         
            $client->date_created = $request->date_created;
            $client->customer_name = $request->client_name;
            $client->customer_address = $request->address;
            $client->contact_number = $request->contact_no;
            $client->customer_address = $request->address;
            $client->mode_of_payment = $request->mode_of_payment;
            $client->account_number = $request->acct_no;
           // $client->code_no = $request->code_no;
            $client->amount_paid = $request->amount;
            $client->date_paid = $request->date_paid;
         
            if ($request->hasFile('proofofpayment')) {
                $file = $request->file('proofofpayment');
                if ($file->isValid()) {
                    $now = Carbon::now();
                    $ext = $file->extension();
                    $rootName = str_replace(' ', '_', strtoupper($request->client_name));
                    $track = str_replace(' ', '_', $request->code_no);
                    $fileName = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
                    $file->move(public_path('client/' . $request->code_no), $fileName);
                    $client->proof_of_payment = $fileName;
                }
            }
            $client->save();
    
            return response()->json(['message' => 'Client Successfully Saved!']);
            



        }

        public function counts_client(){

            $overAll = Client::count();
            $soldMemorial = Client::where('status','=','Paid')->count();
            $totalAmount = Client::sum('amount_paid');
          
       
            return response()->json([
                'overAll' => $overAll,
                'soldMemorial' => $soldMemorial,
                'totalAmount' => $totalAmount,
              
              
            ]);
        
        }
       

        
}
