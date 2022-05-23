<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
$( function() {
    $( "#datepicker" ).datepicker({dateFormat:"yy-mm-dd"});
    var monthtextis=$('#companymonthid option:selected').text();
    var yearis=new Date().getFullYear();
  
    $('#monthshowid').text(monthtextis+' '+yearis);

  } );
$("#datepicker").on("change",function(){
        var date1 = $(this).val();
         var userid=$('#useridid').val();
   //var date1=$('#thirddateid').val();

    $.ajax({
                type: "get",
                url: "{{route('usersummary.usercompanyinfo')}}",
                data: {
                            
                             "userid":userid,
                             "date1":date1
                            
                       },            
                 success: function(data){     
                       console.log(data); 
                       // $("#singledateid").modal('hide');
                       $('#thirddateid').val('');
                       $('#createdtitle').text(date1);
                       // $('.dispositionreport').empty()
                       // $('.dispositionreport').append(data[0]);  
                       // $('#totalcallmadeid').text(data[1]);   
                       $('#showtodaycompany').text(data); 
                       // $('#attendedcompaniescountid').text(data[3]);
                       // $('#attendedcompniestitleid').text(data[1]);     
                 },
                   
      });
        //alert(selected);
    });
$(document).ready(function () {
 $("#datecompanyid").on("click",function () {

    $("#singledateid").modal({
      backdrop: 'static',
            keyboard: false
        });
 });
 //custom search 
 $("#companymonthid").on("change",function () {
 	 var userid=$('#useridid').val();
   var month=$(this).val();
   var monthtext=$('#companymonthid option:selected').text();
 	 var year=$('#companyyearid').val();

 	 	$.ajax({
                type: "get",
                url: "{{route('usersummary.monthcompnycount')}}",
                data: {
                            
                             "userid":userid,
                              "month":month,
                              "year":year
                             
                            
                       },            
                 success: function(data){     
                          console.log(data); 
                          $('#monthshowid').text(monthtext+' '+year);
                          $('.monthcompid').empty();
                          $('.monthcompid').append(data);
                          
                 },
                   
      });

 });
 //single search
 $("#singlesearchid").on("click",function () {
   var userid=$('#useridid').val();
   var date1=$('#thirddateid').val();

    $.ajax({
                type: "get",
                url: "{{route('usersummary.usercompanyinfo')}}",
                data: {
                            
                             "userid":userid,
                             "date1":date1
                            
                       },            
                 success: function(data){     
                       console.log(data); 
                       $("#singledateid").modal('hide');
                       $('#thirddateid').val('');
                       $('#createdtitle').text(date1);
                       // $('.dispositionreport').empty()
                       // $('.dispositionreport').append(data[0]);  
                       // $('#totalcallmadeid').text(data[1]);   
                       $('#showtodaycompany').text(data); 
                       // $('#attendedcompaniescountid').text(data[3]);
                       // $('#attendedcompniestitleid').text(data[1]);     
                 },
                   
      });

 });
 
 //total call made  pie chart
 $(".totalcallgraphid").on("click",function () {
 	var userid=$('#useridid').val();
    var type=$(this).next().val();
    var date1=$('#firstdateid').val();
    var date2=$('#seconddateid').val();
    var date3=$('#thirddateid').val();
 	$.ajax({
                type: "get",
                url: "{{route('usersummary.userdispositionchartinfo')}}",
                data: {
                            
                             "userid":userid,
                             "type":type,
                             "date1":date1,
                             "date2":date2,
                             "date3":date3

                       },            
                 success: function(data){     
                      
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
jQuery('#thirddateid').datepicker({dateFormat:"yy-mm-dd"});

	// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
// Draw the chart and set the chart values
function drawChart() {
 

  
}
</script>