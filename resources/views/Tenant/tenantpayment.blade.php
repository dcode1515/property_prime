@extends('layouts.template')
@section('content')
<div class="page-inner">
    <!-- Main Wrapper -->
    <div id="main-wrapper">
       <!--================================-->
       <!-- Breadcrumb Start -->
       <!--================================-->
                <div id ="app">
                    <Tenantpayment
                    :id="{{ json_encode($tenant->id) }}"
                    :tenantname="{{ json_encode($tenant->tenant_name)}}"
                    :contactno="{{ json_encode($tenant->contact_number)}}"
                    :tenantno="{{ json_encode($tenant->tenant_no)}}"
                    :address="{{ json_encode($tenant->address)}}"
                    :rounded="{{ json_encode($rounded) }}"
                    :rate="{{ json_encode($tenant->rate)}}"
                    :period="{{ json_encode($tenant->period)}}"
                    :duedate="{{ json_encode($tenant->duedate)}}"
                    :propertyname="{{ json_encode($tenant->property->property_name) }}"
                    :completeaddress="{{ json_encode($tenant->property->complete_address) }}"
                    :monthly="{{ json_encode($tenant->property->monthlyrate) }}"
                    :statustype="{{ json_encode($tenant->property->status_type) }}"
                    :propertyname="{{ json_encode($tenant->property->property_name) }}"
                    :propertyid="{{ json_encode($tenant->property->id) }}"
                    :payment="{{ json_encode($payment) }}"
                    
                    ><Tenantpayment>
                </div>   
       <!--/ Property End -->				  
    </div>
    <!--/ Main Wrapper End -->
 </div>
@endsection
