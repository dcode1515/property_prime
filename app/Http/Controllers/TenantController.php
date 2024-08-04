<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Property;
use App\Models\PaymentTenant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use ZipArchive;
use Auth;
use File;
use Dompdf\Dompdf;
use PDF;


class TenantController extends Controller
{
    //

    public function tenant(){
        return view('Tenant.tenant');
    }

    public function getPropertyAvailable(){
        $property  = Property::where('status','=','Available')->get();
        return response()->json($property);

    }
    public function store_tenant(Request $request){

        $request->validate([
            'selectedProperty'   => 'required',
            'tenant_name'        => 'required',
            'contact_no'         => 'required',
             'address'            => 'required',
            'monthly_rate'        => 'required',
            'date_created'        => 'required',
            'lease_period'       => 'required',
            'due_date'           => 'required',
            'contracts'          => 'required|mimes:pdf',
            'id1'                => 'required|mimes:png,jpeg',
            'id2'                => 'required|mimes:png,jpeg',
        ]);

        $tenant  = new Tenant;
        $now = Carbon::now()->format('Y');
        $tenant_no = Tenant::IDGenerator(new Tenant,'tenant_no', 4,$now);
        $tenant->tenant_no = $tenant_no;
        $tenant->property_id = $request->selectedProperty;
        $tenant->tenant_name = $request->tenant_name;
        $tenant->address = $request->address;
        $tenant->contact_number = $request->contact_no;
        $tenant->rate = $request->monthly_rate;
        $tenant->period = $request->lease_period;
        $tenant->duedate = $request->due_date;
        $tenant->status = "Rented";
        $tenant->date_created = $request->date_created;

      
        $fileTypes = ['contracts', 'id1', 'id2'];

        foreach ($fileTypes as $fileType) {
            if ($request->hasFile($fileType)) {
                $file = $request->file($fileType);
        
                if ($file->isValid()) {
                    $now = Carbon::now();
                    $ext = $file->extension();
                    $rootName = str_replace(' ', '_', strtoupper($request->tenant_name));
                    $track = str_replace(' ', '_', $tenant_no);
        
                    // Adjust filename based on file type
                    $fileName = $now->year . '-' . $rootName . '.' . $track . '.' . $fileType . '.' . $ext;
        
                    $file->move(public_path('tenant/' . $tenant_no), $fileName);
        
                    // Assuming you have a property model instance
                    $tenant->$fileType = $fileName;
                }
            }
        }


        
        if($tenant->save()){

            $property = Property::find($request->selectedProperty);
            $property->status ="Occupied";
            $property->save();

        }

        return response()->json(['message','Tenant Added!']);


    }

    public function update_tenant(Request $request,$id){

        $request->validate([
            // 'selectedProperty'   => 'required',
            'tenant_name'        => 'required',
            'contact_no'         => 'required',
            'address'            => 'required',
            'monthly_rate'        => 'required',
            'lease_period'       => 'required',
            'due_date'           => 'required',
            // 'contracts'          => 'required|mimes:pdf',
            // 'id1'                => 'required|mimes:png,jpeg',
            // 'id2'                => 'required|mimes:png,jpeg',
        ]);

        $tenant  =  Tenant::find($id);
    //    $tenant->property_id = $request->selectedProperty;
    
        $now = Carbon::now()->format('Y');
        $tenant->tenant_name = $request->tenant_name;
        $tenant->address = $request->address;
        $tenant->contact_number = $request->contact_no;
        $tenant->rate = $request->monthly_rate;
        $tenant->period = $request->lease_period;
        $tenant->duedate = $request->due_date;
        $tenant->date_created = $request->date_created;
        // $tenant->tenant_no      =   $request->tenant_no;

      
        
        $attachments = ['contracts', 'id1', 'id2'];

        foreach ($attachments as $attachment) {
            if ($request->hasFile($attachment)) {
                $file = $request->file($attachment);
             
                if ($file->isValid()) {
                    $ext = $file->extension();
                    $now = Carbon::now();
                    $rootName = str_replace(' ', '_', strtoupper($request->tenant_name));
                    $track = str_replace(' ', '_', $request->tenant_no);
                    $fileName = $now->year . '-' . $rootName . '.' . $track . '.' . $ext;
                    $file->move(public_path('tenant/' . $request->tenant_no), $fileName);
        
                    // Set the file name in the corresponding property of the $tenant object
                    $tenant->{$attachment} = $fileName;
                }
            }
        }

     

        $tenant->save();

        return response()->json(['message','Tenant Added!']);


    }

