<script type="text/javascript">
  var win3cx="";
function redirectToEmailURL(ee){
  swal({
      text: "Do you want to email "+ee+"!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
   
     var url = '{{ route("mail.write", ":id") }}';
     url = url.replace(':id', ee);
      location.href =url;
   }
   else{
   }
  });
}
function redirectToCompanyPhoneURL(pp,type){
  swal({
      text: "Do you want to call "+pp+"!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
      history.pushState(null, null, location.href);
       window.onpopstate = function () {
        history.go(1);
    };
  
    $(window).keydown(function(event){
        if(event.keyCode == 116) {
          event.preventDefault();
          return false;
        }
    });
   @if(substr($backto,0,8) == "calendar")
        $('#companytaskdispositionmodal').modal({
                    backdrop: 'static',
                    keyboard: false
             });
        $( "#companytaskdispositionmodal" ).find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
        $( "#companytaskdispositionmodal" ).find("textarea")
       .val('');
       $(' #followupid ').addClass('followupvisible');
       document.getElementById("submittaskdisposition").disabled = false;
       $('#taskdatetimepicker').val('');
       $('#taskcompanycallingnumber').val('');
       $('#taskcompanycallingnumber').val(pp);
       $( "#companytaskdispositionmodal" ).modal("show");
      @else
        $( "#companydispositionmodal" ).find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
         $( "#companydispositionmodal" ).find("textarea")
       .val('');
        $(' #followupid ').addClass('followupvisible');
        document.getElementById("submitdisposition").disabled = false;
        $('#datetimepicker').val('');
             $('#companydispositionmodal').modal({
                    backdrop: 'static',
                    keyboard: false
             });
        $('#companycallingnumber').val('');
        var cid=document.getElementById("companyid").value;
         $.ajax({
                type: "post",
                url: "{{route('companydisposition.predispositionentrycompany')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "company_id":cid,
                             "companycallingnumber":pp,
                             "phonenumbertype":type,
                            
                       },            
                 success: function(data){     
                        $( "#companydispositionmodal" ).modal("show");
                        $("#companydispositionbackid").val(data);
                        $('#dispositioncompanyid').val(cid);
                        $('#companycallingnumber').val(pp);
                        $( '#modelHeading1' ).html("Disposition");           
                 },
                   
        });
      @endif
       win3cx=window.open("https://173.249.5.185:5001/webclient/#/call?phone="+pp+"",'_blank');
     // window.location.href="https://divyarajvaghela.3cx.in/webclient/#/call?phone="+pp+"";
   }
   else{
   }
  });
}
//client disposition popup and 3cx
function redirectToPhoneURL(pp,cid,type){
  swal({
      text: "Do you want to call "+type+"!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
      history.pushState(null, null, location.href);
      window.onpopstate = function () {
          history.go(1);
      };

      $(window).keydown(function(event){
        if(event.keyCode == 116) {
          event.preventDefault();
          return false;
        }
      });
        $('#clientdispositiondialogbox').modal({
                    backdrop: 'static',
                    keyboard: false
             });
        $( "#clientdispositiondialogbox" ).find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
        $( "#clientdispositiondialogbox" ).find("textarea")
       .val('');
       $('#clientid').val('');
        $('#callingnumber').val('');
        document.getElementById("submitclientpermission").disabled = false;
        $(' #followupid ').addClass('followupvisible');
        $('#clientdatetimepicker').val('');
        $.ajax({
                type: "post",
                url: "{{route('clientdisposition.predispositionentry')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "client_id":cid,
                             "phonenumber":pp,
                             "phonenumbertype":type,
                            
                       },
                 
                 success: function(data){    
                         
                        $( "#clientdispositiondialogbox" ).modal("show");
                        $("#dispositionbackid").val(data);
                        $('#clientid').val(cid);
                        $('#callingnumber').val(pp);
                        //$( '#modelHeading' ).html("Disposition");                  
                 },
                   
          });
      win3cx=window.open("https://173.249.5.185:5001/webclient/#/call?phone="+pp+"",'_blank');
     // window.location.href="https://divyarajvaghela.3cx.in/webclient/#/call?phone="+pp+"";
   }
   else{
   }
  });
}
 //click ok on client disposition submit button
  $(document).on('click','a#submitclientpermission.mt-2',function(){
    document.getElementById("submitclientpermission").disabled = true;
    var description=document.getElementById("clientdescription").value;
    var callingphonenumber=document.getElementById("callingnumber").value;
    var dispositionbackid=document.getElementById("dispositionbackid").value;
    var table2 = $('#activitylog').DataTable();
    var table3 = $('#clientdispositionlog').DataTable();
    var ele = document.getElementsByName('optradio'); 
    var radiovalue="";     
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                  radiovalue=ele[i].value;
              
            } 
    // var id=document.getElementById("clientid").value;
    var follow_up=document.getElementById("clientdatetimepicker").value;
     
      if(description == "" && radiovalue==""){
        document.getElementById("submitclientpermission").disabled = false;
        toastr.error('Please write disposition!');
      }
      else{
       $.ajax({
                  type: "post",
                  url: "{{route('clientdisposition.store')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               "id":dispositionbackid,
                               "description":description, 
                               "status":radiovalue,  
                               // "client_id":id, 
                               "follow_up":follow_up, 
                               "phonenumber":callingphonenumber,
                        },
                   
                   success: function(data){    
                             
                        $( "#clientdispositiondialogbox" ).modal("hide");
                          table2.ajax.reload();
                          table3.ajax.reload();
                          toastr.success('New Disposition entered successfully!');  
                        //close 3cx tab if it is open
                        if(callingphonenumber != ""){
                              win3cx.close();
                        }  
                                         
                   },
                     
                  });
       $( "#clientdispositiondialogbox" ).modal("hide");
       }

  });
