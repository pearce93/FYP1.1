<?php include_once("scripts/php/AP_functions.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<?php getHead(); ?>
	<title></title>


    <?php getNav(); ?>
</head>
<body>
<style type="text/css">
		.Available {
			position:relative;
			border-left: solid;
			width: 4px;
		}

		.Available:last-of-type{
			border-right: solid;
		}

		.Available:before {
			content: "\f1b9";  /* this is your text. You can also use UTF-8 character codes as I do here */
			font-family: FontAwesome;
			left:-5px;
			top:0;
		}

		.Available:hover {
			border-color: black;
			color: #1275BB;
			cursor: pointer;
		}

		.Road {
			position:relative;
			background-color: grey;
		}

		.Road{
			cursor: not-allowed;
		}

		.Road:first-of-type {
			border-left: solid;
		}

		.Road:last-of-type {
			border-right: solid;
		}
	</style>
</body>
</html>

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
	//$stmt->execute();
	$stmt->close();

	//Adding the Weekend Rate
	$query = "INSERT INTO parkingrates (CarParkID, RateAmount, RateTypeID) VALUES (?, ?, ?)";
	$stmt = $db->prepare($query);
	$stmt->bind_param("idi", $CarParkID1, $RateAmount, $RateTypeID);
	$CarParkID1 = $CarParkID;
	$RateAmount = $weekendRate;
	$RateTypeID = 2;
	//$stmt->execute();
	$stmt->close();

	getNewCarPark();

?>