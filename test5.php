<?php 
	include_once("scripts/php/AP_functions.php");
	
	global $db;
	db_connect();

	$spaceID = $_POST["spaceID"];
	$spaceType = $_POST["spaceType"];
	$spaceTypeID = 1;

	switch ($spaceType) {
		case 'Available':
			$spaceTypeID = 1;
			break;

		case 'Unavailable':
			$spaceTypeID = 2;
			break;

		case 'Disabled':
			$spaceTypeID = 3;
			break;

		case 'Family':
			$spaceTypeID = 4;
			break;

		case 'Road':
			$spaceTypeID = 5;
			break;
		
		default:
			# code...
			break;
	}

	$sql = "UPDATE space SET SpaceTypeID = $spaceTypeID WHERE spaceID = $spaceID";
	$result = $db->query($sql);
?>