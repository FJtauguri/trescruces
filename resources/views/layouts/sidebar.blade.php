<div class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark">
       <button class="border-0 btn order-lg-0 ms-2 m-0 me-lg-0 text-black" style="background-color:rgb(255, 245, 153)!important;" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
       <a class="ms-3 navbar-brand d-flex align-items-center text-white fw-bold" href="/">
         @php
         use App\Models\GeneralConf;
 
         // Fetch the configuration data
         $generalConfig = GeneralConf::first();
     @endphp
          <img height="50" style=" border-radius:50%;" src="{{ asset('assets/head_logo/' . ($generalConfig->logo ?? 'default-logo.png')) }}" alt="Logo">
          <div class="d-md-block ps-2">
             <p class="mb-0 cstm-text-sm" style="font-size: 14px">{{ $generalConfig->title ?? 'Default Title' }}</p>
          </div>
       </a>
       <!-- Right Aligned User Info and Dropdown -->
    <div class="ms-auto me-3">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <!--<img src="./assets/imgs_uploads/" alt="User" width="20" height="20" class="rounded-circle me-2">-->
                <img class="img-fluid rounded-circle me-2" alt="User Photo" width="40" height="40" 
                     src="{{ asset('profile_pic/' . (Auth::user()->userinfos->profile_pic ?? 'default-avatar.png')) }}">

                <!--<strong>{{ Auth::user()->lname }}</strong>-->
            </a>
            <!-- Dropdown menu with responsive positioning -->
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow dropdown-menu-end dropdown-menu-start-sm" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="{{ route('my-activity') }}">Activity Log</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Sign out
                    </a>
                </li>                
            </ul>
        </div>
    </div>
    </nav>
    <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav" style="background-color:white;border-right:1px solid rgb(0,0,0,0.2);" id="sidenavAccordion">
       <div class="sb-sidenav-menu">
          <div class="nav">
             <div>
                <img class="img-fluid" src="{{ asset('assets/imgs/bg-img1.png') }}">
             </div>
             <div class="sb-sidenav-menu-heading">Main Navigation</div>
             @auth
             @if (auth()->user()->hasRole('staff'))
             <a class="nav-link" href="{{route('staff.dashboard')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fas fa-house-chimney-window"></i></div>
                Dashboard
             </a>
             @endif 
             @endauth
             @auth
             @if (auth()->user()->hasRole('admin'))
             <a class="nav-link" href="{{route('dashboard')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fas fa-house-chimney-window"></i></div>
                Dashboard
             </a>
             <a class="nav-link" href="{{route('staff.view')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-users"></i></div>
                Staff
             </a>
             
             <a class="nav-link" href="{{route('resident.view')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-users"></i></div>
                Resident
             </a>
             <a class="nav-link" href="{{route('settings.view')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-gears fa-rotate-90"></i></div>
                Settings
             </a>
             @endif
             @endauth
             @auth
             @if (auth()->user()->hasRole('staff'))
             <a class="nav-link" href="{{route('staff.settingss')}}">
               <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-gears fa-rotate-90"></i></div>
               Settings
            </a>
            <a class="nav-link" href="{{route('staff.resident-lists')}}">
               <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-gears fa-rotate-90"></i></div>
              Resident List
            </a>
            @endif 
            @endauth
            
            <a class="nav-link" href="{{route('admin.event-calendar')}}">
               <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-calendar fa-rotate-90"></i></div>
              Event Calendar
            </a>
            <a class="nav-link collapsed" id="monr" href="#" data-bs-toggle="collapse" data-bs-target="#monr2_dropdown" aria-expanded="false" aria-controls="monr2_dropdown">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-code-pull-request"></i></div>
                Monitoring Request
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
             </a>
             <div class="collapse monr" id="monr2_dropdown" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav" style="background-color:rgb(238, 216, 137,0.4);">
                    <!-- <a class="nav-link" href="admin&v=monr_wir">Walk in request</a> -->
                    <a class="nav-link" href="{{route('pending.mon')}}">Pending Request</a>
                    <a class="nav-link" href="{{route('approved.mon')}}">Approved Request</a>
                    <a class="nav-link" href="{{route('declined.mon')}}">Decline Request</a>
                </nav>
             </div>
             @auth
             @if (auth()->user()->hasRole('admin'))
             <div class="sb-sidenav-menu-heading">Monitoring Request</div>
             <a class="nav-link" href="{{ route('requestlog-view')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-regular fa-paste"></i></div>
                Requests logs
             </a>
             
             <a class="nav-link" href="{{route('all-logs')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-shoe-prints"></i></div>
                All logs
             </a>
             
             @endif
             @endauth 
             <div class="sb-sidenav-menu-heading">Website</div>
             <a class="nav-link" href="{{route('admin.unverified.users')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-user-check"></i></div>
                Validate Accounts
                <livewire:unverified-user-counter />
             </a>
             <a class="nav-link" href="{{route('records.index')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-file-pen"></i></div>
                Records
             </a>
             <a class="nav-link nav-link-container" href="{{ route('chat.index') }}">
               <div class="sb-nav-link-icon">
                   <i class="cstm-colorz fa-regular fa-comments"></i>
               </div>
               <span>Messages</span>@livewire('unread-messages-badge')
            </a>
             <a class="nav-link" href="{{route('view-reportfiled')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-file-pen"></i></div>
                Reports    @livewire('report-badge')
             </a>
            <a class="nav-link" href="{{route('announcements.indexpage')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-bullhorn"></i></div>
                Announcement
             </a>
             <a class="nav-link" href="{{ route('program.adminview')}}">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-code-pull-request"></i></div>
                Programs
             </a>
              <a class="nav-link" href="{{ route('official.index') }}">
               <div class="sb-nav-link-icon">
                  <i class="cstm-colorz fa-solid fa-user-tie"></i> 
               </div>
               List of Officials
            </a>
             <a class="nav-link" href="{{ route('servicetype.adminview') }}">
               <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-code-pull-request"></i></div>
              Service Type
            </a>
             
             <a class="nav-link collapsed" id="news_anoucement" href="#" data-bs-toggle="collapse" data-bs-target="#cms_dropdown" aria-expanded="false" aria-controls="cms_dropdown">
                <div class="sb-nav-link-icon"><i class="cstm-colorz fa-solid fa-file-pen"></i></div>
                Content Management
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
             </a>
             <div class="collapse news_anoucement" id="cms_dropdown" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav" style="background-color:rgb(238, 216, 137,0.4);">
                    <a class="nav-link" href="{{route('general.cms')}}">General</a>
                    <a class="nav-link" href="{{route('navlink-cms')}}">Nav links</a>
                    <a class="nav-link" href="{{route('cmspages.index')}}">Pages</a>
                    <a class="nav-link d-none" href="admin&v=cms_new_page"></a>
                    <a class="nav-link d-none" href="admin&v=cms_edit_page"></a>
                </nav>
             </div>
             <br>
          </div>
       </div>
       <div class="sb-sidenav-footer">
          
    </nav>
    <!-- CSS for Mobile Scrollable Sidebar -->
<style>
    @media (max-width: 768px) {
        #layoutSidenav_nav {
            height: 100vh;
            overflow-y: auto;
        }
        .sb-sidenav-menu {
            max-height: calc(100vh - 100px); /* Adjust based on the header height */
            overflow-y: auto;
        }
    }
</style>
    </div>