$(function () {
     var table = $('#clientrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
       // stateSave: true,
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
                    '<option value="-1">All</option>'+
                    '</select> records'
                    },
          //Import data in datatable
        ajax: "{{ route('company.relatedclients',['id'=>$companydata->id]) }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
                // { width: 10, targets: 0 },
                // { width: 20, targets: 1 },
                // { width: 20, targets: 2 },
                // { width: 20, targets: 3 },
                // { width: 20, targets: 4 },
                // { width: 20, targets: 5 },
          ],
          columns: [   
            {data: 'id', name: 'id',class:'foo dt-center',width:'5%'},
          @permission('view.client.name')
            {data: 'client_name', name:'client_name'},
          @endpermission
          @permission('view.client.designation')
            {data: 'client_designation', name: 'client_designation'}, 
          @endpermission  
          @permission('view.client.phone')
           @permission('show.client.phone')
            {data:'client_phone_no',name:'client_phone_numbers.client_phone',"render":function(data,type,full,meta){

                  if(data == null)
                    {
                          return "-";
                    }
                    else{
                    var obj=data.split(",");
                         var text1="";
                        var i;
                     for (i = 0; i < obj.length; i++) {

                          var dd=obj[i];
                          var subdd=dd.split("(");
                          var pno=""+subdd[0]+"";
                          var typephone1=subdd[1].split(")");
                          var typephone2="'"+typephone1[0]+"'";
                            // var tt=dd.replace("@", "bb");
                          text1 += '<span name=phonetext[] value="'+pno+'" onclick="redirectToPhoneURL('+pno+','+full.id+','+typephone2+')">'+pno+'<i class="fa fa-phone-square" aria-hidden="true" style="color:#51C248"></i> ('+subdd[1]+ '</span><br>';
                        }
                          return  text1;
                      
                    }
                 }
            },
          @else
             {data:'client_phone_no',name:'client_phone_numbers.client_phone',"render":function(data,type,full,meta){
                  if(data == null)
                    {
                          return "-";
                    }
                    else{
                   // var obj=data.replace(/,/g,"</br>");   
                        var obj=data.split(",");
                        var i;
                        var text1="";
                       
                        for (i = 0; i < obj.length; i++) {

                          var dd=obj[i];
                          var subdd=dd.split("(");
                          var pno="'"+subdd[0]+"'";
                          var typephone1=subdd[1].split(")");
                          var typephone2="'"+typephone1[0]+"'";
                            // var tt=dd.replace("@", "bb");
                          text1 += '<label name=phonetext[] value="'+pno+'" onclick="redirectToPhoneURL('+pno+','+full.id+','+typephone2+')"><i class="fa fa-phone-square " aria-hidden="true" style="font-size:20px;color:#51C248"></i> ('+subdd[1]+ '</label><br>';
                         
                       
                        }

                   return  text1;
                 }
                 }
            },
            @endpermission  
          @endpermission  
          @permission('view.client.email')
            @permission('show.client.email') 
            {data: 'client_email_add', name:'client_email_addresses.client_email',"render":function(data,type,full,meta){
              if(data == null)
                    {
                          return "-";
                    }
                    else{
                     var obj=data.split(",");
                        var i;
                        var text1="";
                        console.log(obj.length);
                        for (i = 0; i < obj.length; i++) {
                         
                         
                          var dd=obj[i];
                          var subdd=dd.split("(");

                          var cemail="'"+subdd[0]+"'";
        
                          text1 += '<span name=emailtext[] value="'+cemail+'" onclick="redirectToEmailURL('+cemail+')">'+subdd[0]+'<i class="fa fa-envelope" aria-hidden="true" style="color:white"></i>('+subdd[1]+'</span><br>';
                        }
                          return  text1; 

                    }
              }
            }, 
        @else
            {data: 'client_email_add', name:'client_email_addresses.client_email',"render":function(data,type,full,meta){
              
                   if(data == null)
                    {
                          return "-";
                    }
                    else{
                   // var obj=data.replace(/,/g,"</br>");   
                        var obj=data.split(",");
                        var i;
                        var text1="";
                        console.log(obj.length);
                        for (i = 0; i < obj.length; i++) {
                         
                         
                          var dd=obj[i];
                          var subdd=dd.split("(");

                          var cemail="'"+subdd[0]+"'";
        
                          text1 += '<span name=emailtext[] value="'+cemail+'" onclick="redirectToEmailURL('+cemail+')"><i class="fa fa-envelope" aria-hidden="true" style="font-size:20px;color:white"></i> ('+subdd[1]+'</span><br>';
                          
                       
                        }

                   return  text1;
                 }
              }
            },
          @endpermission  
          @endpermission
          @permission('view.client')
            {data:'edit',name:'edit',class:'editdata dt-center'},
          @endpermission     
          @permission('delete.client')         
            {data:'delete',name:'delete',class:' dt-center'}
          @endpermission     
           ], 
          order: [[0, 'desc' ]],  
      });
  });

   $(document).on('click','.deletedata',function(){
    swal({
      text: "Do you want to delete Client !" ,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
               var table = $('#clientrecords').DataTable();
               var table2=$('#activitylog').DataTable();
               var clientid  = $(this).closest('tr').find('td.foo').text();  
               $.ajax({
                type: "post",
                url: "{{route('company.relatedclientdelete')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "clientid":clientid,
                            
                       },
                 
                 success: function(data){    
                            console.log(data);           
                              table.ajax.reload( null, false );        
                               table2.ajax.reload();
                        toastr.error('Client data is deleted.');   
                 },
                   
                });
             }
             else{
                toastr.warning('You canceled delete operation');  
             }
           });

  });
 //disposition log data table
 $(function () {
     var table = $('#dispositionlog').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
       // stateSave: true,
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
                    '<option value="-1">All</option>'+
                    '</select> records'
                    },
          //Import data in datatable
        ajax: "{{ route('company.companydispositionlog',['id'=>$companydata->id]) }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
                // { width: 10, targets: 0 },
                // { width: 20, targets: 1 },
                // { width: 20, targets: 2 },
                // { width: 20, targets: 3 },
                // { width: 20, targets: 4 },
                // { width: 20, targets: 5 },
          ],
          columns: [   
            {data: 'id', name: 'id',class:'foo dt-center',width:'5%'},
            {data: 'name', name: 'name'},
            {data: 'phonenumbertype', name:'phonenumbertype',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }},
            {data: 'status', name:'status',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }},
            {data: 'follow_up_date', name:'follow_up_date',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }},
            {data: 'description', name:'description',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }}, 
            {data:'created_at',name:'created_at'},  
           ],
          order: [[ 0, 'desc' ]],
            
      });
  });
 //Client disposition log data table
 $(function () {
     var table = $('#clientdispositionlog').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
       // stateSave: true,
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
                    '<option value="-1">All</option>'+
                    '</select> records'
                    },
          //Import data in datatable
        ajax: "{{ route('client.companyclientdispositionlog',['id'=>$companydata->id]) }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
                // { width: 10, targets: 0 },
                // { width: 20, targets: 1 },
                // { width: 20, targets: 2 },
                // { width: 20, targets: 3 },
                // { width: 20, targets: 4 },
                // { width: 20, targets: 5 },
          ],
          columns: [   
            {data: 'id', name: 'id',class:'foo dt-center',width:'5%'},
            {data: 'name', name: 'users.name'},
            {data: 'client_name', name: 'client_masters.client_name'},
            {data: 'phonenumber', name:'phonenumber',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }},
            {data: 'status', name:'status',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }},
            {data: 'follow_up_date', name:'follow_up_date',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }},
            {data: 'description', name:'description',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }}, 
            {data:'created_at',name:'created_at'},  
           ],
          order: [[ 0, 'desc' ]],
            
      });
  });
