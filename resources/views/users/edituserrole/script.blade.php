<script type="text/javascript">

	$(document).on('click','#designation',function(){
             $('#select1').val('');
				if($(this).val() == 'Business Development Executives'){
					$('.bdaauthority').addClass('followupvisible');
					$('.adminautority').removeClass('followupvisible');
				}
				else if($(this).val() == 'Sales Executives'){
					$('.bdaauthority').removeClass('followupvisible');
					$('.adminautority').addClass('followupvisible');
				}
				else if($(this).val() == 'Admin'){
					$('.bdaauthority').addClass('followupvisible');
					$('.adminautority').addClass('followupvisible');
				}

	});
</script>