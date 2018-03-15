<?php 
	$cpName = $_POST["cpName"];
	$cpCode = $_POST["cpCode"];
	$cpAddress = $_POST["cpAddress"];
	$cpPostCode = $_POST["cpPostCode"];
	$cpCity = $_POST["cpCity"];
	$cpFloors = $_POST["cpFloors"];
	$cpDetails = $_POST["cpDetails"];

	echo $cpName;
	echo "<br/><br/>";
	echo $cpCode;
	echo "<br/><br/>";
	echo $cpAddress;
	echo "<br/><br/>";
	echo $cpPostCode;
	echo "<br/><br/>";
	echo $cpCity;
	echo "<br/><br/>";
	echo $cpFloors;
	echo "<br/><br/>";
	echo $cpDetails;

	echo "<form action='test2.php' method='post'>";
	for ($i= 1; $i <= $cpFloors; $i++) { 
		echo "<h3>Floor $i</h3>";

		echo "<input name='rows$i' type='number' placeholder='Amount of Rows' required/> ";
		echo "<input name='columns$i' type='number' placeholder='Amount of Columns' required/>";
	}

	echo "<br /><br />";
	echo "<input type='submit' value='Submit' />";
	echo "</form>";
?>