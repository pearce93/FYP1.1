<?php 
	include_once("scripts/php/AP_functions.php");

	$startDate = date ("Y-m-d H:i:s", strtotime($_POST["authenticatedInStartDate"])); 
	$endDate = date ("Y-m-d H:i:s", strtotime($_POST["authenticatedInStartDate"]));
?>

	<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>


<div class="col-xs-12 col-md-8"><?php getCarPark('2', $startDate, $endDate); ?></div>
<?php getScripts() ?>
</body>
</html>