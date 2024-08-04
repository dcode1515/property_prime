<div class="page-sidebar-inner">
    <div class="page-sidebar-menu">
        <ul class="accordion-menu">
            <!-- <li class="mg-l-20-force mg-t-25-force menu-navigation">Navigation</li> -->
            <!-- <li class="open active">
                <a href=""><i data-feather="home"></i>
                    <span>Dashboard</span><i class="accordion-icon fa fa-angle-left"></i></a>
                <ul class="sub-menu" style="display: block;">
                  
                    <li class="active"><a href="index.html">Property</a></li>
                  

                </ul>
            </li> -->

            <li class="mg-l-20-force mg-t-25-force menu-extras">Real State</li>
           
            <li>
               <a href=""><i data-feather="codepen"></i>
               <span>Property</span><i class="accordion-icon fa fa-angle-left"></i></a>
               <ul class="sub-menu">
                      <!-- <ul class="sub-menu" style="display: block;"> -->
               <li><a href="{{route('property')}}">Property</a></li>
                    <li><a href="{{route('tenant')}}">Tenant</a></li>
                    <li><a href="{{route('tenant.payment')}}">Payment</a></li>
                    <li><a href="{{route('reports.property')}}">Reports</a></li>
                
               </ul>
            </li>
            <li>
               <a href=""><i data-feather="folder"></i>
               <span>Memorial</span><i class="accordion-icon fa fa-angle-left"></i></a>
               <ul class="sub-menu">
                  <li><a href="{{route('memorial')}}">Memorial</a></li>
                  <li><a href="{{route('client')}}">Client</a></li>
                  {{-- <li><a href="aut-signin.html">Reports</a></li> --}}
                
               </ul>
            </li>
            
            {{-- <li class="mg-l-20-force mg-t-25-force menu-extras">Extras</li> --}}
            {{-- <li>
               <a href=""><i data-feather="users"></i>
               <span>User Account</span><i class="accordion-icon fa fa-angle-left"></i></a>
               <ul class="sub-menu">
                  <li><a href="#">User List</a></li>
                  <li><a href="#">User Role</a></li>
                  <li><a href="#">User Permission</a></li>
                
               </ul>
            </li> --}}

            <li class="mg-l-20-force mg-t-25-force menu-others">Others</li>
            
            <li>
                <a href="{{ url('public/usersmanual/Users Manual.pdf') }}"  target="_blank"><i data-feather="coffee"></i>
                    <span>User's Manual</span></a>
            </li>
        </ul>
    </div>
</div>
