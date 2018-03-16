<?php 
	require_once("scripts/php/AP_functions.php");

	global $db;
	db_connect();
	
	$cpName = $_POST["cpName"];
	$cpCode = $_POST["cpCode"];
	$cpAddress = $_POST["cpAddress"];
	$cpPostCode = $_POST["cpPostCode"];
	$cpCity = $_POST["cpCity"];
	$cpFloors = $_POST["cpFloors"];
	$cpDetails = $_POST["cpDetails"];

	echo "cpName - ";var_dump($cpName);
	echo "<br/><br/>";
	echo "cpCode - ";var_dump($cpCode);
	echo "<br/><br/>";
	echo "cpAddress - ";var_dump($cpAddress);
	echo "<br/><br/>";
	echo "cpPostCode - ";var_dump($cpPostCode);
	echo "<br/><br/>";
	echo "cpCity - ";var_dump($cpCity);
	echo "<br/><br/>";
	echo "cpFloors - ";var_dump($cpFloors);
	echo "<br/><br/>";
	echo "cpDetails - ";var_dump($cpDetails);

	$query = "INSERT INTO carpark (`CarParkName`, `CarParkCode`, `Address`, `PostCode`, `City`, `Details`, `Floors`) VALUES (?, ?, ?, ?, ?, ?, ?)";

	$stmt = $db->prepare($query);
	$stmt->bind_param("sssssss", $cpName, $cpCode, $cpAddress, $cpPostCode, $cpCity, $cpDetails, $cpFloors);

	$cpName = $_POST["cpName"];
	$cpCode = $_POST["cpCode"];
	$cpAddress = $_POST["cpAddress"];
	$cpPostCode = $_POST["cpPostCode"];
	$cpCity = $_POST["cpCity"];
	$cpFloors = $_POST["cpFloors"];
	$cpDetails = $_POST["cpDetails"];

	//$stmt->execute();

	echo "New records created successfully";

	$stmt->close();
	$db->close();

	echo "<form action='test2.php' method='post'>
	";
	for ($i= 1; $i <= $cpFloors; $i++) { 
		echo "<h3>Floor $i</h3>";

		echo "<input name='rows$i' type='number' placeholder='Amount of Rows' required/> ";
		echo "<input name='columns$i' type='number' placeholder='Amount of Columns' required/>";
	}

	echo "<br /><br />
			<input type='hidden' value='$cpFloors' name='Floors'/>";
	
	echo "<input type='submit' value='Submit' />";
	echo "</form>";
?>