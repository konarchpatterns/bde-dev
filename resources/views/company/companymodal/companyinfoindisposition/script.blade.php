<script type="text/javascript">
$(document).ready(function () {	
	//show company data on click on showdata in disposition modal
    $('#showcompanydetail').on('click',function(){
       var company_id=document.getElementById('companyid').value;
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


});
</script>