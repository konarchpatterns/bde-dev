<nav class="navbar navbar-expand-lg">
 
                   <a href="#"  class="nav-link cc" id="largesidebar"><i class="fa fa-chevron-right" style="font-size:20px;color:#E6A820"></i></a>
                <div class="container-fluid">
                   
                    <div class="navbar-minimize">
                            <button id="minimizeSidebarcos" class="btn btn-round btn-icon d-none d-lg-block" style="background-color: {{$temcolor}}">
                                <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                                <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                            </button>
                        </div>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                     
                        <ul class="navbar-nav ml-auto">

                              <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                 
                                    <i class="fa fa-bell" style=" font-size: 20px;"></i>
                               @if(Auth::user()->unreadNotifications->count() != 0)
                                    <span class="notification removenotification" id="notificationvalue"></span> 
                                @endif          
                                    <span class="d-lg-none">Notification</span>
                                </a>
                                <ul class="dropdown-menu" style="width:250px;background-color: #9A9B97;padding-top: 04px;padding-bottom: 04px;">
                                  <div class="text-center">
                                  <a href="{{route('markread')}}" class="" style="color:black;font-size: 13px;"><b>Mark all as Read</b></a></div>
                                
                                     <?php $pos=1 ?>
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                    @if($pos == 6)
                                           <?php  break; ?>
                                    @endif
                                    <div class="ddddd stopdropdownclose unreadnoti"   id="{{$notification->id}}" style="">{!!$notification->data['data']!!}</div>

                                      <?php  $pos++ ?>
                                    @endforeach
                                    @if($pos < 6)
                                      @foreach(auth()->user()->readNotifications as $notification)
                                       @if($pos == 6)
                                           <?php  break; ?>
                                       @endif
                                         <div class="stopdropdownclose readnoti"   id="{{$notification->id}}" style="" >{!!$notification->data['data']!!}</div>
                                      <?php  $pos++ ?>
                                      @endforeach
                                    @endif
                                    <div class="text-center" style="border-top: 2px solid #9FA296;">
                                    <a href="{{route('show.morenotification')}}" class="" id="myBtn" style="color: black;font-size: 13px;" ><b>Read more</b></a>
                                    </div>
                                </ul>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('login'))
              
                                @auth
                                  <li class="nav-item">
                                <a href="{{route('user.showprofile')}}" class="nav-link"><b> {{Auth::user()->name}}</b></a>
                                 </li> 
                              
                                 <li class="nav-item">
                                                    <a  class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" id="logoutsession">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf

                                    </form>
                                </li>
                                @else
                                 <li class="nav-item">
                                      <a class="nav-link" href="{{ route('login') }}" style="color: white">Login</a>
                                  </li>
                                @if (Route::has('register'))
                                 <li class="nav-item">
                                     <a class="nav-link" href="{{ route('register') }}" style="color: white">Register</a>
                                 </li>
                               @endif
                              @endauth
                   
                              @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>