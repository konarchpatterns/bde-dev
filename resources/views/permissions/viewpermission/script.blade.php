<script type="text/javascript">
   $('[data-toggle="tooltip"]').tooltip();
   $(function () {
     var table = $('#permissionrecords').DataTable({
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
        ajax: "{{ route('permission.anydata') }}",
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
               {data:'name', name:'name',class:"permissionname dt-center"},
               {data:'slug',name:'slug',class:"permissionslug dt-center"},
               {data:'description',name:'description',class:"permissiondescription dt-center"}, 
              @permission('edit.permission')  
               {data:'edit',name:'edit',class:'editpermission dt-center'}, 
              @endpermission
              @permission('delete.permission')  
               {data:'delete',name:'delete',class:'deletepermission dt-center'},
              @endpermission 
            
           ], 
         order: [[ 0, 'desc' ]],

      });

  });
      //refresh data table
    $(document).ready(function () {

     $("#delsession").click(function(event) {
           
          event.preventDefault ;
          var table = $('#permissionrecords').DataTable();
          table.state.clear();

          // $('.Comp').val('');
           window.location.reload();

        });
    });
 //create permission script
  $(document).on("click", ".createpermission", function(){
       $( "#CreatePermissionModel" ).modal("show");
       $( '#modelHeading' ).html("Create Permission");
  });
  //submit permission
  $(document).on("click", ".submitpermission", function(){
    var table = $('#permissionrecords').DataTable();
    var name= document.getElementById("name").value;
    var slug= document.getElementById("slug").value;
    var description=document.getElementById("description").value;
    var model=document.getElementById("model").value;
    if(name === "" || slug == "" ){
       toastr.error('Please fill up data!');  
    }
    else{
     $.ajax({
                  type: "post",
                  url: "{{route('permission.store')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               "name":name, 
                               "slug":slug,  
                               "description":description, 
                               "model":model,
                        },
                   
                   success: function(data){               
                          toastr.success('New Permission created successfully!');  
                          table.ajax.reload( null, true ); 
                          $( "#CreatePermissionModel" ).modal("hide");                
                   },
                     
                  });

    }
  });
  //close create model script
  $(document).on("click", ".closepermission", function(){
         $( "#CreatePermissionModel" ).modal("hide");
  });
  //open edit permission modal 
  $(document).on("click", ".editpermission", function(){
    var table = $('#permissionrecords').DataTable();
    var $rowid = table.row( this ).index();
    var currentPageIndex = table.page.info().page;
    var target  = $(this);    
    var key  = $(this).closest('tr').find('td.fooid').text();
    var name  = $(this).closest('tr').find('td.permissionname').text();
    var slug  = $(this).closest('tr').find('td.permissionslug').text();
    var description  = $(this).closest('tr').find('td.permissiondescription').text();
    
     $( '#UpdatePermissionModel' ).modal("show");
      document.getElementById("permissionid").value = key;
      document.getElementById("currentPageIndexid").value =currentPageIndex;
      document.getElementById("updatename").value =name;
      document.getElementById("updateslug").value =slug;
      document.getElementById("updatedescription").value =description;
     $( '#modelHeading1' ).html("Update Permission");

  });
  //close update modal script
  $(document).on("click", ".closeupadepermission", function(){
         $( "#UpdatePermissionModel" ).modal("hide");
  });
  //update permission script
  $(document).on("click", ".submitupdatepermission", function(){
    
      var table = $('#permissionrecords').DataTable();
      var name= document.getElementById("updatename").value;
      var id= document.getElementById("permissionid").value;
      var slug=document.getElementById("updateslug").value;
      var description=document.getElementById("updatedescription").value;
      if(name === ""){
         toastr.error('Please fill up data!');  
      }
      else{
    
       $.ajax({
                  type: "post",
                  url: "{{route('permission.update')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               'id':id,
                               "name":name, 
                               "slug":slug,
                              "description":description,   
                        },
                   
                   success: function(data){    
                             
                          toastr.success('Permission Updated successfully!');
                          table.ajax.reload( null, true );        
                          $( "#UpdatePermissionModel" ).modal("hide");                
                   },
                     
                  });
    }
  });
  //delete permission
  $(document).on("click", ".deletepermission", function(){
    var name  = $(this).closest('tr').find('td.permissionname').text();
     swal({
      text: "Do you want to delete "+name+" Permission?",
      // text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
     })
    .then((willDelete) => {
    if (willDelete) {  
        var table = $('#permissionrecords').DataTable();
        var id= $(this).closest('tr').find('td.fooid').text(); 
        var permissionid={permission_id:id}
            $.ajax({
                 type: "GET",
                 cache: false,
                 async: true,
                 datatype: "json",
                 url: "{{route('permission.destroy')}}",
                 data: permissionid,
                 
                 success: function(data){    
                          
                            table.ajax.reload( null, false );               
                            toastr.success("Delete permission succesfully");
                 },
                   
            });    
    } 
    else 
    {
         toastr.warning('You canceled delete operetion');  
    }
      
    }); 
  }); 
</script>;