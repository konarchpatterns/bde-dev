<script type="text/javascript">
    var win3cx="";
   $('[data-toggle="tooltip"]').tooltip();
	 $(function () {
	   var table = $('#leadrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
        stateSave: true,
        pagingType: "input",
       // stateDuration: -1,
        bStateSave: true,
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
        ajax: "{{ route('lead.anydata') }}",
      
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
          @permission('view.lead.checkbox')
            {data:'checkbox',name:'checkbox',orderable:false,searchable:false},  
          @endpermission

            {data: 'id', name: 'company_masters.id',class:'fooid dt-center',width:'7%'},
          @permission('view.lead.name')
            {data: 'companyname', name:'company_masters.company_name'},
          @endpermission
          @permission('view.lead.website')
             {data: 'website_address', name:'company_masters.website_address',"render": function (data, type, full, meta) {
                            return '<span class="filename" data-toggle="tooltip" title="' + data + '"><a href="'+ data +'"target="_blank">' + data + '</a></span>';
                            }
             },
          @endpermission
          @permission('view.lead.phone')
            @permission('show.lead.phone')
          {data: 'company_phone_no', name:'company_phone_numbers.company_phone',"render":function(data,type,full,meta){
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
            {data: 'company_phone_no', name:'company_phone_numbers.company_phone',"render":function(data,type,full,meta){
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
                          text1 += '<span name=phonetext[] value="'+pno+'" onclick="redirectToPhoneURL('+pno+','+full.id+','+typephone2+')"><i class="fa fa-phone-square " aria-hidden="true" style="font-size:20px;color:#51C248"></i> ('+subdd[1]+ '</span><br>';
                         
                       
                        }

                   return  text1;
                 }
                            
              }
            },
              @endpermission
            @endpermission
            @permission('view.lead.email')
              @permission('show.lead.email')
            {data: 'company_email_add', name:'company_email_addresses.company_email',"render":function(data,type,full,meta){
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
            {data: 'company_email_add', name:'company_email_addresses.company_email',"render":function(data,type,full,meta){
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
                          var r=i+1;
                          var dd=obj[i];
                          var subdd=dd.split("(");

                          var cphone="'"+subdd[0]+"'";
                          var dd="'"+obj[i]+"'";
                            // var tt=dd.replace("@", "bb");
                          text1 += '<span name=emailtext[] value="'+cphone+'" onclick="redirectToEmailURL('+cphone+')"><i class="fa fa-envelope" aria-hidden="true" style="font-size:25px;color:white"></i>&nbsp;&nbsp;&nbsp;('+subdd[1]+'</span> <br>';
                         
                        }

                   return  text1;
                 }
              }
            },
            @endpermission
          @endpermission
          @permission('view.lead.status') 
            {data: 'status', name: 'leads.status'},   
          @endpermission 
          @permission('view.lead.assign.user')          
            {data: 'name', name: 'users.name',class:'assignuser dt-center'},
          @endpermission 
          @permission('view.lead.assign.by')
            {data:'assign_by',name:'company_masters.assign_by',class:' dt-center'},
          @endpermission 
          @permission('view.lead.address')
            {data: 'state', name: 'company_addresses.state'}, 
          @endpermission 
          @permission('view.lead.country')
            {data: 'Country', name: 'company_addresses.Country'},
          @endpermission   
            // {data: 'created_at', name: 'created_at'},
           ],	
          @permission('view.lead.checkbox')
           order: [[ 1, 'desc' ]],
          @else
            order: [[ 0, 'desc' ]],
          @endpermission   
	    });
	});
//refresh data table
$(document).ready(function () {

 $("#delsession").click(function(event) {
       
      event.preventDefault ;
      var table = $('#leadrecords').DataTable();
      table.state.clear();
      // $('.Comp').val('');
      window.location.reload();

    });
});
 $(function () {
   var table1=$('#userrecord').DataTable({
       processing: true,
       serverSide: true,
       async: true,
       destroy: true,
       responsive: true,
       paging:  true,
       ajax:"{{route('showuser.list')}}",
          columns:[
          {data:'id',name:'id',class:'foo'},
          {data:'name',name:'name',class:"selectuser dt-center"},
          {data:'email',name:'email',class:'dt-center'},

          ],
          
        });
 });

 $(document).on("click", ".assignuser", function(){
     var table = $('#leadrecords').DataTable();
     var $rowid = table.row( this ).index();
     var currentPageIndex = table.page.info().page;
     var target  = $(this);    
     var key  = $(this).closest('tr').find('td.fooid').text();
      document.getElementById("leadid").value = key;
      document.getElementById("currentPageIndexid").value =currentPageIndex;
    $( "#AssignuserModel" ).modal("show");
       $('#modelHeading').html("Assign User");

 });
 //assign user to lead from user table click event
  $(document).on('click','.selectuser',function(){
    var list =$(this).text();
      console.log(list);
      swal({
      title: "Are you sure! You want to assign contact to " +list+" !",
      // text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
               var table = $('#leadrecords').DataTable();
               var table2= $('#userrecord').DataTable();
               var userid  = $(this).closest('tr').find('td.foo').text();
               var leadid= document.getElementById('leadid').value;  
               $.ajax({
                type: "post",
                url: "{{route('company.assignuserfromtable')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "companyid":leadid,
                             "userid":userid,
                            
                       },
                 
                 success: function(data){    
                                
                              table.ajax.reload( null, false );               
                             $( "#AssignuserModel" ).modal("hide");
                 },
                   
                });
             }
        else{
          // $( "#AssignuserModel" ).modal("hide");
        }
     });
  });


  $(document).on("click", "#closeuser", function(){
     $( "#AssignuserModel" ).modal("hide");
     // $('#userrecord').dataTable().fnDestroy();
    });
  //  header logic search added
