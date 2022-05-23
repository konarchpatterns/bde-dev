<script type="text/javascript">
    $(document).ready(function () {
    //user table
    	 $(function () {
       var table1=$('#userrecord').DataTable({
           processing: true,
           serverSide: true,
           async: true,
           destroy: true,
           responsive: true,
           paging:  true,
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
           ajax:"{{route('showuser.list')}}",
              columns:[
               {data:'checkbox',name:'checkbox',orderable:false,searchable:false}, 
              {data:'id',name:'id',class:'foo'},
              {data:'name',name:'name',class:"selectuser"},
              {data:'email',name:'email'},

              ],
              
            });
     });
    //select user
    $("#selectuser").on("click",function () {
    		 $( "#AssignuserModel" ).modal("show");
    		  $('#modelHeading').html("Assign User");
    });
    //close user model
    $('#closeuser').on('click',function(){
 				 $( "#AssignuserModel" ).modal("hide");
    });
    //select client
    $("#selectclient").on("click",function () {
    		 $( "#AssignclientModel" ).modal("show");
    });
    //close client model
    $('#closeclient').on('click',function(){
 				 $( "#AssignclientModel" ).modal("hide");
 				  $('#modelHeading').html("Assign User");
    });
    //add user 
	 	$("#adduser").on("click",function () {
 			$("#usertextbox").append('<div class="input-group my-group"><input type="text" name="username[]" class="form-control mt-1"><a href="#" class="remove_userfield bg-light rounded-right  mt-1"><i class="fa fa-times mt-2" style="font-size:20px;color:#E65158"></i></a></div>');	
 	    });
 	//remove user 
	    $('#usertextbox').on("click",".remove_userfield", function(){ 
		        $(this).parent('div').remove();
	    });
	//add client
 	    $("#addclient").on("click",function () {
 			$("#clienttextbox").append('<div class="input-group my-group">	<input type="text" name="clientname[]" class="form-control mt-1"><a href="#" class="remove_clientfield  mt-1 bg-light rounded-right"><i class="fa fa-times mt-2" style="font-size:20px;color:#E65158"></i></a></div>');
       	
 	    });
 	//remove client 
	    $('#clienttextbox').on("click",".remove_clientfield", function(){ 
		        $(this).parent('div').remove();
	    });
	//search company name
		$('.compinput').on("keyup", function() {
	            var comp = $("#company_name").val() ;
	            //  $.ajaxSetup({
	            //         headers: {
	            //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	            //         }
	            //     })
	            //    // e.preventDefault();

	            // var token = $('meta[name="csrf-token"]').attr('content');
	            $(this).autocomplete({
	                
	                //source: "{{ URL::to('gmails/fetchcomp') }}",
	               source: function(request, response) {
	              $.post("{{ URL::to('/getcompanyname') }}", {_token: "{{ csrf_token() }}", term: request.term, companyname: comp},
	                 response, "json");
	            },

	                minLength: 1 ,
	              
	            
	            select: function(event, ui) {
	                    //var $itemrow = $(this).closest('tr');
	                           
	                  
	                  $('#company_name').val(ui.item.company_name);
	                            
	                  //$('#client_company').focus();

	                    return false;
	              }
	            
	              }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	          return $( "<li>" )
	            .data( "ui-autocomplete-item", item )
	            .append( "<a>" +  item.company_name  +  "</a>" )
	            .appendTo( ul );
	        };
 
            $('.compinput').on("focusout", function() {
		        var value =  $.trim($(this).val());
		        $(this).val(value);
		        $(".compinput").css("text-transform", "capitalize");
		    });     
        });
    //search client name
 //    	$('.clientinput').on("keyup", function() {
	//             var clie = $("#client_name").val() ;

	//             //  $.ajaxSetup({
	//             //         headers: {
	//             //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	//             //         }
	//             //     })
	//             //    // e.preventDefault();

	//             // var token = $('meta[name="csrf-token"]').attr('content');
	//             $(this).autocomplete({
	                
	//                 //source: "{{ URL::to('gmails/fetchcomp') }}",
	//                source: function(request, response) {
	//               $.post("{{ URL::to('/getcompanyname') }}", {_token: "{{ csrf_token() }}", term: request.term, companyname: clie},
	//                  response, "json");
	//             },

	//                 minLength: 1 ,
	              
	            
	//             select: function(event, ui) {
	//                     //var $itemrow = $(this).closest('tr');
	                           
	                  
	//                   $('#client_name').val(ui.item.client_name);
	                            
	//                   //$('#client_company').focus();

	//                     return false;
	//               }
	            
	//               }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	//           return $( "<li>" )
	//             .data( "ui-autocomplete-item", item )
	//             .append( "<a>" +  item.company_name  +  "</a>" )
	//             .appendTo( ul );
	//         };
 
 //            $('.compinput').on("focusout", function() {
	// 	        var value =  $.trim($(this).val());
	// 	        $(this).val(value);
	// 	        $(".clientinput").css("text-transform", "capitalize");
	// 	    });     
 //        });
	});
</script>