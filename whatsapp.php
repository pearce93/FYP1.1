<?php include_once("scripts/php/AP_functions.php"); ?>
<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>
	<form id="whatsappMessage">
		<textarea required id="message" placeholder="Enquire here..." rows="8" cols="40"></textarea>
		<br/>
		<button onclick="sendMessage()">Send Message</button>
	</form>

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