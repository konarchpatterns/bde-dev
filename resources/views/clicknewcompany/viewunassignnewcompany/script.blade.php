<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script>

<script>


$(function() {


   // $.ajaxSetup({
   //          headers: {
   //              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
   //          }
   //  });
var form = $(this).parents('form:first');
var _token = form.find('input[name=_token]').val();
var $rowid = 0 ;
var currentPageIndex = 0;

 //New Code added on 11-07-18 for column searching
    $("#comp-table thead.fhead tr.firstrow th").each( function (i) {
        var title = $('#comp-table th').eq( $(this).index() ).text();
        //alert('hello');
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);
        if(title.trim().length> 0 && title !== 'Edit') {
           
           if(titleclass == "Disp"){
            $(this).html( '<input data-tip="Type and press <enter> to search" type="text"  name="'+titleclass+'"  placeholder="yyyy-mm-dd" data-index="'+i+'"  class="'+titleclass+'"   />' );
          }
          else{

           $(this).html( '<input data-tip="Type and press <enter> to search" type="text"  name="'+titleclass+'"  placeholder=" " data-index="'+i+'"  class="'+titleclass+'"   />' );
          }
    
        }
    } );

//New Code added on 11-07-18 for column searching
var table =   $('#comp-table').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        scrollCollapse: true, 
        serverSide: true,
        stateSave: true,
        stateDuration: -1,
        pagingType: "input",
        bStateSave: true,
        autowidth: false,
        // scrollX: true,
        // scrollY: true,
        // scrollY: ($(window).height() - 245),
        search: {
               caseInsensitive: true
                },
        lengthMenu: [[50,-1], [50,"100"]],
        "language": {
                    "lengthMenu": 'Display <select class="form-control-sm">'+
                      '<option value="25">25</option>'+
                      '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '</select> Clients'
                    },
        //stateDuration: -1,  changes made on  04/08/18
        

        // changes made on  04/08/18
        ajax: "{{ route('clickclients.unassignclicknewcompanyanydata',['id'=>'ALL^Last 3 Months']) }}",

        columnDefs: [
        
           
        ],
              
       
        columns: [
        {data:'checkbox',name:'checkbox',class:"checkclass dt-center",orderable:false,searchable:false, 
                    "render": function (data, type, full, meta) {
                              var coid = full.company_id;
                              coid = coid.replace(/\D/g, "");
                              data="<input type='checkbox' name='checkbox1[]' class='checkboxid' value='"+coid+"'>";
                                   
                                    return data;
                            }},
            { data: 'company_id' ,  name: 'company_id', class: 'idclass1 dt-body dt-center ' ,  width: '2px', 
                    "render": function (data, type, full, meta) {
                                   

                                    data= '<a href="http://www.click.com/clients/'+full.id+'/show"  class="test" data-toggle="tooltip" title="' + data + '" target="_blank">' + data + '</a>';
                                    return data;
                            }},
              { data: 'client_company', name: 'client_company' ,class:"dt-center",
                    "render": function (data, type, full, meta) {
                            //return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                              var coid = full.company_id;
                              coid = coid.replace(/\D/g, "");
                               return '<span onclick=orderinformation('+coid+') class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }
             },
            {data: 'cdclient_name', name: 'cdclient_name' ,class:"dt-center","render": function (data, type, full, meta) {
              
                  if(data == " "){
                    return data="No Data";
                  }
                  else{
                    var obj=data.split(",");
                    var text1="";
                     for (i = 0; i < obj.length; i++) {
                         text1+= '<span>'+obj[i]+'</span><br>';
                     }

                     return text1;
                  }
             }},
             
         
             { data: 'phone', name: 'phone',class:"dt-center",
                    "render": function (data, type, full, meta) {
                            //return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            var obj=data.split(",");
                            var text1="";
                            for (i = 0; i < obj.length; i++) {
                              var res = obj[i].replace(/\D/g, "");
                              var coid = full.company_id;
                              coid = coid.replace(/\D/g, "");
                            text1 += '<span onclick="redirectToPhoneURL('+res+','+coid+')">' + obj[i] + '</span><br>';
                            }
                                       
                             
                            
                            return text1;
                          }
                          },
              
         
             
             { data: 'client_state', name: 'client_state' ,class:"dt-center" ,searchable: true},
             { data: 'client_country', name: 'client_country',class:"dt-center" ,searchable: true},
             { data: 'timezone_type', name: 'timezone_type',class:"dt-center"},
        @permission('edit.company.assign.user')
             { data: 'salseuser', name: 'salseuser',class:"dt-center",
                    "render": function (data, type, full, meta) {
                            //return '<span class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            var coid = full.company_id;
                            coid = coid.replace(/\D/g, "");
                            if(data == null)
                            {
                              data="No user";
                             return '<span onclick=assignSingleUser('+coid+') class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                            }
                            else{
                               return '<span onclick=assignSingleUser('+coid+') class="test" data-toggle="tooltip" title="' + data + '">' + data + '</span>';
                             }
                            }},
             { data: 'salseassignuser', name: 'salseassignuser',class:"dt-center",
                    "render": function (data, type, full, meta) {
                      if(data == null){
                                return "No user"
                      }
                      else{

                          return data;
                      }
                    }},
        @endpermission
             { data: 'lastdispo', name: 'lastdispo',class:"dt-center","render": function (data, type, full, meta) {

                          if(data == null)
                          {
                             return "-";
                          }
                          else{
                             var obj=data.split(",");
                            var text1="";
                             var coid = full.company_id;
                            coid = coid.replace(/\D/g, "");
                            for (i = 0; i < 1; i++) {
                              
                              obj[i]=obj[i].replace(/&lt;br&gt;/g, '<br/>');
                              dateformateis=obj[i];
                               var datefor=dateformateis.split(" "); 
                             var newdate = datefor[i].split("-").reverse().join("-");
                             var finaldate=newdate + dateformateis.slice(10);
                             
                              text1 = '<span class="filename "  onclick=lastdispositiondetail('+coid+') data-html="true" data-toggle="tooltip" title="' + finaldate + '">' + finaldate + '</a></span>';
                             
                            }
                            return text1;
                          }  
                            }},
             
        ],
         pageLength: 25,
         pagination: true,
         responsive: true,
         @role('se')
          order: [[ 8, "desc" ]]
         @else
           order: [[ 10, "desc" ]]
         @endrole
         
        
    });
var table=$('#comp-table').DataTable();
$('.dataTables_filter input').unbind().keyup(function(e) {
    var value = $(this).val();
    if (value.length>3) {
        //alert(value);
        table.search(value).draw();
    } else {     
        //optional, reset the search if the phrase 
        //is less then 3 characters long
        table.search('').draw();
    }        
});

 // SEARCH FILTER REVISED
 
 $( table.table().container() ).on( 'keyup', '.fhead tr.firstrow input', function (e) {
       if(e.keyCode == 13) {
        // table.state.clear();
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
        }
    } );
 });