    public function get_tenant(Request $request){
        
		$columns = ['tenant_name', 'address','contact_no','status'];
		$length = $request->input('length');
		$column = $request->input('column');
		$dir = $request->input('dir');
		$searchValue = $request->input('search');
		$data = Tenant::with('property')->withCount('paymenttenants')->orderBy($columns[$column], $dir);

		if($searchValue){
			$data->where(function($data) use ($searchValue) {
				$data->where('tenant_name', 'like', '%' . $searchValue . '%')
				->orWhere('address', 'like', '%' . $searchValue . '%')
				->orWhere('contact_number', 'like', '%' . $searchValue . '%')
                ->orWhere('rate', 'like', '%' . $searchValue . '%')
                ->orWhere('period', 'like', '%' . $searchValue . '%')
                ->orWhere('duedate', 'like', '%' . $searchValue . '%')
                ->orWhereHas('property', function ($data) use ($searchValue) {
                    $data->where('property_name', 'LIKE', '%'.$searchValue.'%');
                    });
           
			
			});
			

		}
		$data = $data->paginate($length);
		return ['data' => $data, 'draw' => $request->input('draw')];

}

public function download_attachment($id)
{

    $tenant = Tenant::find($id);

    $zip = new ZipArchive;
    $fileName = public_path('tenant/' . $tenant->tenant_name . '_Attachment.zip');
    
    if ($zip->open($fileName, ZipArchive::CREATE) === TRUE) {
        // Add files from the tenant directory
        $files = File::files(public_path('tenant/' . $tenant->tenant_no));
        foreach ($files as $key => $value) {
            $relativeNameInZipFile = basename($value);
            $zip->addFile($value, $relativeNameInZipFile);
        }
    
        // Close the zip archive
        $zip->close();
    
        // Download the zip file
        return response()->download($fileName);
    } else {
        // Handle the case where the zip archive could not be created
        return response()->json(['error' => 'Unable to create the zip archive'], 500);
    }
}

public function delete_tenant(Request $request, $id)
    {
        $tenant = Tenant::find($id);

        if (!$tenant) {
            return response()->json(['message' => 'Tenant not found'], 404);
        }

        // Soft delete the property
        $tenant->delete();

        return response()->json(['message' => 'Tenant soft-deleted successfully']);
    }

    public function tenant_count(){
        $overallcount = Tenant::count();
        $rentedcount  = Tenant::where('status','=','Rented')->count();
        $extenantcount = Tenant::where('status','=','Extenant')->count();
        return response()->json(['overallcount' => $overallcount,'rentedcount' => $rentedcount,'extenantcount' => $extenantcount,]);

    }

    public function payment (){
        return view('Tenant.payment');
    }

    public function view_tenant_payment($id){

        $tenant = Tenant::find($id);
        $payment  = PaymentTenant::where('tenant_id','=',$tenant->id)->orderBy('created_at','desc')->get();
        $now = Carbon::now()->format('Y');
        $text = "INV";
        $rounded = PaymentTenant::IDGenerator(new PaymentTenant, 'invoice', 4, $text . $now);
       // return $payment;
        return view('Tenant.tenantpayment', compact('tenant', 'rounded','payment'));

    }


    public function store_tenant_payment(Request $request){

        $request->validate([
            // 'selectedProperty'   => 'required',
            'proofofpayment' => 'required|mimes:png,jpeg,pdf',
            'accountNumber'      => $request->paymentmode == 'Cash' ? 'nullable' : 'required',
            'date_paid'        => 'required',
            'amount'       => 'required',
            'paymentmode'        => 'required',

          
       
           
          
        ]);
        
        $payment = new PaymentTenant;
     //   $now = Carbon::now()->format('Y-m-d');
        $invoice = Carbon::now()->format('Y');
        $text = "INV";
        $invoice_no = PaymentTenant::IDGenerator(new PaymentTenant,'invoice', 4,$text.$invoice);
        $payment->invoice  =   $invoice_no;
        $payment->tenant_id = $request->id;
        $payment->mode_of_payment = $request->paymentmode;
        $payment->acctno = $request->accountNumber;
        $payment->date_paid = $request->date_paid;
        $payment->amount = $request->amount;
        $payment->property_id = $request->propertyid;
    
        $payment->user_id = Auth::user()->id;
        $payment->status = "Paid";

        if($request->hasFile('proofofpayment')){
			$now = Carbon::now();
			$ext = $request->file('proofofpayment')->extension();
			$rootName = str_replace(' ', '_',strtoupper($request->paymentmode));
			$track = str_replace(' ', '_', $invoice_no);
			$fileName = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
			$request->proofofpayment->move(public_path('tenant/'.$request->tenantno), $fileName);
		}
        $payment->paymentproof = $fileName;
        
        if($payment->save()){

            $tenant = Tenant::find($request->id);
            if ($tenant) {
                // Convert the date_paid string to a Carbon instance
                $datePaid = Carbon::parse($request->date_paid);
                // Update duedate based on date_paid
                $tenant->duedate = $datePaid->addMonth(1);
                $tenant->save();

            }

        }


        
        if ($payment) {
            return response()->json(['status' => 'Tenant Payment Successfully Saved'], 200);
        } else {
            return response()->json(['error' => 'Something went Wrong. Please Try Again'], 202);
        }


    }