//activity log
$(function () {
     var table = $('#activitylog').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
       // stateSave: true,
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
                    '<option value="-1">All</option>'+
                    '</select> records'
                    },
          //Import data in datatable
        ajax: "{{ route('lead.companylog',['id'=>$companydata->id]) }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
                // { width: 10, targets: 0 },
                // { width: 20, targets: 1 },
                // { width: 20, targets: 2 },
                // { width: 20, targets: 3 },
                // { width: 20, targets: 4 },
                // { width: 20, targets: 5 },
          ],
          columns: [   
           
             {data: 'id', name: 'id',class:'foo dt-center',width:'5%'},
            {data: 'name', name:'users.name'},
            {data: 'description', name:'activity_log.description'},
            {data: 'attributes2', name: 'activity_log.attributes2'}, 
            {data: 'log_name', name: 'activity_log.log_name'},  
            {data:'attributes1',name:'activity_log.attributes1',class:'attributes1show dt-center',"render":function(data,type,full,mete){
              return '<span data-toggle="tooltip" data-placement="left" title="'+ data+'">' + data + '</span>';
            }
          }, 
          {data:'created_at',name:'created_at'},  
           ],
            order: [[0, 'desc' ]],
      });
  });

//pop up disposition model
 $(document).on('click','#dispositionid',function(){
    window.onpopstate = function () {
        history.go(1);
    };
    $('#companydispositionmodal').modal({
     backdrop: 'static',
    keyboard: false
    });
    $(window).keydown(function(event){
        if(event.keyCode == 116) {
          event.preventDefault();
          return false;
        }
    });
    $( "#companydispositionmodal" ).find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
    $( "#companydispositionmodal" ).find("textarea")
       .val('');
    $('#companycallingnumber').val('');    
    document.getElementById("submitdisposition").disabled = false;
    $(' #followupid ').addClass('followupvisible');
    $('#datetimepicker').val('');
    var pp="";
    var cid=document.getElementById("companyid").value;
         $.ajax({
                type: "post",
                url: "{{route('companydisposition.predispositionentrycompany')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "company_id":cid,
                             "companycallingnumber":pp,
                            
                       },            
                 success: function(data){     
                        $( "#companydispositionmodal" ).modal("show");
                        $("#companydispositionbackid").val(data);
                        $('#dispositioncompanyid').val(cid);
                        $('#companycallingnumber').val(pp);
                        $( '#modelHeading1' ).html("Disposition");           
                 },                
      });
  });
 //close disposition model
  $(document).on('click','.closedisposition',function(){
      $( "#companydispositionmodal" ).modal("hide");
  });
  //submit button of dissposition
