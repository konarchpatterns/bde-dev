<script type="text/javascript">
   $('[data-toggle="tooltip"]').tooltip();
   $(function () {
     var table = $('#seatrecords').DataTable({
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
        //fix column table it must be true and add css word-break:break-word;
         paging:  true,//give pagination in bottom
          //Import data in datatable
        ajax: "{{ route('csvseat.csvnameindex') }}",
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
           
               {data: 'id', name: 'id',class:"fooid dt-center"},
               
              {data:'useatname', name:'useatname',class:"seatnamecl dt-center"},
              {data:'seatdeatails',name:'seatdeatails',class:"seatdetailcl dt-center"},
              {data:'nocompany', name:'nocompany',class:"seatnamecl dt-center"},
              {data:'created_at', name:'created_at',class:"seatnamecl dt-center"},
              @permission('show.csv.list')  
                  {data:'show',name:'show',class:'deletepermission dt-center'},
               @endpermission
               @permission('edit.csv.list')  
                  {data:'edit',name:'edit',class:'editpermission dt-center'}, 
               @endpermission
             
           ], 
         order: [[ 0, 'desc' ]],

      });

  });
      //refresh data table
    $(document).ready(function () {

     $("#delsession").click(function(event) {
           
          event.preventDefault ;
          var table = $('#seatrecords').DataTable();
          table.state.clear();

          // $('.Comp').val('');
           window.location.reload();

        });
    });

   
  //open edit permission modal 
  $(document).on("click", ".editpermission", function(){
    var table = $('#seatrecords').DataTable();
    var $rowid = table.row( this ).index();
    var currentPageIndex = table.page.info().page;
    var target  = $(this);    
    var key  = $(this).closest('tr').find('td.fooid').text();
    var name  = $(this).closest('tr').find('td.seatnamecl').text();
    var deatil  = $(this).closest('tr').find('td.seatdetailcl').text();
  
    
     $( '#UpdatePermissionModel' ).modal("show");
      document.getElementById("permissionid").value = key;
      document.getElementById("currentPageIndexid").value =currentPageIndex;
      document.getElementById("updatename").value =name;
      document.getElementById("updatedetail").value =deatil;
     $( '#modelHeading1' ).html("Update Permission");

  });
  //close update modal script
  $(document).on("click", ".closeupadepermission", function(){
         $( "#UpdatePermissionModel" ).modal("hide");
  });
  //update permission script
  $(document).on("click", ".submitupdatepermission", function(){
    
      var table = $('#seatrecords').DataTable();
      var name= document.getElementById("updatename").value;
      var id= document.getElementById("permissionid").value;
      var name=document.getElementById("updatename").value;
      var detail=document.getElementById("updatedetail").value;
      if(name === ""){
         toastr.error('Please fill up data!');  
      }
      else{
    
       $.ajax({
                  type: "post",
                  url: "{{route('csvseat.csvupdate')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               'id':id,
                               "name":name, 
                               "detail":detail,
                                
                        },
                   
                   success: function(data){    
                             
                          toastr.success('Data updated successfully!');
                          table.ajax.reload( null, true );        
                          $( "#UpdatePermissionModel" ).modal("hide");                
                   },
                     
                  });
    }
  }); 
</script>;