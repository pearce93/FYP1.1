<?php
	//Collecting the user inputs and assigning them.
	include_once("AP_Functions.php");
 

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$address = $_POST['address'];
	$contactNumber = $_POST['contactNumber'];

	//Checking that all the required feilds are set.
	if (!(isset($_SESSION['UserID'])))
	{
		//Error message telling the user something isn't filled in correctly.
		header('Location: ../../index.php');
		exit;

	}else{		
		global $db;
		db_connect();
		$user_id = $_SESSION['UserID'];
		$query = "SELECT * FROM User WHERE UserID = " . $user_id;

		$result = $db->query($query);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {

				$dbFirstName = $row["FirstName"];
				$dbLastName = $row["LastName"];
				$dbAddress = $row["Address"];
				$dbContactNumber = $row["ContactNumber"];

				if($firstName != ''){
					$updateFirstName = $firstName;
				}else{
					$updateFirstName = $dbFirstName;
				}

				if($lastName != ''){
					$updateLastName = $lastName;
				}else{
					$updateLastName = $dbLastName;
				}

				if($address != ''){
					$updateAddress = $address;
				}else{
					$updateAddress = $dbAddress;
				}

				if($contactNumber != ''){
					$updateContactNumber = $contactNumber;
				}else{
					$updateContactNumber = $dbContactNumber;
				}

				echo "<p>updateFirstName: " . $updateFirstName;
				echo "</p><p>updateLastName: " . $updateLastName;
				echo "</p><p>updateAddress: " . $updateAddress;
				echo "</p><p>updateContactNumber: " . $updateContactNumber;
				echo "</p>";
				$query = "SELECT * FROM user WHERE UserID = " . $user_id;

				$result = $db->query($query);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {

						
						$sql = "UPDATE user SET FirstName = '" . $updateFirstName . "', LastName = '" . $updateLastName . "', Address = '" . $updateAddress . "', ContactNumber = '" . $updateContactNumber . "' WHERE UserID = " . $user_id;#

						if ($db->query($sql) === TRUE) {
							//echo "Record updated successfully";
						} else {
							echo "Error updating record: " . $db->error;
						}
						/*
							This is where the update SQL goes.
							Update FirstName, LastName, Address, ContactNumber

						

						*/

						
					}
				}

				header('Location: ../../account.php');
				

			}
		}
		//$query = "UPDATE user SET FirstName = " . $firstName . ", LastName = " . $firstName . ", Address = " . $address . ", ContactNumber = " . $contactNumber . "WHERE UserID = " . $user_id;

		// //Creating a new user in the database.
		// $query = "INSERT INTO car (UserID, CarLicensePlate, CarType) VALUES (?, ?, ?)";
	
		// $stmt = $db->prepare($query);
		// $stmt->bind_param('iss', $user_id, $licensePlate, $carModel);
		// if(false === $stmt){
		// 	echo "Prepare Failed";
		// 	exit;
		// }		
		// $stmt->execute();
		
		// //Checking that the new user has been inputted.
		// if ($stmt->affected_rows > 0)
		// {
		//  header('Location: ../../account.php');
		// } else {
		// 	header('Location: ../../account.php');
		// }
		
		//Closing the Database connection.
		$db->close();
		
	}
	
?>