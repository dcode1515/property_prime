@extends('layouts.template')
@section('content')
<div class="page-inner">
    <!-- Main Wrapper -->
    <div id="main-wrapper">
       <!--================================-->
       <!-- Breadcrumb Start -->
       <!--================================-->
                <div id ="app">
                    <Memorialclient
                    :id="{{ json_encode($memorial->id) }}"
                    :memorialno="{{ json_encode($memorial->memorial_no)}}"
                    :memorialname="{{ json_encode($memorial->memorial_name)}}"
                    :memorialaddress="{{ json_encode($memorial->memorial_address)}}"
                    ><Memorialclient>
                </div>   
       <!--/ Property End -->				  
    </div>
    <!--/ Main Wrapper End -->
 </div>
@endsection
