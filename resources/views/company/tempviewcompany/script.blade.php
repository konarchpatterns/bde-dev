<script type="text/javascript">
   var win3cx="";
@role('admin')
    document.getElementById("uploadBtn").onchange = function () {
      label1 = this.value.replace(/\\/g, '/').replace(/.*\//, '');
     document.getElementById("uploadFile").value = label1;
    };
   
   $("#showcsv").click(function(){
          $('#formidetity').removeClass('csvnotvisible');
          $('#showcsv').addClass('csvnotvisible');
   });

 @endrole

@if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif


  $(function () {
     var table = $('#compnyrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        // displayStart: 20,
        //scrollCollapse: true, 
      
        stateSave: true,
       
       
        pagingType: "input",
        // stateDuration: -1,
        // bStateSave: true,
        //fixedColumns: false,
       autowidth: false,
       // scrollX: false,
       // bAutoWidth: true,
       // scrollY: '400px',//scroll vertically
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

        //fixedHeader: {
        ///    header: true,
        //    footer: true
       // },
       //  scrollX: true,//scroll horizontally

        //fix column table it must be true and add css word-break:break-word;
         paging:  true,//give pagination in bottom
          //Import data in datatable
       
        ajax: "{{ route('company.tempanydata') }}",
       
        columnDefs: [
               {className: "dt-center", targets: "_all"},
               // { width: "5%", targets: 0 },
               // { width: "7%", targets: 1 },
               // { width: "20%", targets: 2 },
               // { width: "10%", targets: 3 },
               // { width: "10%", targets: 4 },
               // { width: "10%", targets: 5 },
               // { width: "10%", targets: 6 },
               // { width: "10%", targets: 7 },
           
          ],
          columns: [ 
          @permission('view.company.checkbox')
          {data:'checkbox',name:'checkbox',class:"checkclass",orderable:false,searchable:false}, 
          @endpermission
          @permission('view.company.name')
            {data:'coid', name:'coid',class:"fooid dt-center",width:'4%'},
          @endpermission
          @permission('view.company.name')
            {data: 'cname', name:'company_masters.company_name'},
          @endpermission
          @permission('view.company.website')
            {data: 'website_address', name:'company_masters.website_address',width:'4%',"render": function (data, type, full, meta) {
                return '<span class="filename" data-toggle="tooltip" title="' + data + '"><a href="'+ data +'"target="_blank">' + data + '</a></span>';
                           // return '<span class="filename" data-toggle="tooltip" title="' + data + '"><a href="'+ data +'"target="_blank">' + data.substring(0, 10) + '</a></span>';
              
                            }
          },
          @endpermission
          @permission('view.company.phone')
            @permission('show.company.phone')
            {data: 'company_phone_no', name:'company_phone_no',"render":function(data,type,full,meta){
                  if(data == null || data == '')
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
                          text1 += '<span name=phonetext[] value="'+pno+'" onclick="redirectToPhoneURL('+pno+','+full.id+','+typephone2+')" data-toggle="tooltip" title="' + pno+'('+subdd[1] + '">'+pno+'<i class="fa fa-phone-square" aria-hidden="true" style="color:#51C248"></i> ('+subdd[1]+ '</span><br>';
                        }
                          return  text1;
                 }
                            
              }
            },
            @else
            {data: 'company_phone_no', name:'company_phone_no',"render":function(data,type,full,meta){
                  if(data == null || data == '')
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
          @permission('view.company.email')
            @permission('show.company.email')
            {data: 'company_email_add', name:'company_email_add',"render":function(data,type,full,meta){
                    if(data == null || data == '')
                    {
                          return "-";
                    }
                    else{
                     var obj=data.split(",");
                        var i;
                        var text1="";
                  
                        for (i = 0; i < obj.length; i++) {
                         
                         
                          var dd=obj[i];
                          var subdd=dd.split("(");

                          var cemail="'"+subdd[0]+"'";
                          text1 += '<span name=emailtext[] value="'+cemail+'"  data-toggle="tooltip" title="' + subdd[0]+'('+subdd[1] + '">'+subdd[0]+'<i class="fa fa-envelope" aria-hidden="true" style="color:black"></i>('+subdd[1]+'</span><br>';
                         // text1 += '<span name=emailtext[] value="'+cemail+'" onclick="redirectToEmailURL('+cemail+')" data-toggle="tooltip" title="' + subdd[0]+'('+subdd[1] + '">'+subdd[0]+'<i class="fa fa-envelope" aria-hidden="true" style="color:white"></i>('+subdd[1]+'</span><br>';
                        }
                          return  text1; 
                  }

                   
                    
              }
            },
            @else
            {data: 'company_email_add', name:'company_email_add',"render":function(data,type,full,meta){
                   if(data == null || data == '')
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

                          var cemail="'"+subdd[0]+"'";
                          var dd="'"+obj[i]+"'";
                            // var tt=dd.replace("@", "bb");
                           text1 += '<span name=emailtext[] value="'+cemail+'"><i class="fa fa-envelope" aria-hidden="true" style="font-size:25px;color:black"></i>&nbsp;&nbsp;&nbsp;('+subdd[1]+'</span> <br>';
                          // text1 += '<span name=emailtext[] value="'+cemail+'" onclick="redirectToEmailURL('+cemail+')"><i class="fa fa-envelope" aria-hidden="true" style="font-size:25px;color:white"></i>&nbsp;&nbsp;&nbsp;('+subdd[1]+'</span> <br>';
                         
                        }

                   return  text1;
                 }
              }
            },
            @endpermission
          @endpermission
          
         
             {data:'lead_description',name: 'company_masters.lead_description',class:' dt-center',"render": function (data, type, full, meta) {
                return '<span class="filename" data-toggle="tooltip" title="' + data + '">' + data +'</span>';
                          
              
                            }},

         
         
         
  
          @permission('view.company.address') 
            {data: 'state', name: 'CompanyAddress.state'}, 
          @endpermission
          @permission('view.company.country')
            {data: 'Country', name: 'CompanyAddress.Country',width:'10%'},    
          @endpermission
          @permission('view.company.address') 
            {data: 'time_zone', name: 'CompanyAddress.time_zone'}, 
          @endpermission
          @permission('view.company.address') 
            {data: 'last_disposition', name: 'company_masters.last_disposition',"render": function (data, type, full, meta) {
                          if(data == null)
                          {
                             return "-";
                          }
                          else{

                            return '<span class="filename"  data-html="true" data-toggle="tooltip" title="' + data + '">' + data + '</a></span>';
                          }  
                            }
                          }, 
          @endpermission
           ], 
          @permission('view.company.checkbox')
            order: [[ 10, 'desc' ]],
          @else
            order: [[ 0, 'desc' ]],
          @endpermission

      });

  });
