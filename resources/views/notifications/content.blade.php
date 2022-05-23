<div class="">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <div class="card bg-light">
                 <div class="card-header text-center font-weight-bold text-danger">Notifications
                    <button class="btn btn-fill btn-info rightdiv mb-1" onclick="location.href = document.referrer; return false;">Back</button></div>
                <div class="card-body">
                    <div class="scrollable">

                    <table id="customers" class="text-center">
                     <thead >
                        <tr>
                           
                           
                      </thead>

                        </tr>
                          @php
                            $i=1; 
                          @endphp
                          <tbody>  
                    @foreach(auth()->user()->Notifications as $notification)

                        <tr>
                           
                                @if($notification->read_at != "")
                                <td>
                                <div class="stopdropdownclose readnoti text-center"   id="{{$notification->id}}" align="center" >{!!$notification->data['data']!!}</div>
                                @else
                                </td>
                                <td >
                                <div class=" ddddd stopdropdownclose unreadnoti text-center"   id="{{$notification->id}}" >{!!$notification->data['data']!!}</div>
                                </td>
                                @endif
                            </td>
                           
                        </tr>
                    @endforeach
                      </tbody> 
                    </table>
                    </div>
                </div>  
            </div>           
        </div>
        <div class="col-md-1">
             
        </div>
    </div>
</div>

