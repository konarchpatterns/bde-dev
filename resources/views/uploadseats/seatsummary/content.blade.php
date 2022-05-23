<div class="">
  <div class="row">
        <div class="col-md-9">
            <h5><a href="{{route('csvseat.csvnameindex')}}"><b>Summary Report</b></a> <i class="fa fa-angle-double-right "></i>{{$seat->seatname}}</h5> 
            <input type="hidden" name="userid" value="{{$seat->id}}" id="seatidid">         
        </div>
        <div class="col-md-3">
           
            <a href="{{route('csvseat.csvnameindex')}}" class=" btn btn-info rightdiv mb-2">Back</a>
             
        </div>
    </div>
    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                      <div class="col-12">
                                            <div class="">
                                              <!--   <p class="card-category">totalassigncompanydata</p> -->
                                                <h4 class="card-title">Total Companies</h4>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="icon-big text-center icon-warning">
                                                {{$totalseatcompanydata}}
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-table"></i> Table
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <i class="fa fa-pie-chart"></i> Graph

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                      <div class="col-12">
                                            <div class="">
                                              <!--   <p class="card-category">totalassigncompanydata</p> -->
                                                <h4 class="card-title">Currently Assigned</h4>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="icon-big text-center icon-warning">
                                                {{$currentlyassigncompanydata}}
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-table"></i> Table
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <i class="fa fa-pie-chart"></i> Graph

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                      <div class="col-12">
                                            <div class="">
                                              <!--   <p class="card-category">totalassigncompanydata</p> -->
                                                <h4 class="card-title">Unassigned</h4>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="icon-big text-center icon-warning">
                                                {{$unassigncompanydata}}
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-table"></i> Table
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <i class="fa fa-pie-chart"></i> Graph

                                    </div>
                                </div>
                            </div>
        
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                      <div class="col-12">
                                            <div class="">
                                              <!--   <p class="card-category">totalassigncompanydata</p> -->
                                                <h4 class="card-title">Total Calls Made</h4>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="icon-big text-center icon-warning">
                                                {{$totaldisposition}}
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-table"></i> Table
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <i class="fa fa-pie-chart"></i> <a href="#" class="totalcallgraphid">Graph</a>
                                         <input type="hidden" name="chartval" value="Life Time">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <div class="row">
            <div class="col-md-5">
             <div class="row">
               <div class="col-sm-8">
                <h5 align="right"><b>{{$seat->seatname}} Reports</b></h5>
               </div> 
               <div class="col-sm-4">
                     <select class="selectdispositionday"><option>Life Time</option><option selected="">Today</option><option>Yesterday</option><option>Last 7 Days</option><option>Last 30 Days</option><option>Custom</option></select>
                </div>
             </div>
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
            <div class="col-md-3">
                
                           <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                      <div class="col-12">
                                            <div class="">
                                              <!--   <p class="card-category">totalassigncompanydata</p> -->
                                                <h4 class="card-title">Total Calls Made (EST)</h4><h5 id="totalcallmadeid">{{$typedetail}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="icon-big text-center icon-warning">
                                                <span id="totalcallcountid">{{$todaycountdisposition}}</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-table"></i> Table
                                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                        <i class="fa fa-pie-chart"></i> <a href="#" class="totalcallgraphid"> Pie</a>
                                        <input type="hidden" name="chartval" value="Today" id="selectedvalueid">
                                       
                                         <!-- <i class="fa fa-line-chart"></i> <a href="#" class="totalcalllinegraphid"> Line</a> -->
   
                                    </div>
                                </div>
                            </div>
                    
            </div>
             <div class="col-md-4">
                
                           <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                      <div class="col-12">
                                            <div class="">
                                              <!--   <p class="card-category">totalassigncompanydata</p> -->
                                                <h4 class="card-title">Contacted Companies (EST)</h4><h5 id="attendedcompniestitleid">{{$typedetail}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="icon-big text-center icon-warning">
                                                <span id="attendedcompaniescountid">{{$companycalled}}</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-table"></i> Table
                                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                        <!-- <i class="fa fa-pie-chart"></i> <a href="#" class="totalcallgraphid"> Pie</a> -->
                                       <!--  <input type="hidden" name="chartval" value="Today" id="selectedvalueid"> -->
                                       
                                        <!--  <i class="fa fa-line-chart"></i> <a href="#" class="totalcalllinegraphid"> Line</a> -->
   
                                    </div>
                                </div>
                            </div>
                    
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