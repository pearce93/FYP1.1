<?php
	//Collecting the user inputs and assigning them.
	include_once("AP_Functions.php");


	if(empty(trim($_POST['carLicensePlate'])) || empty(trim($_POST['carModel'])))
	{
	    // Its empty so throw a validation error
	    header('Location: ../../account.php'); 
	}
	else
	{
	    // Input has some text and is not empty.. process accordingly.. 

		$licensePlate = $_POST['carLicensePlate'];
		$carModel = $_POST['carModel'];

		//Checking that all the required feilds are set.
		if (!isset($licensePlate) || !isset($carModel) || !(isset($_SESSION['UserID'])))
		{
			//Error message telling the user something isn't filled in correctly.
			echo "<p>You have not entered all the required details.<br />
			Please go back and try again.</p>

			<p>licensePlate: " . $licensePlate . "</p>
			<p>carModel: " . $carModel . "</p>
			<p>UserID" . $_SESSION['UserID'] . "</p>"
			;
			exit;
		}else{		
			global $db;
			db_connect();
			$user_id = $_SESSION['UserID'];

			$query = "INSERT INTO car (UserID, CarLicensePlate, CarType) VALUES (?, ?, ?)";

			$stmt = $db->prepare($query);
			$stmt->bind_param('iss', $user_id, $licensePlate, $carModel);
			if(false === $stmt){
				echo "Prepare Failed";
				exit;
			}   
			$stmt->execute();
			
			//Closing the Database connection.
			$db->close();
			
			header("Location: ../../account.php");
		}
	}
?>