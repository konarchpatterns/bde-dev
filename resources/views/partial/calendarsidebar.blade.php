<div class="sidebar a" id="aaa"  data-color="black" data-image="{{asset('patternscrmdesign/assets/img/patternsimage.png')}}">
            
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo" id="logocahange"> 
                    <a href="#" class="simple-text">
                       <img src="{{asset('patternscrmdesign/assets/img/logo-dark.png')}}"> Patterns
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard.index')}}" title="">
                            <i class="fa fa-tachometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('company.index')}}">
                          <i class="fa fa-user"></i>
                            <p>Account</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('avtivity.index')}}">
                          <i class="fa fa-list" aria-hidden="true"></i>
                            <p>Logs</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('client.index')}}">
                            <i class="fa fa-address-book"></i>
                            <p>Contacts</p>
                        </a>
                    </li>
                     <li>
                        <a class="nav-link" href="{{route('lead.index')}}">
                            <i class="fa fa-file-text"></i>
                            <p>Leads</p>
                        </a>
                    </li>
                   <!-- <li>
                        <a class="nav-link" href="{{route('opportunity.index')}}">
                            <i class="fa fa-usd"></i>
                            <p>Opportunities</p>
                        </a>
                    </li> -->
                    <li> 
                        <a class="nav-link" href="#">
                            <i class="fa fa-briefcase"></i>
                            <p>Cases</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('role.index')}}">
                            <i class="fa fa-users"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('permission.index')}}">
                            <i class="fa fa-lock"></i>
                            <p>Permission</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('mail.index')}}">
                            <i class="fa fa-envelope-o"></i>
                            <p>Emails</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ URL::to('events')}}">
                            <i class="fa fa-calendar-o"></i>
                            <p>Calendar</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('meeting.index')}}">
                            <i class="fa fa-calendar-check-o"></i>
                            <p>Meetings</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">
                            <i class="fa fa-phone"></i>
                            <p>Calls</p>
                        </a>
                    </li>
                  <!--   <li>
                        <a class="nav-link" href="#">
                            <i class="fa fa-tasks"></i>
                            <p>Tasks</p>
                        </a>
                    </li> -->
                    <li>
                        <a class="nav-link" href="{{route('user.index')}}">
                            <i class="fa fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                   <!--  <li>
                        <a class="nav-link" href="#">
                            <i class="fa fa-university"></i>
                            <p>Departments</p>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
