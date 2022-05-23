<script src="http://malsup.github.io/jquery.form.js"></script> 
<script type="text/javascript">
  //company client table 
$(function () {
     var table = $('#clientrecords').DataTable({
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

        //fix column table it must be true and add css word-break:break-word;
         paging:  true,//give pagination in bottom
          lengthMenu: [[50,-1], [50,"All"]],
        "language": {
                    @permission('client.create')
                    "lengthMenu": '<a href="JavaScript:void(0);"class="btn btn-outline btn-success rightdiv" id="newclientid">Add Client</a>'
                    @endpermission
                    },
          //Import data in datatable
        ajax: "{{ route('company.relatedclients',['id'=>$client->id]) }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
              
          ],
          columns: [   
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'client_name', name:'client_name'}, 
          @permission('show.primary-email')
            {data:'client_email_primary',name:'client_email_primary',"render":function(data,type,full,meta){

                 if(data == null || data == "")
                    {
                          return "-";
                    }
                    else{
                    var obj=data.split(",");
                        var i;
                        var text1="";
                
                        for (i = 0; i < obj.length; i++) {
        
                          text1 += '<span>'+obj[i]+'</span><br>';
                        }
                          return  text1; 
                    }
                 }
            },
          @endpermission
          @permission('contact1.show')
            {data: 'client_contact_1', name:'client_contact_1',"render":function(data,type,full,meta){
              if(data == null || data == "")
                    {
                          return "-";
                    }
                    else{
                    var obj=data.split(",");
                        var i;
                        var text1="";
                
                        for (i = 0; i < obj.length; i++) {
        
                          text1 += '<span>'+obj[i]+'</span><br>';
                        }
                          return  text1; 
                    }
              }
            },
          @endpermission 
            {data:'designation',name:'designation'},
            {data:'client_note',name:'client_note'},
            {data:'black_list',name:'black_list'},
            {data:'action',name:'action',class:'dt-center'},
 
           ], 
         
      });
  });
</script>
