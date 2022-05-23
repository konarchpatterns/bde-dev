<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

$(document).ready(function () {
 $(".selectdispositionday").on("change",function () {

	var type=$(this).val();
	$('#selectedvalueid').val(type);
	if(type == 'Custom'){
		 $("#customodalid").modal({
		 	backdrop: 'static',
            keyboard: false
        });
		 $('#firstdateid').val('');
		 $('#seconddateid').val('');
		 $('#firstdateid').focus();
		 return false;
	}
	
	var seatid=$('#seatidid').val();

		 $.ajax({
                type: "get",
                url: "{{route('seatsummary.seatdispositiondayinfo')}}",
                data: {
                            
                             "seatid":seatid,
                             "selecttype":type,
                            
                       },            
                 success: function(data){     
                       console.log(data);
                       $('.dispositionreport').empty()
                       $('.dispositionreport').append(data[0]);  
                       $('#totalcallmadeid').text(data[1]);   
                       $('#totalcallcountid').text(data[2]);
                       $('#attendedcompaniescountid').text(data[3]);
                       $('#attendedcompniestitleid').text(data[1]);
                             
                 },
                   
      });
 });
 $("#customsearchid").on("click",function () {
 	 var seatid=$('#seatidid').val();
 	 var type='Custom';
 	 var date1=$('#firstdateid').val();
 	 var date2=$('#seconddateid').val();

 	 	$.ajax({
                type: "get",
                url: "{{route('seatsummary.seatdispositiondayinfo')}}",
                data: {
                            
                             "seatid":seatid,
                             "selecttype":type,
                             "date1":date1,
                             "date2":date2
                            
                       },            
                 success: function(data){     
                       console.log(data); 
                        $("#customodalid").modal('hide');
                       $('.dispositionreport').empty()
                       $('.dispositionreport').append(data[0]);  
                       $('#totalcallmadeid').text(data[1]);   
                       $('#totalcallcountid').text(data[2]); 
                       $('#attendedcompaniescountid').text(data[3]);
                       $('#attendedcompniestitleid').text(data[1])     
                 },
                   
      });

 });
 //total call made  pie chart
 $(".totalcallgraphid").on("click",function () {
 	var seatid=$('#seatidid').val();
    var type=$(this).next().val();
    var date1=$('#firstdateid').val();
    var date2=$('#seconddateid').val();
 	$.ajax({
                type: "get",
                url: "{{route('seatsummary.seatdispositiondaychartinfo')}}",
                data: {
                            
                             "seatid":seatid,
                             "type":type,
                             "date1":date1,
                             "date2":date2
                       },            
                 success: function(data){     
                      console.log(data);
                       var dd=$.parseJSON(data[0]);

                       $('#chatmodaltitel').text(data[1]);
                        console.log(dd);
                      $('#chartmodalid').modal('show')
                       var datadf = google.visualization.arrayToDataTable(dd);
                       // Optional; add a title and set the width and height of the chart
                       var options = {'title':'Total Calls Made '+data[2]+'', 'width':650, 'height':500};

  					   // Display the chart inside the <div> element with id="piechart"
  						var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  						chart.draw(datadf, options);
        						
                            
                 },
                   
      });

 });
 
});

jQuery('#firstdateid').datepicker({dateFormat:"yy-mm-dd"});
jQuery('#seconddateid').datepicker({dateFormat:"yy-mm-dd"});
	// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
// Draw the chart and set the chart values
function drawChart() {
 

  
}
</script>