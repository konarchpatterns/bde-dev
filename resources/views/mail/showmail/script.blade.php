<script type="text/javascript">
 $(document).ready(function (){

 	$(' #goback ').on('click',function(){
 			  window.history.go(-1);
 	});

   
        CKEDITOR.replace( 'mailtextbox',
         {
         	
          })

 });
//prevent form to store duplicate data (double click prevation)
function checkForm(form) // Submit button clicked
  {
    //
    // check form input values
    //

    form.myButton.disabled = true;
    form.myButton.value = "Please wait...";
    return true;
  }	
</script>