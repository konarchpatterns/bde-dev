<script type="text/javascript">
	
    
// data entry role user table
$(function () {
     var table = $('#dataentryusersummaryrecord').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
        stateSave: true,
       // stateDuration: -1,
       // bStateSave: true,
       // fixedColumns: false,
       // autowidth: false,
       // scrollX: false,
       // bAutoWidth: true,
       // scrollY: '400px',//scroll vertically
        //lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],

        //fixedHeader: {
        ///    header: true,
        //    footer: true
       // },
       //  scrollX: true,//scroll horizontally

        //fix column table it must be true and add css word-break:break-word;
         paging:  true,//give pagination in bottom
          lengthMenu: [[50,-1], [50,"All"]],
        "language": {
                    "lengthMenu": 'Display <select class="form-control-sm">'+
                      '<option value="10">10</option>'+
                      '<option value="20">20</option>'+
                      '<option value="30">30</option>'+
                      '<option value="40">40</option>'+
                    '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '<option value="-1">All</option>'+
                    '</select> records'
                    },
          //Import data in datatable
        ajax: "{{ route('usersummary.anydataentery') }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
               {searchable: false,
               orderable: false,
               targets: [0,1]}
                 // { width: 10, targets: 0 },
                 // { width: 20, targets: 1 },
                 // { width: 20, targets: 2 },
                 // { width: 10, targets: 3 },
                 // { width:15, targets: 4 },
               
          ],
         
          columns: [ 
               {data: null, name: null,width:'5%'},
               {data:'udataentryname', name:'udataentryname'},
               {data: 'id', name: 'users.id',class:"fooid dt-center",width:'5%'},
               {data:'totalcreated',name:'company_masters.id',class:"dt-center"},      
           ], 
           order: [[2, 'asc']]

      });
       table.on( 'draw.dt', function () {
       var PageInfo = $('#dataentryusersummaryrecord').DataTable().page.info();
         table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
         });
       });
     
         
      
  });
 

$(document).ready(function () {
   $( "#myInputday" ).datepicker({ dateFormat: 'yy-mm-dd',changeMonth: true,
      changeYear: true });
   $("#myInputmonth").datepicker( {
      dateFormat: "yy-mm",changeMonth: true,
      changeYear: true
   });
   $( "#myInputyear" ).datepicker({dateFormat: 'yy',changeMonth: true,
      changeYear: true});

   $( "#mytotalInputday" ).datepicker({ dateFormat: 'yy-mm-dd',changeMonth: true,
      changeYear: true });
   $("#mytotalInputmonth").datepicker( {
      dateFormat: "yy-mm",changeMonth: true,
      changeYear: true
   
   });
     $( "#mytotalInputyear" ).datepicker({dateFormat: 'yy',changeMonth: true,
      changeYear: true});

  //refresh data table
 $("#delsession").click(function(event) {
       
      event.preventDefault ;
      var table = $('#usersummaryrecord').DataTable();
      table.state.clear();

    
      window.location.reload();

    });

});
//currently assign company click event
$(document).on("click", ".assigncompanyname", function(){
      // var table = $('#usersummaryrecord').DataTable(); 
      var userid  = $(this).closest('tr').find('td.fooid').text();
      var emptyvalue=$(this).text();
       // var idx = table.cell( this ).index().column;
       //    var title = table.column( idx ).header();
       
       //    alert( 'Column title clicked on: '+$(title).html() );

      if(emptyvalue != 0 && userid != ""){
          var userid={user_id:userid};
        $.ajax({
                 type: "GET",
                 cache: false,
                 async: true,
                 datatype: "json",
                 url: "{{route('user.currnetlyallocated')}}",
                 data: userid,
                 
                 success: function(data){  
                    $("#usercurrentlysummaryrecordcompany tbody").html(data[0]);
                    $("#currntlyassigncompanyuserid").val(data[1]);
                    $("#cureentlyassignuserlabelmoal1").text(data[2]);
                    $("#myInputday").val("");
                    $("#myInputmonth").val("");
                    $("#myInputyear").val("");
                    $('#currentlyallocatedcompanyModel').modal('show');                   
                 },
                   
            });
      }
      else{
           toastr.warning('No company currently assigned');   
      }
  });