$(document).on('click','#submitdisposition',function(){
    document.getElementById("submitdisposition").disabled = true;
    var description=document.getElementById("companydescription").value;
    var companycallingnumber=document.getElementById("companycallingnumber").value;
    var table2 = $('#activitylog').DataTable();
    var table3 = $('#dispositionlog').DataTable();
    
    var ele = document.getElementsByName('optradio'); 
    var radiovalue="";       
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                  radiovalue=ele[i].value;  
            } 
    var id=document.getElementById("companydispositionbackid").value;
    var follow_up=document.getElementById("datetimepicker").value;  
    if(radiovalue == ""){
      document.getElementById("submitdisposition").disabled = false;
      toastr.error('Please write  disposition!');
     
    }
    else{
    $.ajax({
                  type: "post",
                  url: "{{route('disposition.companydispositionstore')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               "description":description, 
                               "status":radiovalue,  
                               "id":id, 
                               "follow_up":follow_up, 
                               "companycallingnumber":companycallingnumber,
                        },
                   
                   success: function(data){    
                             
                        $( "#companydispositionmodal" ).modal("hide");

                           table2.ajax.reload();
                           table3.ajax.reload();
                          toastr.success('New Disposition entered successfully!');  
                            //close 3cx tab if it is open
                          if(companycallingnumber != ""){
                              win3cx.close();
                          }  
                                         
                   },
                     
          });
    }
 });
