<div class="page-header">
    <div class="search-form">
       <form>
          <div class="input-group">
             <input class="form-control search-input typeahead" name="search" placeholder="Type something..." type="text"/>
             <span class="input-group-btn"><span id="close-search"><i data-feather="x" class="wd-16"></i></span></span>
          </div>
       </form>
    </div>
    <nav class="navbar navbar-default">
       <!--================================-->
       <!-- Brand and Logo Start -->
       <!--================================-->
       <div class="navbar-header">
          <div class="navbar-brand">
             <ul class="list-inline">
                <!-- Mobile Toggle and Logo -->
                <li class="list-inline-item"><a class="hidden-md hidden-lg" href="#" id="sidebar-toggle-button"><i data-feather="menu" class="wd-20"></i></a></li>
                <!-- PC Toggle and Logo -->
                <li class="list-inline-item"><a class=" hidden-xs hidden-sm" href="#" id="collapsed-sidebar-toggle-button"><i data-feather="menu" class="wd-20"></i></a></li>
            
             </ul>
          </div>
       </div>
       <!--/ Brand and Logo End -->
       <!--================================-->
       <!-- Header Right Start -->
       <!--================================-->
       <div class="header-right pull-right">
          <ul class="list-inline justify-content-end">
        
           
            <li class="list-inline-item dropdown">
               <a  href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="{{ URL::asset('public/images/users.png') }}" class="img-fluid wd-35 ht-35 rounded-circle" alt="">
               </a>
               <div class="dropdown-menu dropdown-menu-right dropdown-profile">
                  <div class="user-profile-area">
                     <div class="user-profile-heading">
                        <div class="profile-thumbnail">
                        
                           <img src="{{ URL::asset('public/images/users.png') }}" class="img-fluid wd-35 ht-35 rounded-circle" alt="">
                        </div>
                        <div class="profile-text">
                           <h6>{{Auth::user()->name}}</h6>
                           <span>{{Auth::user()->email}}</span>
                        </div>
                     </div>
                     {{-- <a href="" class="dropdown-item"><i data-feather="user" class="wd-16 mr-2"></i> My profile</a>
                     <a href="" class="dropdown-item"><i data-feather="message-square" class="wd-16 mr-2"></i> Messages</a>
                     <a href="" class="dropdown-item"><i data-feather="settings" class="wd-16 mr-2"></i> Settings</a>
                     <a href="" class="dropdown-item"><i data-feather="activity" class="wd-16 mr-2"></i> My Activity</a>
                     <a href="" class="dropdown-item"><i data-feather="download" class="wd-16 mr-2"></i> My Download</a>
                     <a href="" class="dropdown-item"><i data-feather="life-buoy" class="wd-16 mr-2"></i> Support</a> --}}
                     <a href="{{route('logout')}}" class="dropdown-item"><i data-feather="power" class="wd-16 mr-2"></i> Sign-out</a>
                  </div>
               </div>
            </li>
             <!-- Profile Dropdown End -->
          </ul>
       </div>
       <!--/ Header Right End -->
    </nav>
 </div>