//close current allocated company modal
   $(document).on("click", "#closecurrentcompanymodal", function(){
          $('#currentlyallocatedcompanyModel').modal('hide');
   });
  //search by day 
  $("#myInputday").on("change", function() { 
  var value = $(this).val().toLowerCase(); 
                    $("#geeks tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
  });  
  //search by month
  $("#myInputmonth").on("change", function() { 
  var value = $(this).val().toLowerCase(); 
                    $("#geeks tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                  });
  //search by year
  $("#myInputyear").on("change", function() { 
  var value = $(this).val().toLowerCase(); 
                    $("#geeks tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                  });
//selected date of current assign company modal that show company name on next modal
 $(document).on("click", ".selectdate", function(){
             var a=$(this).closest("td");
             var b= document.getElementById("currntlyassigncompanyuserid").value;

             var userid={user_id:b,cdate:a.text()};
             $.ajax({
                   type: "GET",
                   cache: false,
                   async: true,
                   datatype: "json",
                   url: "{{route('user.currentlyallcatedcompanyname')}}",
                   data: userid,
                   success: function(data){  

                      $("#currentlyallocatedcompanyname tbody").html(data[0]);  
                      $("#cureentlyassignuserlabel").text(data[1]);
                      $('#currentlyassignuserid').val(data[2]);
                      console.log(data[2]);
                      $('#currentlyallocatedcompanynameModel').modal('show');                     
                 },
                   
            });
  });
 //cureent status information 
$(document).on("click", ".statusinfo", function(){
      var coid  = $(this).closest('tr').find('td.coid').text();
      var statusid=this.id;
      var userid=document.getElementById("currentlyassignuserid").value;
      var userdata={user_id:userid,coid:coid,statusid:statusid};
       $.ajax({
                 type: "GET",
                 cache: false,
                 async: true,
                 datatype: "json",
                 url: "{{route('user.currentlyassigndisposition')}}",
                 data: userdata,
                 success: function(data){  
                    $("#usercurrentcompanydisposition tbody").html(data[0]);
                    $("#usercurrentclientdisposition tbody").html(data[1]);
                    $('#currentallocatedcompanydispositionModel').modal('show');           
                 },
                   
            });       
      });

//close show current company name disposition modal close button
  $(document).on("click", "#closecurrentcompanydispositionmodal", function(){
          $('#currentallocatedcompanydispositionModel').modal('hide');
   });

//search by current company
  $("#myInputcompanyname").on("keyup", function() {
    var value = $(this).val().toLowerCase(); 
                    $("#geekscompanyname tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                });
//close show current company name modal close button
  $(document).on("click", "#closecurrentlycompanynamemodal", function(){
          $('#currentlyallocatedcompanynameModel').modal('hide');
   });
//unassign company click event
$(document).on("click", ".unallocated", function(){

      var userid  = $(this).closest('tr').find('td.fooid').text();
      var emptyvalue=$(this).text();

      if(emptyvalue != 0 && userid != ""){
          var userid={user_id:userid};
        $.ajax({
                 type: "GET",
                 cache: false,
                 async: true,
                 datatype: "json",
                 url: "{{route('user.unallocated')}}",
                 data: userid,
                 
                 success: function(data){  
                    $("#unallocatedcompanytable tbody").html(data[0]);
                    $("#unallocatedcompanyuserid").val(data[1]);
                    $("#unallocatedcompanylistModel1").text(data[2]);
                    $("#myInputday").val("");
                    $("#myInputmonth").val("");
                    $("#myInputyear").val("");
                    $('#unallocatedcompanylistModel').modal('show');                   
                 },
                   
            });
      }
      else{
           toastr.warning('No company currently assigned');   
      }
  });
//selected date of unassign company modal that show company name on next modal
 $(document).on("click", ".unassignselectdate", function(){
             var a=$(this).closest("td");
             var b= document.getElementById("unallocatedcompanyuserid").value;

             var userid={user_id:b,cdate:a.text()};
             $.ajax({
                   type: "GET",
                   cache: false,
                   async: true,
                   datatype: "json",
                   url: "{{route('user.unallcatedcompanyname')}}",
                   data: userid,
                   success: function(data){  

                      $("#currentlyallocatedcompanyname tbody").html(data[0]);  
                      $("#cureentlyassignuserlabel").text(data[1]);
                      $('#currentlyassignuserid').val(data[2]);
                      console.log(data[2]);
                      $('#currentlyallocatedcompanynameModel').modal('show');                     
                 },
                   
            });
  });
//close show unassign company name modal close button
  $(document).on("click", "#closeunallocatedcompanylistModel", function(){
          $('#unallocatedcompanylistModel').modal('hide');
   });
//total assign company click event
$(document).on("click", ".totalallocated", function(){
      var userid  = $(this).closest('tr').find('td.fooid').text();
      var emptyvalue=$(this).text();
      if(emptyvalue != 0 && userid != ""){
          var userid={user_id:userid};
        $.ajax({
                 type: "GET",
                 cache: false,
                 async: true,
                 datatype: "json",
                 url: "{{route('user.totalallocated')}}",
                 data: userid,
                 success: function(data){  
                    $("#usertotlalsummaryrecordcompany tbody").html(data[0]);
                    $("#totalassigncompanyuserid").val(data[1]);
                    $("#totalassignuserlabelmoal1").text(data[2]);
                    $("#mytotalInputday").val("");
                    $("#mytotalInputmonth").val("");
                    $("#mytotlaInputyear").val("");
                    $('#totalallocatedcompanyModel').modal('show');                   
                 },
                   
            });
      }
      else{

           toastr.warning('No company assigned');   
      }
  });

//close total allocated company modal
   $(document).on("click", "#closetotalcompanymodal", function(){
          $('#totalallocatedcompanyModel').modal('hide');
   });
  //search by day total 
  $("#mytotalInputday").on("change", function() { 
  var value = $(this).val().toLowerCase(); 
                    $("#geeks tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
  });  
  //search by month total
  $("#mytotalInputmonth").on("change", function() { 
  var value = $(this).val().toLowerCase(); 
                    $("#geeks tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                  });
  //search by year total
  $("#mytotalInputyear").on("change", function() { 
  var value = $(this).val().toLowerCase(); 
                    $("#geeks tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                  });
//selected date of total assign company modal that show company name on next modal
 $(document).on("click", ".totalselectdate", function(){
             var a=$(this).closest("td");
             var b= document.getElementById("totalassigncompanyuserid").value;

             var userid={user_id:b,cdate:a.text()};
             $.ajax({
                   type: "GET",
                   cache: false,
                   async: true,
                   datatype: "json",
                   url: "{{route('user.totalallcatedcompanyname')}}",
                   data: userid,
                   success: function(data){  
                      $("#totalallocatedcompanyname tbody").html(data[0]);   
                      $("#totalassignuserlabel").text(data[1]);
                      $('#currentlyassignuserid').val(data[2]);
                      $('#totalallocatedcompanynameModel').modal('show');                     
                 },
                   
            });
  });
 //search by total company
  $("#totalmyInputcompanyname").on("keyup", function() {
    var value = $(this).val().toLowerCase(); 
                    $("#totalgeekscompanyname tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                });
 //close show total company name modal close button
  $(document).on("click", "#closetotalcompanynamemodal", function(){
          $('#totalallocatedcompanynameModel').modal('hide');
   });
 

</script>