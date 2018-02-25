<?php 
	include_once("scripts/php/AP_functions.php");

	$startDate = $_POST["inStartDate"];
	$endDate = $_POST["inEndDate"];
	$spaceType = $_POST["spaceSelected"];
	
	echo "$startDate <br />";
	echo "$endDate <br />";
	echo "$spaceType <br />";

	global $db;
	db_connect();

	// prepare and bind
	$stmt = $db->prepare("INSERT INTO reservation (CarID, CarParkID, SpaceID, Paid, Active, EnterDate, ExitDate, Duration, ParkingRateID, SpaceTypeID) VALUES (?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param("iiibbssdii", $CarID, $CarParkID, $SpaceID, $Paid, $Active, $EnterDate, $ExitDate, $Duration, $ParkingRateID, $SpaceTypeID);

	$CarID = 1;
	$CarParkID = 1;
	$SpaceID = 15;
	$Paid = true;
	$Active = true;
	$EnterDate = $startDate;
	$ExitDate = $endDate;
	$Duration = 2.0;
	$ParkingRateID = 1;
	$SpaceTypeID = $spaceType;

	$stmt->execute();

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
