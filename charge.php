<?php 
	require_once('vendor/autoload.php');
	require_once('config/db.php');
	require_once('lib/pdo_db.php');
	require_once('scripts/php/AP_functions.php');

	\Stripe\Stripe::setApiKey('sk_test_DCwiZCl23EPFiixgJ0jvIASR');

	//Sanatize POST Array
	$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

	global $db;
	db_connect();

	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$emailAddress = $_POST["emailAddress"];
	$carID = $_POST["carID"];
	$CarParkID = $_POST["CarParkID"];
	$SpaceID = $_POST["SpaceID"];
	$Paid = $_POST["Paid"];
	$Active = $_POST["Active"];
	$EnterDate = $_POST["EnterDate"];
	$ExitDate = $_POST["ExitDate"];
	$Duration = $_POST["Duration"];
	$ParkingRateID = $_POST["ParkingRateID"];
	$SpaceTypeID = $_POST["SpaceTypeID"];
	$Price = $_POST["Price"];
	$token = $_POST["stripeToken"];

	echo $token;
	
	//Create Customer In Stripe
	$reservation = \Stripe\Customer::create(array(
		"email" => $emailAddress,
		"source" => $token
	));

	//Charge customer
	$charge = \Stripe\Charge::create(array(
		//Stripe doesnt use the decimal point so 5000 = £50
		"amount" => $Price,
		"currency" => "gbp",
		//Optional but beneficial because it will show what the user has bought.
		"description" => "Parking Space Booked",
		"customer" => $reservation->id
	));

	// prepare and bind
	$stmt = $db->prepare("INSERT INTO reservation (CarID, CarParkID, SpaceID, Paid, Active, EnterDate, ExitDate, Duration, ParkingRateID, SpaceTypeID, Price) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param("iiibbssdiid", $CarID, $CarParkID, $SpaceID, $Paid, $Active, $EnterDate, $ExitDate, $Duration, $ParkingRateID, $SpaceTypeID, $Price);

	$CarID = $POST["carID"];
	$CarParkID = $POST["CarParkID"];
	$SpaceID = $POST["SpaceID"];
	$Paid = $POST["Paid"];
	$Active = $POST["Active"];
	$EnterDate = $POST["EnterDate"];
	$ExitDate = $POST["ExitDate"];
	$Duration = $POST["Duration"];
	$ParkingRateID = $POST["ParkingRateID"];
	$SpaceTypeID = $POST["SpaceTypeID"];
	$Price = $POST["Price"];
	$token = $POST["stripeToken"];
	
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
	///Redirect to Success
	header('Location: success.php?tid='.$charge->id.'&product='.$charge->description);

?>