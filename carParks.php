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
			</div>
		</div>
		<div class="row">

			<?php getAllCarParks(); ?>

		</div>
	</div>

	
    <?php getScripts() ?>
  </body>
</html>