$(document).ready(function () {

 $("#delsession").click(function(event) {
     
      event.preventDefault ;
      var table = $('#compnyrecords').DataTable();
      table.state.clear();
      window.location.reload();

    });
});
$('.filternewdialaccont').on('click', function(){
  var table = $('#compnyrecords').DataTable();
  $('.filternewdialaccont').removeClass('active');
  $(this).addClass('active');
  var filter_value = $(this).text();

  var new_url = "{{ route('company.anydata',':id') }}";
  new_url = new_url.replace(':id',filter_value);
  table.ajax.url(new_url).load();
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
      $('#companyid').val('');
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
                        $('#companyid').val(cid);
                        $('#companycallingnumber').val(obj);
                        $( '#modelHeading1' ).html("Disposition");           
                 },
                   
      });

      if($('#worktypeid').val() == 'In side'){
  
        win3cx=window.open("https://157.245.98.226/webclient/#/call?phone="+obj+"",'_blank');
      }
      else{
        
         win3cx=window.open("https://patterns.3cx.in:5001/webclient/#/call?phone="+obj+"",'_blank');
      }
    
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

//  header logic search added
$(document).ready(function () {
    $('#compnyrecords').on('draw.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip({
    trigger : 'hover'
});
                  });
$('#compnyrecords .fhead .firstrow th').each( function (i) {
        var title = $('#compnyrecords th').eq( $(this).index() ).text();
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);
        if(title.trim().length> 0) {
           $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder="'+title.trim()+'" data-index="'+i+'"     class="'+titleclass+'"   />' );
        }
    } );
 // Apply the search
    var table = $('#compnyrecords').DataTable();
    $( table.table().container() ).on( 'keyup', '.fhead .firstrow input', function () {
        table
            .column( $(this).data('index') )
            .search(this.value)
            .draw();
    } );


 
   
