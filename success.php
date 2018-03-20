<?php 
	include_once("scripts/php/AP_functions.php");
	if(!empty($_GET['tid'] && !empty($_GET['product']))){
		$GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

		$tid = $GET['tid'];
		$product = $GET['product'];
	}else{
		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>
	<div class="container mt-4">
		<h2>Thank you for purchasing <?php echo $product; ?></h2>
		<hr />
		<p>Your transaction ID is <?php echo $tid; ?></p>
		<p>Check your email for more info</p>
		<p><a href="index.php" class="btn btn-light mt-2">Go Back</a></p>
	</div>
	<?php getScripts() ?>
</body>
</html>