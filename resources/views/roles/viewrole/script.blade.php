<script type="text/javascript">
   $('[data-toggle="tooltip"]').tooltip();
   $(function () {
     var table = $('#rolerecords').DataTable({
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
        ajax: "{{ route('role.anydata') }}",
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
           
               {data: 'id', name: 'id',class:'fooid dt-center'},
               {data:'name', name:'name',class:'rolename dt-center'},
               {data:'slug',name:'slug'},
               {data:'level', name:'level'},
             @permission('edit.role') 
               {data:'edit',name:'edit'},
             @endpermission
             @permission('delete.role')      
               {data:'delete',name:'delete',class:'deleterole dt-center'},   
             @endpermission 
           ], 
          

      });

  });
   //refresh data table
    $(document).ready(function () {

     $("#delsession").click(function(event) {
           
          event.preventDefault ;
          var table = $('#rolerecords').DataTable();
          table.state.clear();

          // $('.Comp').val('');
           window.location.reload();

        });
    });
  //delete role
    $(document).on("click", ".deleterole", function(){
      var name  = $(this).closest('tr').find('td.rolename').text();
      swal({
        text: "Do you want to delete "+name+" Role?",
        // text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    .then((willDelete) => {
      if (willDelete) { 
        var table = $('#rolerecords').DataTable();
        var id= $(this).closest('tr').find('td.fooid').text(); 
        var roleid={role_id:id}
            $.ajax({
                 type: "GET",
                 cache: false,
                 async: true,
                 datatype: "json",
                 url: "{{route('role.destroy')}}",
                data: roleid,
                 
                 success: function(data){    
                          
                            table.ajax.reload( null, false );               
                            toastr.success("Delete role succesfully");
                 },
                   
            });
        
    } 
    else 
    {
         toastr.warning('You canceled delete operetion');  
    }
      
    });
  });   

</script>