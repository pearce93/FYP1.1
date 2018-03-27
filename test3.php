<?php 
	include_once("scripts/php/AP_functions.php");

	global $db;
	db_connect();

	$weekendRate = $_POST["weekendRate"];
	$weekdayRate = $_POST["weekdayRate"];
	$CarParkID = 0;
	echo "$weekendRate";
	echo "$weekdayRate";

	$sql = "SELECT MAX(CarParkID) AS CarParkID FROM carpark";
	$result = $db->query($sql); 
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$CarParkID = $row["CarParkID"];
		}
	}

	//Adding the Weekday Rate
	$query = "INSERT INTO parkingrates (CarParkID, RateAmount, RateTypeID) VALUES (?, ?, ?)";
	$stmt = $db->prepare($query);
	$stmt->bind_param("idi", $CarParkID1, $RateAmount, $RateTypeID);
	$CarParkID1 = $CarParkID;
	$RateAmount = $weekdayRate;
	$RateTypeID = 1;
	$stmt->execute();
	$stmt->close();

	//Adding the Weekend Rate
	$query = "INSERT INTO parkingrates (CarParkID, RateAmount, RateTypeID) VALUES (?, ?, ?)";
	$stmt = $db->prepare($query);
	$stmt->bind_param("idi", $CarParkID1, $RateAmount, $RateTypeID);
	$CarParkID1 = $CarParkID;
	$RateAmount = $weekendRate;
	$RateTypeID = 2;
	$stmt->execute();
	$stmt->close();

	header("Location: test4.php");

?>