//slect all check box
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



    $( '#assignuser' ).on('click',function(){
          var checkboxes = document.getElementsByName('checkbox1[]');
          var vals = "";
          var aIds = [];
          var table=$('#compnyrecords').DataTable();
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
             toastr.error("Please select company");
           }
           else{
           $( "#AssignuserModel" ).modal("show");
           $('#modelHeading').html("Assign User");
           document.getElementById("companyid").value = str;
           document.getElementById("currentPageIndexid").value =currentPageIndex;
         
         }
    });

});
//submit button of dissposition
 $(document).on('click','#submitdisposition',function(){
   document.getElementById("submitdisposition").disabled = true;
   var table = $('#compnyrecords').DataTable();
    var description=document.getElementById("companydescription").value;
    var companycallingnumber=document.getElementById("companycallingnumber").value;
    var ele = document.getElementsByName('optradio'); 
    var radiovalue="";    
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                  radiovalue=ele[i].value;
              
            } 
   // var id=document.getElementById("dispositioncompanyid").value;
    var id=document.getElementById("companydispositionbackid").value;
    var follow_up=document.getElementById("datetimepicker").value;
    if(radiovalue == "Call Back" || radiovalue == "Follow Up"){
      var datedispo=radiovalue;
    }
    if(radiovalue == ""){
      document.getElementById("submitdisposition").disabled = false;
      toastr.error('Please write new disposition!');
      
    }
    else if(radiovalue == 'Do Not Call' && description ==''){
      document.getElementById("submitdisposition").disabled = false;
      toastr.error('Please write description!');
    }
    else if(radiovalue == datedispo && follow_up ==''){
        document.getElementById("submitdisposition").disabled = false;
        toastr.error('Please Select date!');
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
                        },
                   
                   success: function(data){    
                             
                        $( "#companydispositionmodal" ).modal("hide");
                        table.ajax.reload(null, false);               
                        toastr.success('New Disposition entered successfully!'); 
                        win3cx.close(); 

                                         
                   },
                     
          });
      }
 }); 

 
 //show followup textbox in disposition click on followup radio buttoon 
 $('input:radio[name=optradio]').click(function(){
        var compare=$(this).val();
        if(compare == 'Follow Up' || compare == 'Call Back' || compare =='Interested'){
            $(' #followupid ').removeClass('followupvisible');
            $('#datetimepicker').focus();
        }
        else{
          $(' #followupid ').addClass('followupvisible');
          $('#datetimepicker').val('');
          
        }
 }); 
//single order user allocation
 function assignSingleUser(companyid){
  var table = $('#compnyrecords').DataTable();
     var $rowid = table.row( this ).index();
     var currentPageIndex = table.page.info().page;
     var target  = $(this);    
     var key  = companyid;
  
      document.getElementById("companyid").value = key;
      document.getElementById("currentPageIndexid").value =currentPageIndex;
     $( "#AssignuserModel" ).modal("show");
       // $('#modelHeading').html("Assign User");
 }

//datetime picker jquery
 jQuery('#datetimepicker').datetimepicker();
</script>
@include('company.companymodal.assignusermodal.script')
@include('company.companymodal.companyinfoindisposition.script')