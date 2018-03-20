<?php include_once("scripts/php/AP_functions.php"); ?>
<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>

    <!-- Main Content -->
    <div class="container topMargin">
    	<div class="row topMargin">
    		<div class="col-xs-12 col-sm-4">
				<a href="tel:+447926233676" class="btn btn-primary">Call Us</a>
			</div>
			<div class="col-xs-12 col-sm-4">
				<a href="mailto:pearce93@hotmail.co.uk?Subject=Accelerated%20Parking%20Enquiry" target="_top">Send E-Mail</a>
			</div>
    		<div class="col-xs-12 col-sm-4">
				<form id="whatsappMessage">
					<textarea required id="message" placeholder="Enquire here..." rows="8" cols="40"></textarea>
					<br/>
					<button onclick="sendMessage()" class="btn btn-primary">Send Quick Enquiry via WhatsApp</button>
				</form>
			</div>

		</div>
	</div>

	<?php getScripts() ?>

	<script type="text/javascript">
		function sendMessage(){
			var text = $("#message").val();
			if(text != ""){
				var test = "https://api.whatsapp.com/send?phone=447926233676&text="+text;

				window.open(
					test.replace(" ", "%20"),
					'_blank' // <- This is what makes it open in a new window.
				);
			}
			
		}
	</script>
  </body>
</html>