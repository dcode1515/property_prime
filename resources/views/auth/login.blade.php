<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
   
	<link href="{{ URL::asset('public/assets_login/vendor/fonts/boxicons.css') }}" rel="stylesheet" type="text/css">

    <!-- Core CSS -->
	<link href="{{ URL::asset('public/assets_login/vendor/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('public/assets_login/vendor/css/theme-default.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('public/assets_login/vendor/css/demo.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('public/assets_login/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css">
 	<link href="{{ URL::asset('public/assets_login/vendor/css/pages/page-auth.css') }}" rel="stylesheet" type="text/css">
	 <link href="{{ URL::asset('public/metrical-main/light/assets/plugins/font-awesome/css/font-awesome.min.css' ) }}" rel="stylesheet" type="text/css"> 
    <!-- Helpers -->
	<script src="{{ asset('public/assets_login/vendor/js/helpers.js') }}"></script>
	<link href="{{ URL::asset('public/avesta-main/html/assets/css/style.css') }}" rel="stylesheet" type="text/css">
   
	<script src="{{ asset('public/assets_login/js/config.js') }}"></script>
   
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->


		  <div id = "app">
			<Login><Login>
		  </div>	
         
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

   

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
	<script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/assets_login/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('public/assets_login/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('public/assets_login/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/assets_login/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('public/assets_login/vendor/js/menu.js') }}"></script>
	<script src="{{ asset('public/assets_login/js/main.js') }}"></script>
  

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