$(document).ready(function () {
  
$('#leadrecords .fhead .firstrow th').each( function (i) {
        var title = $('#leadrecords th').eq( $(this).index() ).text();
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);
        if(title.trim().length> 0) {
           $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder="'+title.trim()+'" data-index="'+i+'"     class="'+titleclass+'"   />' );
        }
    } );
 // Apply the search
    var table = $('#leadrecords').DataTable();
    $( table.table().container() ).on( 'keyup', '.fhead .firstrow input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
    //checkbox assign user
     $('#checkboxid').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });
     $('#checkboxid1').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });


//Assign user
$( '#assignuserlead' ).on('click',function(){
          var checkboxes = document.getElementsByName('checkbox[]');
          
          var vals = "";
          var aIds = [];
          var table=$('#leadrecords').DataTable();
           var currentPageIndex = table.page.info().page;

           for (var i=0, n=checkboxes.length;i<n;i++) 
           {
             if (checkboxes[i].checked) 
             {
                 aIds.push(checkboxes[i].value);
                 // vals += ","+checkboxes[i].value;
                
              }  
           }
           var str = aIds.join(',');
           if(aIds[0] == null){
             toastr.error("Please select lead");
           }
           else{
           $( "#AssignuserModel" ).modal("show");
           $('#modelHeading').html("Assign User");
           document.getElementById("leadid").value = str;
           document.getElementById("currentPageIndexid").value =currentPageIndex;
         
         }
    });


});


function redirectToPhoneURL(obj,cid,type){
    
    
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
     $('#companydispositionmodal').modal({
                    backdrop: 'static',
                    keyboard: false
             });
      $( "#companydispositionmodal" ).find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
      $( "#companydispositionmodal" ).find("textarea")
       .val('');
      $(' #followupid ').addClass('followupvisible');
      $('#dispositioncompanyid').val('');
      $('#companycallingnumber').val('');
      $('#datetimepicker').val('');
      document.getElementById("submitdisposition").disabled = false;
      $.ajax({
                type: "post",
                url: "{{route('companydisposition.predispositionentrycompany')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "company_id":cid,
                             "companycallingnumber":obj,
                             "phonenumbertype":type,
                            
                       },            
                 success: function(data){     
                        $( "#companydispositionmodal" ).modal("show");
                        $("#companydispositionbackid").val(data);
                        $('#dispositioncompanyid').val(cid);
                        $('#companycallingnumber').val(obj);
                        $( '#modelHeading1' ).html("Disposition");           
                 },
                   
      });
      win3cx=window.open("https://173.249.5.185:5001/webclient/#/call?phone="+obj+"",'_blank');
    
   }
   else{
   }
 });
}
function redirectToEmailURL(ee){

    swal({
      text: "Do you want to Email "+ee+" !",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
   
    var url = '{{ route("mail.write", ":id") }}';
     url = url.replace(':id', ee);
        location.href=url;
   }
   else{
   }
 });
}
//submit button of dissposition
 $(document).on('click','#submitdisposition',function(){
   document.getElementById("submitdisposition").disabled = true;
    var description=document.getElementById("companydescription").value;
    var companycallingnumber=document.getElementById("companycallingnumber").value;
    var ele = document.getElementsByName('optradio'); 
    var radiovalue="";    
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                  radiovalue=ele[i].value;
              
            } 
    //var id=document.getElementById("dispositioncompanyid").value;
    var id=document.getElementById("companydispositionbackid").value;
    var follow_up=document.getElementById("datetimepicker").value;
    if(radiovalue == ""){
      document.getElementById("submitdisposition").disabled = false;
      toastr.error('Please write disposition!');
     
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
                        toastr.success('New Disposition entered successfully!');  
                        win3cx.close();               
                   },
                     
          });
      }
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
 //datetime picker jquery
 jQuery('#datetimepicker').datetimepicker();
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