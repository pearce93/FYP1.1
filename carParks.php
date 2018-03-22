<?php include_once("scripts/php/AP_functions.php"); ?>
<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>

    <!-- Main Content -->
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1>Car Parks</h1>
		<input id="searchCarParks" type="text" placeholder="Search for Car Park">
			</div>
		</div>
		<div class="row">

			<?php getAllCarParks(); ?>

		</div>
	</div>

	
    <?php getScripts() ?>
	<script>
		$(document).ready(function(){
			$("#searchCarParks").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$(".carParkThumb").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
	</script>

	<!-- TODO: Add favourite car park functionality -->
	<!-- <script type="text/javascript">
		$(".heart.fa").click(function() {
			$(this).toggleClass("fa-heart fa-heart-o");
		});
	</script> -->
  </body>
</html>