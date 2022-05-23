<script type="text/javascript">
$(document).ready(function () {  
//show client data on click on showdata in disposition modal
 $('#showclientdetail').on('click',function(){
       var client_id=document.getElementById('clientid').value;
       var table = $('#clientdispositionlistitable').DataTable();
       table.destroy();
        
          var clientid={clientid:client_id};
        $.ajax({
                 type: "GET",
                 cache: false,
                 async: true,
                 datatype: "json",
                 url: "{{route('client.showdataclientindisposition')}}",
                 data: clientid,
                 
                 success: function(data){  
                    // console.log(data[0].company_name);
                   data[0].forEach(function(entry) {
                      $('#clientname_d').text(entry.client_name);
                      $('#designation_d').text(entry.client_designation);
                   });
                   data[1].forEach(function(entry) {
                      $('#clientcountry_d').text(entry.County);
                      $('#clientstate_d').text(entry.state);
                      $('#clientcity_d').text(entry.Country);
                      $('#clienttimezone_d').text(entry.time_zone);
                   });
                   data[2].forEach(function(entry) {
                      $('#clientcompanyname_d').text(entry.company_name);
                   });
                   $("#companyclientlistitable tbody").html(data[3]);

                   $("#clientdispositionlistitable tbody").html(data[4]);
                    $("#clientdispositionlistitable").dataTable({ 
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
                    console.log(data[4]);
                  $('#clientinfoindisposition').modal("show");            
                 },
                   
            });
    
 });
 //close company info in disposition popup  close button
  $(document).on("click", "#clientinfoclose", function(){
          $('#clientinfoindisposition').modal('hide');
   });
 //tooltip
 $('#clientdispositionlistitable').on('draw.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip(); 
  });
});
 </script>