//pop up taskdisposition model
 $(document).on('click','#taskdispositionid',function(){
      history.pushState(null, null, location.href);
      window.onpopstate = function () {
          history.go(1);
      };
      $('#companytaskdispositionmodal').modal({
                    backdrop: 'static',
                    keyboard: false
             });
      $(window).keydown(function(event){
        if(event.keyCode == 116) {
          event.preventDefault();
          return false;
        }
      });
      $( "#companytaskdispositionmodal" ).find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
        $( "#companytaskdispositionmodal" ).find("textarea")
       .val('');
       
       $('#taskcompanycallingnumber').val('');
       document.getElementById("submittaskdisposition").disabled = false;
       $(' #followupid ').addClass('followupvisible');
       $('#taskdatetimepicker').val('');

    $( "#companytaskdispositionmodal" ).modal("show");
});
 //close taskdisposition model
  $(document).on('click','.closetaskdisposition',function(){
      $( "#companytaskdispositionmodal" ).modal("hide");
  });
    //submit button of task dissposition
  $(document).on('click','#submittaskdisposition',function(){
     document.getElementById("submittaskdisposition").disabled = true;
     var description=document.getElementById("companytaskdescription").value;
    var companycallingnumber=document.getElementById("taskcompanycallingnumber").value;
     var table2 = $('#activitylog').DataTable();
     var table3 = $('#dispositionlog').DataTable();
     var ele = document.getElementsByName('optradio'); 
     var radiovalue="";   
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                  radiovalue=ele[i].value;
              
            } 
    var id=document.getElementById("companyid").value;
    var taskid=document.getElementById("taskid").value;
    var follow_up=document.getElementById("taskdatetimepicker").value;
    if(description == "" && radiovalue=="" ){
     document.getElementById("submittaskdisposition").disabled = false;
      toastr.error('Please write in task disposition!');
     
    }
    else{
   
    $.ajax({
                  type: "post",
                  url: "{{route('disposition.companytaskdispositionstore')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               "description":description, 
                               "status":radiovalue,  
                               "company_id":id, 
                               "task_id":taskid,
                               "follow_up":follow_up,
                              "companycallingnumber":companycallingnumber, 
                        },
                   
                   success: function(data){    
                             
                      $( "#companytaskdispositionmodal" ).modal("hide");
                          table2.ajax.reload();
                          table3.ajax.reload();
                          if(data.data == 1){
                              toastr.success('Task followup entered successfully!');  
                          }   
                          else if (data.data == 2){
                              toastr.error('Task followup not entered');
                          }
                          else{
                              toastr.error('Task followup not entered');
                          }  

                          if(companycallingnumber != ""){
                                 win3cx.close();
                          }  
                        
                                         
                      },
                     
          });
     }
 });
 //datetime picker jquery
 jQuery('#datetimepicker').datetimepicker({minDate: 'today'});
 jQuery('#taskdatetimepicker').datetimepicker({minDate: 'today'});
 jQuery('#clientdatetimepicker').datetimepicker({minDate: 'today'});
