<script type="text/javascript">
   $(function () {
     var table = $('#activityrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,

        //scrollCollapse: true, 
        stateSave: true,
        stateDuration: -1,
        pagingType: "input",
       // bStateSave: true,
       // fixedColumns: false,
       //autowidth: false,
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
        ajax: "{{ route('activity.anydataactivity') }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
                 //  { width: '10%', targets: 0 },
                 // { width: '10%', targets: 1 },
                 //  { width: '10%', targets: 2 },
                 //  { width: '12%', targets: 3 },
                 //  { width: '10%', targets: 4 },
                 //  { width: '10%', targets: 5 },
               
          ],
          columns: [    
            {data: 'id', name: 'id',class:"fooid dt-center"},
            {data: 'name', name: 'users.name'}, 
            {data:'description',name:'description'},
            {data:'attributes2',name:'attributes2'},
            {data:'log_name',name:'log_name'},
            {data: 'attributes1', name:'attributes1', class:"attributes1show dt-center","render":function(data,type,full,mete){
               // var obj=data.replace(/_/g,"&nbsp;"); 
              return '<span data-toggle="tooltip" data-placement="left" data-html="true" title="'+ data+'">' + data + '</span>';
            }

          },
           {data:'created_at',name:'created_at'},
          //   {data: 'properties', name:'properties',"render":function(data,type,full,mete){
          //  //    var a[];
          //  // for(var k in data) {
          //  //        console.log(k, data[k]);
          //  //        a.push(k);
          //  //  }
          //  //    // console.log(a);
          //  //    return a;
           
          //  return '<span data-toggle="tooltip" title="'+ data+'">' + data + '</span>';
   
          //   }
          // },
              
            // {data:'properties', name:'properties',class:"pro dt-center","render":function(data,type,full,meta){
            //         var obj = JSON.stringify(data);
            //            var obj1=JSON.parse(obj);
            //           var attributes=JSON.stringify(obj1.attributes);
            //           if (typeof obj1.old !== 'undefined'){
            //                var old=JSON.stringify(obj1.old);
            //                console.log(attributes);
            //                var result='Updated value<br>'+ attributes +'<br> Old value<br>'+ old +'.';
            //                 return result;
            //                 // return '<span data-toggle="tooltip" title="hi">' + result + '</span>';
            //                // return result;
                  
            //           }
            //           else{
            //                 return "Record Created";
            //                // return '<span data-toggle="tooltip" title=" Record Created">Record Created</span>';
                     
            //           }
            //    }
            // },
           

           ], 

            order: [[ 0, 'desc' ]],

      });

  });
//refresh data table
$(document).ready(function () {

 $("#delsession").click(function(event) {
       
      event.preventDefault ;
      var table = $('#activityrecords').DataTable();
      table.state.clear();

      // $('.Comp').val('');
       window.location.reload();

    });
});
    $(document).on('mouseover','.pro', function(){
     // $(this).closest('tr').find( '.pro' ).css("background-color", "yellow");

        var propertydata=$(this).closest('tr').find( '.pro' ).text();
       $(this).attr('title', propertydata);
    //    $(this).tooltip({
    //     show: false,
    //     title:propertydata,
    //     hide: false

    // });

  });
  //   $(document).on('mouseout','.pro', function(){
 
  //   $(this).css("background-color", "#565759");

  // });

  //  header logic search added
$(document).ready(function () {

  $('#activityrecords tbody').on( 'click', '.attributes1show', function () {
      swal({
              text: table.cell( this ).data(),
      });
      
   });

  $('#activityrecords').on('draw.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip(); 
                  });
   
$('#activityrecords .fhead .firstrow th').each( function (i) {
        var title = $('#activityrecords th').eq( $(this).index() ).text();
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);
        if(title.trim().length> 0) {
           $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder="'+title.trim()+'" data-index="'+i+'"     class="'+titleclass+'"   />' );
        }
    } );
 // Apply the search
    var table = $('#activityrecords').DataTable();
    $( table.table().container() ).on( 'keyup', '.fhead .firstrow input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
});
</script>
