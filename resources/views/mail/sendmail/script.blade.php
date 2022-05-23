<script type="text/javascript">
 $(document).ready(function (){

 	$(' #goback ').on('click',function(){
 			  window.history.go(-1);
 	});
 	 CKEDITOR.replace( 'mailtextbox',
         {
         	
          })




 });

  $(document).on("click", "#firstmail", function(){
  		var a=document.getElementById('companynameid').value;
        var b=document.getElementById('BDEid').value;

       if(a == "" || b == ""){
              toastr.error('Please fillup user name and company/client box');   
       }
       else{ 
        var c='<b>Hello '+a+'</b>,<br><br>I hope you are doing good. I request you to go through the information that I am providing you with this email. Also, you can ask me, if you want more information.<br><br>We are in business for ten years. We specialize in providing services to promotional product and screen-printing companies in the United States and Canada. At the same time, we cater to other industries as well with various services.<br><br>Today, I would like to offer a fascinating deal that might help me to get fruits of your business. I would like to request you to try our services and see thedifference. Thereafter, you can be the best judge.<br><br>We are a top-notch service provider when it comes to:<br><br>1. -Vector Artwork Recreation<br>2. -Embroidery Digitizing-Photo Editing Services<br>3. -Order Entry Services-Data Entry Services<br>4. -E-commerce Product Upload Services <br><br>We have come up with a fascinating offer especially for you.We only charge <b>$5.50 Per Vector Recreation Logo and $1.75/1000 Stitches for Embroidery Digitizing.</b><br><br>If you do work on a regular basis I can provide you bulk pricing as well.<br><br>What’s in it for you?<br><br>1. Top-quality Design<br>2. Free revision as many times you ask for<br>3. 30 Day Billing Cycle<br>4. No Extra Charge for Rush Orders<br>5. Standard Turnaround Time 24 Hours<br>6. All Emails Responded Within Minutes<br>7. You Only Pay, If You are Satisfied with the Quality<br>8. We Provide 24/7 Service <br><br>We have more than 2000 satisfied customers from Screen Printing, Promotional Products, E-Commerce and Embroidery Industry from the United States, Canada, and the United Kingdom.<br><br>Just give us an opportunity to work for you and your company and I am sure we will take care of all your future requirements promptly.<br><br>Please confirm, once you receive this email.<br><br>Thanking you,<br><b>'+b+'</b><br>Business Development Executive<br>';
           CKEDITOR.instances.mailtextbox.setData(c); 
        }

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