$(document).ready(function(){
  //goback using session
  $(' #goback ').on('click',function(){
        window.history.go(-1);
  });
   //show pop click on activity column what modify
    $('#activitylog tbody').on( 'click', '.attributes1show', function () {
      swal({
              text: table.cell( this ).data(),
      });
      
   });
  //show followup textbox in disposition click on followup radio buttoon 
 $('input:radio[name=optradio]').click(function(){
        var compare=$(this).val();
        if(compare == 'Follow Up' || compare == 'Call Back'){
            $(' #followupid ').removeClass('followupvisible');
            $('#datetimepicker').focus();
        }
        else{
          $(' #followupid ').addClass('followupvisible');
          $('#datetimepicker').val('');
          
        }
 });
  //use for tooltip
 $('#activitylog').on('draw.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip(); 
                  });
     // search actvity log table
   $('#activitylog .fhead .firstrow th').each( function (i) {
        var title = $('#activitylog th').eq( $(this).index() ).text();
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);
        if(title.trim().length> 0) {
           $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder="'+title.trim()+'" data-index="'+i+'"     class="'+titleclass+'"   />' );
        }
    } );
   // Apply the search
    var table = $('#activitylog').DataTable();
    $( table.table().container() ).on( 'keyup', '.fhead .firstrow input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
});
 //show company data on click on showdata in disposition modal
 $('#showcompanydetail').on('click',function(){
       var company_id=document.getElementById('dispositioncompanyid').value;
       var table = $('#dispositionlistitable').DataTable();
       table.destroy();
        
          var companyid={companyid:company_id};
        $.ajax({
                 type: "GET",
                 cache: false,
                 async: true,
                 datatype: "json",
                 url: "{{route('company.showdatacompanyindisposition')}}",
                 data: companyid,
                 
                 success: function(data){  
                    // console.log(data[0].company_name);
                  data[0].forEach(function(entry) {
                      $('#companyname_d').text(entry.company_name);
                      $('#companywebsite_d').text(entry.website_address);
                  });
                  data[1].forEach(function(entry) {
                      $('#companycountry_d').text(entry.County);
                      $('#companystate_d').text(entry.state);
                      $('#companycity_d').text(entry.Country);
                      $('#companytimezone_d').text(entry.time_zone);

                  });
                  $("#clientlistitable tbody").html(data[2]);

                   $("#dispositionlistitable tbody").html(data[3]);
                    $("#dispositionlistitable").dataTable({ 
                      bRetrieve: true,
                      destroy: true,

                      lengthMenu: [[5,-1], [10,10]],
                     "language": {
                     "lengthMenu": '<b style="color:white;">Display <select class="form-control-sm">'+
                      '<option value="5">5</option>'+
                      '<option value="10">10</option>'+
                    '</select> records</b>'
                     },
                      
                     order: [[ 0, 'desc' ]],
                     });
                  $('#companyinfo').modal("show");            
                 },
                   
            });
    
 });
 //close company info in disposition popup  close button
  $(document).on("click", "#companyinfoclose", function(){
          $('#companyinfo').modal('hide');
   });
 //tooltip
 $('#dispositionlistitable').on('draw.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip(); 
  });
</script>
@include('clients.clientmodal.clientinfoindisposition.script')