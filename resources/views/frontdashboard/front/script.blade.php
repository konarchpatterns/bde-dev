<script type="text/javascript">
$(document).ready(function(){
function loadlink(){
  $.ajax({
        url: "{{route('dispostion.record')}}",
  	    type:"get",    
        success: function(data){
        	 $("#clAnsweringMachine").html(data.clansweringmachine);
        	 $("#clNoAnswer").html(data.clnoanswer); 
        	 $("#clBusyNumber").html(data.clbusynumber);
        	 $("#coAnsweringMachine").html(data.coansweringmachine);
        	 $("#coNoAnswer").html(data.conoanswer); 
        	 $("#coBusyNumber").html(data.cobusynumber);

        }});
  }
  loadlink();
  setInterval(function(){
    loadlink() // this will run after every 5 seconds
}, 5000);
});

</script>