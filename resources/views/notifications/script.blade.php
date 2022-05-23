<script type="text/javascript">

  $(function () {
     var table = $('#notificationrecords').DataTable({
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
        ajax: "{{ route('notification.anydata') }}",
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
               {data:'data', name:'data',"render":function(data,type,full,mete){
                          data=JSON.parse(data);
                      console.log(data['data']);
                  return data['data'];
                  }
               },
               {data:'message', name:'message'},
               {data:'read_at',name:'read_at'},
                
               // {data:'edit',name:'edit'},
               // {data:'delete',name:'delete',class:'deleterole dt-center'},    
           ], 
          

      });

  });
</script>