 <div class="sidebar" data-color="{{ $sidecolor }}" data-image="{{ asset('assets/img/sidebar-2.jpg') }}">
     <!-- <div class="sidebar" id="aaa"  data-color="black" data-image="{{ asset('patternscrmdesign/assets/img/patternsimage.png') }}"> -->

     <div class="sidebar-wrapper">
         <div class="logo">
             <a href="#" class="simple-text logo-mini">
                 <img src="{{ asset('patternscrmdesign/assets/img/logo-dark.png') }}">
             </a>
             <a href="#" class="simple-text logo-normal">
                 Patterns
             </a>
         </div>
         <div class="user">
             <div class="photo d-flex align-items-center justify-content-center">
                 <span class="sidebar-mini">{{ ucfirst(substr(Auth::user()->name, 0, 1)) }}</span>
             </div>
             <div class="info">
                 <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                     <span style="text-transform: capitalize;">{{ Auth::user()->name }}
                         <b class="caret"></b>
                     </span>
                 </a>
                 <div class="collapse" id="collapseExample">
                     <ul class="nav">
                         <li>
                             <a class="profile-dropdown" href="{{ route('user.showprofile') }}">
                                 <span class="sidebar-mini">CP</span>
                                 <span class="sidebar-normal">Change Password</span>
                             </a>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
         {{-- <div class="logo" id="logocahange">
             <a href="{{ route('localeventindex1') }}" class="simple-text">
                 <img src="{{ asset('patternscrmdesign/assets/img/logo-dark.png') }}"> Patterns
             </a>
         </div> --}}
         <ul class="nav">
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('localeventindex1') }}" title="">
                     <i class="fa fa-tachometer"></i>
                     <p>Dashboard</p>
                 </a>
             </li>

             @permission('view.lead')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('lead.index') }}">
                         <i class="fa fa-file-text"></i>
                         <p>Leads</p>
                     </a>
                 </li>
             @endpermission
             @permission('view.company')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('company.index') }}">
                         <i class="fa fa-user"></i>
                         <p>Accounts</p>
                     </a>
                 </li>
             @endpermission

             @if (Auth::user()->hasRole('data.entry') || Auth::user()->hasRole('data.entry.manager'))
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('company.dataoperatoranydata') }}">
                         <i class="fa fa-user"></i>
                         <p>Data Accounts</p>
                     </a>
                 </li>
             @endrole
             @if (Auth::user()->hasRole('data.entry') || Auth::user()->hasRole('data.entry.manager'))

                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('company.create') }}">
                         <i class="fa fa-user-plus"></i>
                         <p>Create Account</p>
                     </a>
                 </li>
             @endif
             @permission('view.client')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('client.index') }}">
                         <i class="fa fa-address-book"></i>
                         <p>Contacts</p>
                     </a>
                 </li>
             @endpermission
             @permission('view.logs')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('avtivity.index') }}">
                         <i class="fa fa-list" aria-hidden="true"></i>
                         <p>Logs</p>
                     </a>
                 </li>
             @endpermission
             @permission('view.click.client')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('clients.index') }}">
                         <i class="fa fa-list" aria-hidden="true"></i>
                         <p>Click Clients (Retention)</p>
                     </a>
                 </li>
             @endpermission
             @permission('view.click.new.client')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('clickclients.clicknewcompany') }}">
                         <i class="fa fa-list-alt" aria-hidden="true"></i>
                         <p>Click Clients (New)</p>
                     </a>
                 </li>
             @endpermission
             @if (Auth::user()->name == 'Shraddha Damaniya' || Auth::user()->name == 'Krunal Machhi' || Auth::user()->name == 'Kalyan Patil' || Auth::user()->name == 'Himanshu Sheth')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('clients.index') }}">
                         <i class="fa fa-list" aria-hidden="true"></i>
                         <p>Click Client</p>
                     </a>
                 </li>
             @endif
             @permission('view.users')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('userinfo.index') }}">
                         <i class="fa fa-id-card-o"></i>
                         <p>Users Summary</p>
                     </a>
                 </li>
             @endpermission
             @role('data.entry.manager')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('userinfo.index') }}">
                         <i class="fa fa-id-card-o"></i>
                         <p>Users Summary</p>
                     </a>
                 </li>
             @endrole
             @permission('view.role')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('role.index') }}">
                         <i class="fa fa-user-secret" aria-hidden="true"></i>
                         <p>Roles</p>
                     </a>
                 </li>
             @endpermission
             @permission('view.permission')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('permission.index') }}">
                         <i class="fa fa-lock"></i>
                         <p>Permission</p>
                     </a>
                 </li>
             @endpermission
             @permission('view.email')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('mail.index') }}">
                         <i class="fa fa-envelope-o"></i>
                         <p>Emails</p>
                     </a>
                 </li>
             @endpermission
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('localeventindex1') }}">
                     <i class="fa fa-calendar-o"></i>
                     <p>Calendar</p>
                 </a>
             </li>
             @permission('view.users')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('user.index') }}">
                         <i class="fa fa-users"></i>
                         <p>Users</p>
                     </a>
                 </li>
             @endpermission


             @if (Auth::user()->hasRole('accounts.portal.data') || Auth::user()->hasRole('admin'))
                 <li class="nav-item @if (Route::is('viewPortal')) active @endif">
                     <a class="nav-link" href="{{ route('viewPortal') }}">
                         <i class="fa fa-users"></i>
                         <p>Accounts Portal</p>
                     </a>
                 </li>
             @endif


             @permission('show.csv.list')
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('csvseat.csvnameindex') }}">
                         <i class="fa fa-users"></i>
                         <p>Csv list</p>
                     </a>
                 </li>
             @endpermission
             {{-- <li>
                 <a class="nav-link" href="{{ route('mail.candi') }}">
                     <i class="fa fa-user"></i>
                     <p>Candidateform</p>
                 </a>
             </li> --}}
     </ul>
 </div>
</div>