    public function update_payment_tenant(Request $request,$id){
        
        $request->validate([
            // 'selectedProperty'   => 'required',
            // 'proofofpayment' => 'required|mimes:png,jpeg,pdf',
            'accountNumber'      => $request->paymentmode == 'Cash' ? 'nullable' : 'required',
            'amount'       => 'required',
            'paymentmode'        => 'required',
          
       
           
          
        ]);
        
        $payment =  PaymentTenant::find($id);
        $payment->mode_of_payment = $request->paymentmode;
        $payment->acctno = $request->accountNumber;
        $payment->amount = $request->amount;
        $payment->date_paid = $request->date_paid;
    
        if($request->hasFile('proofofpayment')){
			$now = Carbon::now();
			$ext = $request->file('proofofpayment')->extension();
			$rootName = str_replace(' ', '_',strtoupper($request->paymentmode));
			$track = str_replace(' ', '_', $invoice_no);
			$fileName = $now->year. '-'. $rootName.'.'. $track.'.' .$ext;
			$request->proofofpayment->move(public_path('tenant/'.$request->tenantname), $fileName);
            $payment->paymentproof = $fileName;
        }
     
        if($payment->save()){

            $tenant = Tenant::find($request->id);
            if ($tenant) {
                // Convert the date_paid string to a Carbon instance
                $datePaid = Carbon::parse($request->date_paid);
                // Update duedate based on date_paid
                $tenant->duedate = $datePaid->addMonth(1);
                $tenant->save();

            }

        }

        
        if ($payment) {
            return response()->json(['status' => 'Tenant Payment Successfully Updated'], 200);
        } else {
            return response()->json(['error' => 'Something went Wrong. Please Try Again'], 202);
        }

    }

    public function totalAmountPayment($date = null){

        $formattedDate = $date ? Carbon::parse($date)->toDateString() : now()->toDateString();

        // Calculate total amount for all records
        $totalAmount = PaymentTenant::sum('amount');
        $totalAmountDaily = PaymentTenant::whereDate('date_paid', $formattedDate)->sum('amount');
        $totalAmountMonthly = PaymentTenant::whereMonth('date_paid', Carbon::now()->month)->sum('amount');
        $totalAmountYearly = PaymentTenant::whereYear('date_paid', Carbon::now()->year)->sum('amount');
    
        return response()->json([
            'totalAmount' => $totalAmount,
            'totalAmountDaily' => $totalAmountDaily,
            'totalAmountMonthly' => $totalAmountMonthly,
            'totalAmountYearly' => $totalAmountYearly
        ]);


    }

    public function getOverdueTenantCount()
    {
        // Get the current date
        $currentDate = Carbon::now()->toDateString();

        // Count the number of tenants with a due date less than or equal to the current date
        $overdueCount = Tenant::whereDate('duedate', '<=', $currentDate)->count();
        return response()->json(['overdueCount' => $overdueCount]);
    }

    public function print_payment($id){

        $tenant  = Tenant::find($id);
        $tenantpayment = PaymentTenant::where('tenant_id','=',$tenant->id)->orderBy('created_at','desc')->get();
        return PDF::loadView('Tenant.print',compact('tenant','tenantpayment'))->setPaper('Legal', 'portrait')->stream('Print Payment.pdf');

    }

    public function reports(){
        return view('Tenant.reports_payment');
    }

 
    public function filterData(Request $request)
    {
        $reportType = $request->input('report_type');
        $modeOfPayment = $request->input('mode_of_payment');
    
        $payments = PaymentTenant::with('tenant')->orderBy('created_at','desc');
        if ($reportType == 'Daily Income') {
            $payments->whereDate('date_paid', now()->toDateString());
        } 
        elseif ($reportType == 'Monthly Income') {
            $payments->whereMonth('date_paid', now()->month);
        } elseif ($reportType == 'Yearly Income') {
            $payments->whereYear('date_paid', now()->year);
        } elseif ($reportType == 'Customize') {
            $startDate = $request->input('start_date');
            $endDate = $request->input('start_to');
            $payments->whereBetween('date_paid', [$startDate, $endDate]);
        }
    
        if ($modeOfPayment != 'All') {
            $payments->where('mode_of_payment', $modeOfPayment);
        }else {
            $filteredPayments = $payments->get(); // Retrieve all records without any conditions
        }
    
        $filteredPayments = $payments->get();
  
        
        return response()->json($filteredPayments);
    }


        public function generatePDF(Request $request)
        {
            try {
                // Assuming you have a method to get filtered data
                $filteredPayments = $this->filterData($request);
    
                // Generate PDF using DomPDF
                $pdf = PDF::loadView('Tenant.report', compact('filteredPayments'))->setPaper('Legal', 'portrait');
    
                // Get the PDF content as a base64 encoded string
                $pdfContent = base64_encode($pdf->output());
    
                // Log PDF content for debugging
                \Log::info('PDF Content: ' . $pdfContent);
    
                // Return the base64 encoded string
                return response()->make($pdfContent, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="Print_Payment.pdf"',
                ]);
            } catch (\Exception $e) {
                // Log any exceptions for debugging
                \Log::error('Error generating PDF: ' . $e->getMessage());
    
                // Return an error response
                return response()->json(['error' => 'Error generating PDF'], 500);
            }

            
                
        }
      

  
   
    
}
