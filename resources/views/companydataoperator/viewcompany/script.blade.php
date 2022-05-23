<script type="text/javascript">
  $(function () {
     var table = $('#compnyrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        // displayStart: 20,
       // scrollCollapse: true, 
      
        stateSave: true,
       
       
        pagingType: "input",
        // stateDuration: -1,
        // bStateSave: true,
        //fixedColumns: false,
       autowidth: false,
       // scrollX: false,
       // bAutoWidth: true,
       // scrollY: '400px',//scroll vertically
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

        //fixedHeader: {
        ///    header: true,
        //    footer: true
       // },
       //  scrollX: true,//scroll horizontally

        //fix column table it must be true and add css word-break:break-word;
         paging:  true,//give pagination in bottom
          //Import data in datatable

        ajax: "{{ route('company.dataoperatoranydata') }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
               // { width: "5%", targets: 0 },
               // { width: "7%", targets: 1 },
               // { width: "20%", targets: 2 },
               // { width: "10%", targets: 3 },
               // { width: "10%", targets: 4 },
               // { width: "10%", targets: 5 },
               // { width: "10%", targets: 6 },
               // { width: "10%", targets: 7 },
           
          ],
          columns: [ 
         
          
            {data:'coid', name:'coid',class:"fooid dt-center",width:'4%'},
         
            {data: 'cname', name:'company_masters.company_name'},
         
            {data: 'website_address', name:'company_masters.website_address',width:'4%',"render": function (data, type, full, meta) {
                return '<span class="filename" data-toggle="tooltip" title="' + data + '"><a href="'+ data +'"target="_blank">' + data + '</a></span>';
                           // return '<span class="filename" data-toggle="tooltip" title="' + data + '"><a href="'+ data +'"target="_blank">' + data.substring(0, 10) + '</a></span>';
              
                            }
          },
        
        
            {data: 'company_phone_no', name:'company_phone_numbers.company_phone',"render":function(data,type,full,meta){
                  if(data == null)
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
                          text1 += '<span name=phonetext[] value="'+pno+'" onclick="redirectToPhoneURL('+pno+','+full.id+','+typephone2+')" data-toggle="tooltip" title="' + pno+'('+subdd[1] + '">'+pno+'<i class="fa fa-phone-square" aria-hidden="true" style="color:#51C248"></i> ('+subdd[1]+ '</span><br>';
                        }
                          return  text1;
                 }
                            
              }
            },
           
            {data: 'company_email_add', name:'company_email_addresses.company_email',"render":function(data,type,full,meta){
                    if(data == null)
                    {
                          return "-";
                    }
                    else{
                     var obj=data.split(",");
                        var i;
                        var text1="";
                  
                        for (i = 0; i < obj.length; i++) {
                         
                         
                          var dd=obj[i];
                          var subdd=dd.split("(");

                          var cemail="'"+subdd[0]+"'";
                          text1 += '<span name=emailtext[] value="'+cemail+'"  data-toggle="tooltip" title="' + subdd[0]+'('+subdd[1] + '" >'+subdd[0]+'<i class="fa fa-envelope" aria-hidden="true" style="color:black"></i>('+subdd[1]+'</span><br>';
                         // text1 += '<span name=emailtext[] value="'+cemail+'" onclick="redirectToEmailURL('+cemail+')" data-toggle="tooltip" title="' + subdd[0]+'('+subdd[1] + '">'+subdd[0]+'<i class="fa fa-envelope" aria-hidden="true" style="color:white"></i>('+subdd[1]+'</span><br>';
                        }
                          return  text1; 
                  }

                   
                    
              }
            },
            
        
      @role('data.entry.manager')
            {data:'name',name:'users.name',class:'assignuserclass dt-center',"render":function(data,type,full,meta){
              return '<sapn onclick="assignSingleUser('+full.id+')">'+data+'</span>';
            }},
      @endrole
            {data: 'state', name: 'company_addresses.state'}, 
         
            {data: 'Country', name: 'company_addresses.Country',width:'10%'},    
          
            {data: 'time_zone', name: 'company_addresses.time_zone'}, 
        
        
          {data: 'created_atus', name: 'company_masters.created_atus',"render": function (data, type, full, meta) {
                          if(data == null)
                          {
                             return "-";
                          }
                          else{
                              var obj=data.split("<br>");
                              var datefor=obj[0].split(" "); 
                              var newdate = datefor[0].split("-").reverse().join("-");
                              var finaldate=newdate + data.slice(10);
                            return '<span class="filename"  data-html="true" data-toggle="tooltip" title="' + finaldate + '">' + finaldate + '</a></span>';
                          }  
                            }},
           
           ], 
        
            order: [[ 0, 'desc' ]],
      

      });

  });
$(document).ready(function () {

 $("#delsession").click(function(event) {
     
      event.preventDefault ;
      var table = $('#compnyrecords').DataTable();
      table.state.clear();
      window.location.reload();

    });
});
$('.filternewdialaccont').on('click', function(){
  var table = $('#compnyrecords').DataTable();
  $('.filternewdialaccont').removeClass('active');
  $(this).addClass('active');
  var filter_value = $(this).text();

  var new_url = "{{ route('company.anydata',':id') }}";
  new_url = new_url.replace(':id',filter_value);
  table.ajax.url(new_url).load();
});



//  header logic search added
$(document).ready(function () {
    $('#compnyrecords').on('draw.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip({
    trigger : 'hover'
});
                  });
$('#compnyrecords .fhead .firstrow th').each( function (i) {
        var title = $('#compnyrecords th').eq( $(this).index() ).text();
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);
        if(title.trim().length> 0) {
          if(title == "Created at"){
           $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder="yyyy-mm-dd" data-index="'+i+'"     class="'+titleclass+'"   />' );
          }
          else{
            $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder="'+title.trim()+'" data-index="'+i+'"     class="'+titleclass+'"   />' );
          }
        }
    } );
 // Apply the search
    var table = $('#compnyrecords').DataTable();
    $( table.table().container() ).on( 'keyup', '.fhead .firstrow input', function () {
        table
            .column( $(this).data('index') )
            .search(this.value)
            .draw();
    });
});

</script>
