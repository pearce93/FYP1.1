<?php 
	include_once("scripts/php/AP_functions.php");

	$startDate = $_POST["inStartDate"];
	$endDate = $_POST["inEndDate"];

	echo "$startDate <br />";
	echo "$endDate <br />";


	global $db;
	db_connect();

	// prepare and bind
	$stmt = $db->prepare("INSERT INTO reservation (CarID, CarParkID, SpaceID, Paid, Active, EnterDate, EnterTime, ExitDate, ExitTime, Duration, ParkingRateID) VALUES (?, ?, ?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param("iiibbssssdi", $CarID, $CarParkID, $SpaceID, $Paid, $Active, $EnterDate, $EnterTime, $ExitDate, $ExitTime, $Duration, $ParkingRateID);

	$CarID = 1;
	$CarParkID = 1;
	$SpaceID = 15;
	$Paid = true;
	$Active = true;
	$EnterDate = "25/02/2018";
	$EnterTime = "25/02/2018";
	$ExitDate = "25/02/2018";
	$ExitTime = "25/02/2018";
	$Duration = 2.0;
	$ParkingRateID = 1;

	$stmt->execute();



	// $query = "INSERT INTO reservation (CarID) VALUES (?)";

	// $stmt = $db->prepare($query);
	// $stmt->bind_param('i', $CarID);
	// if(false === $stmt){
	// 	echo "Prepare Failed";
	// 	exit;
	// }
	// $stmt->execute();

	//Checking if the reservation has been inputted.
	if($stmt->affected_rows > 0){
		echo "yeooooooo";
		die();
	}else{
		echo "fail";
		die();
	}
	
	$stmt->close();
	$db->close();
?>
