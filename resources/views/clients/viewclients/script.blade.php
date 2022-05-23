<script type="text/javascript">
  var win3cx="";
   $('[data-toggle="tooltip"]').tooltip();
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
        location.href=url;
   }
   else{
   }
  });
}
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
        .val('')
        document.getElementById("submitclientpermission").disabled = false;
        $(' #followupid ').addClass('followupvisible');
        $('#datetimepicker').val('');
        $('#clientid').val('');
        $('#callingnumber').val('');
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
                        $( '#modelHeading' ).html("Disposition");                  
                 },
                   
              });
        if($('#worktypeid').val() == 'In side'){
  
        win3cx=window.open("https://157.245.98.226/webclient/#/call?phone="+pp+"",'_blank');
      }
      else{
        
         win3cx=window.open("https://patterns.3cx.in:5001/webclient/#/call?phone="+pp+"",'_blank');
      }
    



       
          
        
      

     // window.location.href="https://divyarajvaghela.3cx.in/webclient/#/call?phone="+pp+"";

   }
   else{
   }
  });

}

 $('#clientrecords tbody').on( 'click', 'phoneid', function () {
        var data = table.row( $(this).parents('tr') ).data();
        alert(data);
  });




   $(function () {
     var table = $('#clientrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
        stateSave: true,
        pagingType: "input",
        stateDuration: -1,
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
        ajax: "{{ route('client.anydata') }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
                // { width: 10, targets: 0 },
                 // { width: "10%", targets: 1 },
                // { width: 20, targets: 2 },
                // { width: 20, targets: 3 },
                // { width: 20, targets: 4 },
                // { width: 20, targets: 5 },
          ],
          columns: [ 
            //{data:'checkbox',name:'checkbox',orderable:false,searchable:false},  
       
          {data: 'id', name: 'id',class:"fooid dt-center",width:"5%"},
          @permission('view.client.name')
            {data: 'name', name:'client_masters.client_name'},
          @endpermission
          @permission('view.client.company.name')
             {data:'company_name',name:'company_masters.company_name'},
          @endpermission
          @permission('view.client.phone')
           @permission('show.client.phone')
            {data:'client_phone_no',name:'client_phone_no',class:"phoneid dt-center"
            ,"render":function(data,type,full,meta){
                  console.log(data);
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
                          text1 += '<span name=phonetext[] value="'+pno+'" onclick="redirectToPhoneURL('+pno+','+full.id+','+typephone2+')">'+pno+'<i class="fa fa-phone-square" aria-hidden="true" style="color:#51C248"></i> ('+subdd[1]+ '</span><br>';
                        }
                          return  text1;
                      
                    }
                 }
            },
            @else
             {data:'client_phone_no',name:'client_phone_no',"render":function(data,type,full,meta){

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
          @permission('view.client.email')
             @permission('show.client.email')
            {data: 'client_email_add', name:'client_email_add',"render":function(data,type,full,meta){
              if(data == null || data =='')
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
                          text1 += '<span name=emailtext[] value="'+cemail+'" >'+subdd[0]+'<i class="fa fa-envelope" aria-hidden="true" style="color:white"></i>('+subdd[1]+'</span><br>';
                          //text1 += '<span name=emailtext[] value="'+cemail+'" onclick="redirectToEmailURL('+cemail+')">'+subdd[0]+'<i class="fa fa-envelope" aria-hidden="true" style="color:white"></i>('+subdd[1]+'</span><br>';
                        }
                          return  text1; 

                    }
              }
            }, 
            @else
            {data: 'client_email_add', name:'client_email_add',"render":function(data,type,full,meta){
              
                   if(data == null || data=='')
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
                         text1 += '<span name=emailtext[] value="'+cemail+'" ><i class="fa fa-envelope" aria-hidden="true" style="font-size:20px;color:white"></i> ('+subdd[1]+'</span><br>';
                          //text1 += '<span name=emailtext[] value="'+cemail+'" onclick="redirectToEmailURL('+cemail+')"><i class="fa fa-envelope" aria-hidden="true" style="font-size:20px;color:white"></i> ('+subdd[1]+'</span><br>';
                          
                       
                        }

                   return  text1;
                 }
                 
              }

            },
            @endpermission   
          @endpermission   
          @permission('view.client.name')
            {data: 'clientlastdisposition', name:'client_masters.clientlastdisposition',"render": function (data, type, full, meta) {
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
             order: [[ 0, 'desc' ]],

      });

  });
//refresh data table
$(document).ready(function () {
 $('#clientrecords').on('draw.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip(); 
                  });
 $("#delsession").click(function(event) {
       
      event.preventDefault ;
      var table = $('#clientrecords').DataTable();
      table.state.clear();
      window.location.reload();

    });
});
//  header logic search added
$(document).ready(function () {
$('#clientrecords .fhead .firstrow th').each( function (i) {
        var title = $('#clientrecords th').eq( $(this).index() ).text();
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);
        if(title.trim().length> 0) {
           $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder="'+title.trim()+'" data-index="'+i+'"     class="'+titleclass+'"   />' );
        }
    } );
 // Apply the search
    var table = $('#clientrecords').DataTable();
    $( table.table().container() ).on( 'keyup', '.fhead .firstrow input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );

  
});

  //click ok on disposition submit button
  $(document).on('click','a#submitclientpermission.mt-2',function(){
    document.getElementById("submitclientpermission").disabled = true;
    var table = $('#clientrecords').DataTable();
    var description=document.getElementById("clientdescription").value;
    var callingphonenumber=document.getElementById("callingnumber").value;
    var dispositionbackid=document.getElementById("dispositionbackid").value;
    var ele = document.getElementsByName('optradio'); 
    var radiovalue="";     
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                  radiovalue=ele[i].value;
              
            } 
    var follow_up=document.getElementById("datetimepicker").value;
     if(radiovalue == "Call Back" || radiovalue == "Follow Up"){
        var datedispo=radiovalue;
     }
      if(radiovalue==""){
        document.getElementById("submitclientpermission").disabled = false;
        toastr.error('Please write disposition!');
     
      }
      else if(radiovalue =="Do Not Call" && description == ""){
        document.getElementById("submitclientpermission").disabled = false;
        toastr.error('Please write description');
      }
      else if(radiovalue == datedispo && follow_up ==''){
        document.getElementById("submitclientpermission").disabled = false;
        toastr.error('Please Select date!');
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
                               "follow_up":follow_up,      
                        },
                   
                   success: function(data){    
                             
                        $( "#clientdispositiondialogbox" ).modal("hide");
                          
                          toastr.success('New Disposition entered successfully!');
                          table.ajax.reload( null, false );   
                          win3cx.close(); 
                                         
                   },
                     
                  });
       $( "#clientdispositiondialogbox" ).modal("hide");
       }

  });   
//show followup textbox in disposition click on followup radio buttoon 
 $('input:radio[name=optradio]').click(function(){
        var compare=$(this).val();
        if(compare == 'Follow Up' || compare == 'Call Back' || compare == 'Interested'){
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

 
</script>
@include('clients.clientmodal.clientinfoindisposition.script')