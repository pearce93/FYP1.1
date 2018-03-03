<?php 
	include_once("scripts/php/AP_functions.php");

	$startDate = date ("Y-m-d H:i:s", strtotime($_POST["inStartDate"])); 
	$endDate = date ("Y-m-d H:i:s", strtotime($_POST["inEndDate"])); 
	$spaceType = $_POST["spaceSelected"];
	
	$carSpaceArray = array();
	$spaceList = array();

	global $db;
	db_connect();

	// prepare and bind
	$stmt = $db->prepare("INSERT INTO reservation (CarID, CarParkID, SpaceID, Paid, Active, EnterDate, ExitDate, Duration, ParkingRateID, SpaceTypeID, Price) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param("iiibbssdiid", $CarID, $CarParkID, $SpaceID, $Paid, $Active, $EnterDate, $ExitDate, $Duration, $ParkingRateID, $SpaceTypeID, $Price);

	//CarID doesn't need to be selected for a random User.
	$CarID = 7;
	//CarParkID = the value that we have recieved from the function call.
	$CarParkID = 1;

	//Filtering between start and end date to find out what spaces are free on those dates.
	$sql = "SELECT * FROM `reservation` WHERE EnterDate >= '$startDate' AND ExitDate <= '$endDate'";
    $result = $db->query($sql);

    //If there are spaces already booked between these dates then ensure the user does not book/reserve that space.
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
      	//Adding the spaces that are currently booked to an array.
      	array_push($carSpaceArray,$row["SpaceID"]);        
      }

      //Finding all the spaces in the chosen car park that match the space type provided by the user.
      $sql = "SELECT * FROM `Space` WHERE CarParkID = $CarParkID AND SpaceTypeID = $spaceType";
      $result = $db->query($sql);

      if($result->num_rows > 0) {
      	while($row = $result->fetch_assoc()) {
      		//Adding matching Space Types of chosen car park to an array.
	      	array_push($spaceList,$row["SpaceID"]);        
      	}

      	//Comparing Arrays to find the values that are in both. If result is in both then ensure that user cannot be given that space.
      	$result = array_intersect ($carSpaceArray, $spaceList);

		//Exclude Results and select the first Car Park Space that is found based on the spacetype.
      	$filterSpaces = "SELECT * FROM Space WHERE SpaceTypeID = $spaceType ";

      	//Building SQL string that will exclude already booked spaces.
		foreach ($result as $value) {			
			$filterSpaces .= " AND SpaceID != $value ";
		}

		//Assigning first available space to $SpaceID
		$result = $db->query($filterSpaces);		
		$row = $result->fetch_assoc();
		$SpaceID = (int)$row["SpaceID"];

      }
    }else{
    	//User can be given first available space with no check needed because the dates have already been compared and everything was fine.
    	echo "Insert here";
    }

	//Getting the total amount of minutes they have reserved.
	$Duration = getTimeDifference($startDate, $endDate);
	$Paid = false;
	$Active = false;
	$EnterDate = $startDate;
	$ExitDate = $endDate;
	//Finding out if the weekend charge will apply or not.	
	$day=strftime("%A",strtotime($startDate));	
	switch ($day) {
		//Assigning the weekend charge
		case 'Saturday':
			$ParkingRateID = 2;
			break;
		case 'Sunday':
			$ParkingRateID = 2;
			break;
		default:
			//Defaulting $ParkingRateID to Weekday times.
			$ParkingRateID = 1;
			break;
	}

	//echo $ParkingRateID; 
	$timestamp = strtotime($startDate);

	$day = date('D', $timestamp);

	if($day == 6 || $day == 7){
		$ParkingRateID = 2;
	}else{
		$ParkingRateID = 1;
	}

	$SpaceTypeID = (int)$spaceType;

	$sql = "SELECT * FROM ParkingRates WHERE RateTypeID = $ParkingRateID AND CarParkID = $CarParkID";
	$result = $db->query($sql);

	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$hours = $Duration / 60;
			$Price = $row["RateAmount"] * $hours;

			// echo $row['RateAmount'];
			// echo "  * $Duration";
			// echo "----------------------";

			// echo $Price;
		}
	}

	//var_dump($stmt);
		var_dump($CarID);
		echo " - CarID <br /><br />";
		var_dump($CarParkID);
		echo " - CarParkID <br /><br />";
		var_dump($SpaceID);
		echo " - SpaceID <br /><br />";
		var_dump($Paid);
		echo " - Paid <br /><br />";
		var_dump($Active);
		echo " - Active <br /><br />";
		var_dump($EnterDate);
		echo " - EnterDate <br /><br />";
		var_dump($ExitDate);
		echo " - ExitDate <br /><br />";
		var_dump($Duration);
		echo " - Duration <br /><br />";
		var_dump($ParkingRateID);
		echo " - ParkingRateID <br /><br />";
		var_dump($SpaceTypeID);
		echo " - SpaceTypeID <br /><br />";

	$stmt->execute();
	var_dump($stmt);
	//Checking if the reservation has been inputted.
	if($stmt->affected_rows > 0){
		echo "yeooooooo";
	}else{
		echo "fail";
	}
	
	$stmt->close();
	$db->close();


	
	function getTimeDifference($startDate, $endDate){
		global $db;

		$sql = "SELECT TIMESTAMPDIFF(MINUTE,'$startDate','$endDate')";
		$result = $db->query($sql);
		if($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				return (double)$row["TIMESTAMPDIFF(MINUTE,'$startDate','$endDate')"];		
			}
		}else{

		}
	};
		die();
?>