$('#checkboxid1').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var table=$('#comp-table').DataTable();
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });


$(document).on("click", "#delsession", function(){
          event.preventDefault ;
        var table=$('#comp-table').DataTable();
          table.state.clear();
 
          
          window.location.reload();
          // window.location.href = "{{ route('clients.index')}}";
});
$( document ).ready(function() {
  
  $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
  var newid1 =$.urlParam('newid');
    console.log(newid1);

    if (newid1 != undefined ||  newid1 != null){
         var table = $('#comp-table').DataTable();
          table.search(newid1).draw();  
    }
  });
//month and year wise selection
$('.filternewdialaccont').on('click', function(){
  var table = $('#comp-table').DataTable();
  $('.filternewdialaccont').removeClass('active');
  $(this).addClass('active');
  var filter_value = $(this).text();
  var selecteddate=$('#newcompanymonth').val();
  var selectedvalue=filter_value+'^'+$('#newcompanyselectionid').val()+'^'+selecteddate;

    var new_url = "{{ route('clickclients.unassignclicknewcompanyanydata',':id') }}";
    new_url = new_url.replace(':id',selectedvalue);
    

    $.ajax({
                  type: "get",
                  url: new_url,
                 
                   
                   success: function(data){    
                             
                      
                        $('#comp-table').DataTable().ajax.url(new_url).load();
                          
                                         
                   },
                     
          });

  // var new_url = "{{ route('clickclients.anydata',':id') }}";
  // new_url = new_url.replace(':id',filter_value);
  // table.ajax.url(new_url).load();


});
//select value by dropdown
$('#newcompanyselectionid').on('change', function(){

    $('.filternewdialaccont').removeClass('active');
    $('#allid').addClass('active');
    var selectedvalue='ALL^'+$('#newcompanyselectionid').val();

    if($('#newcompanyselectionid').val() == "Select Month"){
        $('#selectdatepopup').modal('show');
        return false;
    }

    var new_url = "{{ route('clickclients.unassignclicknewcompanyanydata',':id') }}";
    new_url = new_url.replace(':id',selectedvalue);
    

    $.ajax({
                  type: "get",
                  url: new_url,
                 
                   
                   success: function(data){    
                             
                      
                        $('#comp-table').DataTable().ajax.url(new_url).load();
                          
                                         
                   },
                     
          });
 
});
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
   // var id=document.getElementById("dispositioncompanyid").value;
    var id=document.getElementById("companydispositionbackid").value;
    var follow_up=document.getElementById("datetimepicker").value;
    if(radiovalue == "Call Back" || radiovalue == "Follow Up"){
      var datedispo=radiovalue;
    }
    if(radiovalue == "Business Closed" || radiovalue == "Hang Up" || radiovalue == "Not Interested" || radiovalue == "Wrong Number" || radiovalue == "Sale" || radiovalue == "Interested" || radiovalue == "Follow Up" || radiovalue == "Call Back" || radiovalue == "Cancel" || radiovalue == "Authority Not Available" || radiovalue == "Do Not Call" || radiovalue == "In House" || radiovalue == "In House" || radiovalue == "Business Sold"){
      var mustdispo=radiovalue;
    }
    if(radiovalue == ""){
      document.getElementById("submitdisposition").disabled = false;
      toastr.error('Please write new disposition!');
      
    }
    else if(radiovalue == mustdispo && description ==''){
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
                  url: "{{route('disposition.companyclickdispositionstore')}}",
                  data: {
                              "_token": "{{ csrf_token() }}",
                              "description":description, 
                              "status":radiovalue,  
                              "id":id, 
                              "follow_up":follow_up, 
                        },
                   
                   success: function(data){    
                             
                        $( "#companydispositionmodal" ).modal("hide");
                        $('#comp-table').DataTable().ajax.reload(null, false);
                          //table.ajax.reload( null, false );               
                        toastr.success('New Disposition entered successfully!'); 
                        win3cx.close(); 
                                         
                   },
                     
          });
      }
 }); 
 $('#showorderdetail').on('click',function(){
var cid=document.getElementById("companydispositionbackid").value;
 $.ajax({
                type: "post",
                url: "{{route('clickcompany.orderdetail')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "company_id":cid,
                             'frommodal':"yesy",
                             
                             
                            
                       },            
                 success: function(data){    
                
                         $( "#exampleModalCenter" ).modal("show");
                         $('#orderdetail').empty();
                         $('#orderdetail').append(data);
                        // $("#companydispositionbackid").val(data);
                        // $('#companyid').val(cid);
                        // $('#companycallingnumber').val(obj);
                        // $( '#modelHeading1' ).html("Disposition");           
                 },
                   
      });

 }); 
 //month and year selection for new company added
 $('#newcompanymonth').datepicker( {
            changeMonth: true,
            changeYear: true,
             minViewMode: "months",
            showButtonPanel: true,
            dateFormat: 'mm-yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
  });
 //search new company 
 $('#searchnewcompanyid').on('click',function(){
  var monthyearis=$('#newcompanymonth').val();
     
  if(monthyearis != ""){

    var  months = {"01":"Jan", "02":"Feb","03":"Mar","04":"Apr","05":"May","06":"June","07":"July","08":"Aug","09":"Sep","10":"Oct","11":"Nov","12":"Dec"};

    const firsttwo = monthyearis.substring(0, 2);
    const lastdigit = monthyearis.substring(2, 7);


    $('#selecteddateshowid').text(months[firsttwo]+lastdigit);
    
    var selectedvalue='ALL^'+$('#newcompanyselectionid').val()+'^'+$('#newcompanymonth').val();
    // var selectedmonthyear=$('#newcompanymonth').val();
    var new_url = "{{ route('clickclients.unassignclicknewcompanyanydata',':id') }}";
    new_url = new_url.replace(':id',selectedvalue);
    

        $.ajax({
                  type: "get",
                  url: new_url,
                  success: function(data){        
                      
                        $('#comp-table').DataTable().ajax.url(new_url).load();
                        $('#selectdatepopup').modal('hide');
                                          
                   },
                     
        });

  }
  else{
          //alert('hi');
  }
  
 
 });

 $('#showdispositiondetail').on('click',function(){
  var cid=document.getElementById("companydispositionbackid").value;

    $.ajax({
                type: "post",
                url: "{{route('clickcompany.dispositiondetail')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "company_id":cid,
                             'frommodal':"yesy",
                             
                             
                            
                       },            
                 success: function(data){    
                
                         $( "#lastdispositionmodal" ).modal("show");
                         $('#lastdispositiondetail').empty();
                         $('#lastdispositiondetail').append(data);
                        // $("#companydispositionbackid").val(data);
                        // $('#companyid').val(cid);
                        // $('#companycallingnumber').val(obj);
                        // $( '#modelHeading1' ).html("Disposition");           
                 },
                   
      });
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
  

 $( '#assignuser' ).on('click',function(){
          var checkboxes = document.getElementsByName('checkbox1[]');
          var vals = "";
          var aIds = [];
          var table=$('#comp-table').DataTable();
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

 jQuery('#datetimepicker').datetimepicker();
 function orderinformation(cid){
   $.ajax({
                type: "post",
                url: "{{route('clickcompany.orderdetail')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "company_id":cid,
                             
                             
                            
                       },            
                 success: function(data){    
                
                         $( "#exampleModalCenter" ).modal("show");
                         $('#orderdetail').empty();
                         $('#orderdetail').append(data);
                        // $("#companydispositionbackid").val(data);
                        // $('#companyid').val(cid);
                        // $('#companycallingnumber').val(obj);
                        // $( '#modelHeading1' ).html("Disposition");           
                 },
                   
      });
 }
 function lastdispositiondetail(companyid){

  $.ajax({
                type: "post",
                url: "{{route('clickcompany.dispositiondetail')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "company_id":companyid,
                             'frommodal':"simple",
                             
                             
                            
                       },            
                 success: function(data){    
                
                         $( "#lastdispositionmodal" ).modal("show");
                         $('#lastdispositiondetail').empty();
                         $('#lastdispositiondetail').append(data);
                        // $("#companydispositionbackid").val(data);
                        // $('#companyid').val(cid);
                        // $('#companycallingnumber').val(obj);
                        // $( '#modelHeading1' ).html("Disposition");           
                 },
                   
      });

 }
 function changeFunc(){
  alert('hi');
 }
 function assignSingleUser(companyid){

  var table = $('#comp-table').DataTable();
     var $rowid = table.row( this ).index();
     var currentPageIndex = table.page.info().page;
     var target  = $(this);    
     var key  = companyid;
  
      document.getElementById("companyid").value = key;
      document.getElementById("currentPageIndexid").value =currentPageIndex;
     $( "#AssignuserModel" ).modal("show");
  
 }
function redirectToPhoneURL(obj,cid){
   
    swal({
      text: "Do you want to call !",
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
                url: "{{route('clickcompanydisposition.predispositionentryclickcompany')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "company_id":cid,
                             "companycallingnumber":obj,
                             
                            
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
   
    </script>
   
