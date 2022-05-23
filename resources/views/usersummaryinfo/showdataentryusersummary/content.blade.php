<div class="">
  <div class="row">
        <div class="col-md-9">
            <h5><a href="{{route('userinfo.index')}}"><b>Summary Report</b></a> <i class="fa fa-angle-double-right "></i>{{$user->name}}</h5> 
            <input type="hidden" name="userid" value="{{$user->id}}" id="useridid">         
        </div>
        <div class="col-md-3">
           
            <a href="{{route('userinfo.index')}}" class=" btn btn-info rightdiv mb-2">Back</a>
             
        </div>
    </div>
    <div class="row">
                        <div class="col-md-5 col-sm-5">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                      <div class="col-12">
                                            <div class="">
                                      
                                                <h4 class="card-title">Total Company</h4>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="icon-big text-center icon-warning">
                                                {{$numberofcompanycount}}
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                    
                            </div>
                      <!--   </div>
                        <div class="col-md-6 col-sm-6"> -->
                             <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                      <div class="col-12">
                                            <div class="">
                                             
                                                <h4 class="card-title" >Company  Created at <sapn id="createdtitle">{{$todayus->toDateString()}} </sapn></h4>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="icon-big text-center icon-warning">
                                               <span id="showtodaycompany">{{$todaycompnycount}}</span>
                                               
                                            </div>
                                        </div>
                                         <div class="col-md-3 mb-1">
                                            
                                               
                                               <div id="datepicker"></div>
                                           
                                        </div>
                                    </div>
                                </div>
                             
                        </div>
                      </div>
            <div class="col-md-4">
                <label>Month : </label>
                <?php 
                   $monthno=1;
                ?>
             <select class="mb-1" id="companymonthid">
                @foreach($monthtitle as $month)
                   @if($monthcount == $monthno)
                        <option value="{{$monthno++}}" selected="">{{$month}}</option>
                   @else
                        <option value="{{$monthno++}}">{{$month}}</option>
                   @endif
                @endforeach
             </select>&nbsp;&nbsp;&nbsp;&nbsp;
             <label> Year : </label>
             <select class="mb-1" id="companyyearid"><option>2021</option><option>2022</option><option>2023</option></select>
             <h5 align="center"><b>Company Count ( <span id="monthshowid"></span> )</b></h5>
                <table id="roles" style="width:100%">
                    <thead>
                        <tr>
                            <td><b>Month</b></td>
                            <td><b>Count</b></td>
                        </tr>
                    </thead>
                    <tbody class="monthcompid">
                        {!!$companycounttabledatewise!!}
                    </tbody>
                    
                </table>
            </div>
            <div class="col-md-3">
             
             <h5 align="center"><b>Company Count</b></h5>
                <table id="roles" style="width:100%">
                    <thead>
                        <tr>
                            <td><b>Month</b></td>
                            <td><b>Count</b></td>
                        </tr>
                    </thead>
                    <tbody class="dispositionreport">
                        {!!$companycounttable!!}
                    </tbody>
                    
                </table>
            </div>
            <div class="col-md-4">
             
             <h5 align="center"><b>Reports</b></h5>
                <table id="roles" style="width:100%">
                    <thead>
                        <tr>
                            <td><b>Disposition</b></td>
                            <td><b>Count<b></td>
                        </tr>
                    </thead>
                    <tbody class="dispositionreport">
                        {!!$alldisposition!!}
                    </tbody>
                    
                </table>
            </div>
            </div>
                       
      
     
</div>
<div class="modal" tabindex="-1" id="customodalid">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><b>Select Date</b></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>                
            </div>
            <div class="modal-body">
                <input type="text" name="firstdate" id="firstdateid">
                <input type="text" name="seconddate" id="seconddateid">
            </div>
          
                <div class="row">
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary mb-2"id="customsearchid">Search</button>
                    </div>  
                </div>
           
        </div>
    </div>
</div>
<!-- single date -->
<div class="modal" tabindex="-1" id="singledateid">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><b>Select Date</b></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>                
            </div>
            <div class="modal-body">
                <input type="text" name="thirddate" id="thirddateid">
            </div>
          
                <div class="row">
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary mb-2"id="singlesearchid">Search</button>
                    </div>  
                </div>
           
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="chartmodalid">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark"><b>Total Calls Made ( <span id="chatmodaltitel"></span> )</b></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>                
            </div>
            <div class="modal-body">
                <div id="piechart"></div>
            </div>
        </div>
    </div>
</div>