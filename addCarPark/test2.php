<?php
	require_once("../scripts/php/AP_functions.php");

	global $db;
	db_connect();

	$arrayList = [];
	$output = (array) null;

	$Floors = $_POST["Floors"];

	$sql = "SELECT MAX(CarParkID) FROM CarPark";
      $result = $db->query($sql);

      if ($result->num_rows > 0) {
      	while($row = $result->fetch_assoc()){
              $CarParkID = $row["MAX(CarParkID)"];
          }
    }



	//$key is the name passed from the form.
	//$value is the value the user gave in the input field.
	//Looping to get every instance of user data. 
	foreach ($_POST as $key => $value){
		echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
		array_push($arrayList, $value);
	}




	echo "<br/><br/>";
	echo "<br/><br/>";
	echo "arrayList";
	echo "<br/><br/>";
	var_dump($arrayList);
	echo "<br/><br/>";

	/*	The user has passed through the amount of floors and it's rows and columns. If there is more than 1 floor then we take the first two 
		elements of the array. [0] will be row. [1] is column.
	*/
	
	while (count($arrayList) != 1) {

		//Getting the first row and column.
		$output = array_slice($arrayList, 0, 2);


		$row = $output[0];
		$column = $output[1];

		//echo $row;
		//echo "<br/>";
		//echo $column;

		for ($f=1; $f <= $Floors; $f++) { 


			for ($i = 1; $i <= $row; $i++) { 
				echo "Row = $i - Columns = ";
				for ($j = 1; $j <= $column; $j++) {
					//getting every column inside row.

					echo "<br />";
					//Insert into space table in the database.

					echo "<br/><br/><br/>";
					echo "CarParkID - $CarParkID<br/>";
					echo "FloorNumber - $f<br/>";
					echo "SpaceRow - $i<br/>";
					echo "SpaceColumn - $j<br/>";
					echo "SpaceTypeID - 1<br/>";




					echo "<br/><br/><br/>";

					$query = "INSERT INTO space (CarParkID, FloorNumber, SpaceRow, SpaceColumn, SpaceTypeID) VALUES (?, ?, ?, ?, ?)";

					$stmt = $db->prepare($query);
					$stmt->bind_param("iiiii", $CarParkID1, $FloorNumber, $SpaceRow, $SpaceColumn, $SpaceTypeID);

					$CarParkID1 = $CarParkID;
					$FloorNumber = $f;
					$SpaceRow = $i;
					$SpaceColumn = $j;
					$SpaceTypeID = 1;

					$stmt->execute();

					echo "New records created successfully";

					$stmt->close();
				}
				echo "<br/>";
				//getting every row.
				set_time_limit(30);
			}

		}
					

		array_shift($arrayList);
		array_shift($arrayList);

		echo "<br/><br/>";
		echo "<br/><br/>";
		echo "arrayList";
		echo "<br/><br/>";
		var_dump($output);
		echo "<br/><br/>";

		echo "<br/><br/>";
		echo "<br/><br/>";
		echo "arrayList";
		echo "<br/><br/>";
		var_dump($arrayList);
		echo "<br/><br/>";


	}


	$db->close();
	echo count($arrayList);
	echo "<br/><br/><br/>";
	// var_dump($arrayList);
	// echo "<br /><br />". count($arrayList);

	// for($i = 0; $i < count($arrayList); $i++){
	// 	echo "<br /><br />";
	// 	echo $arrayList[$i];
	// }


?>

<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>
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
    <!-- Main Content -->

	<div id="result"></div>
		<br /><br /><br />
		<button onclick="setSpaceType('Available')">Available</button><br />
		<button onclick="setSpaceType('Unavailable')">Unavailable</button><br />
		<button onclick="setSpaceType('Disabled')">Disabled</button><br />
		<button onclick="setSpaceType('Family')">Family</button><br />
		<button onclick="setSpaceType('Road')">Road</button>


		<br/><br/><br/>

		<?php getCarPark(6); ?>

		<?php getScripts() ?>

		<!-- Script for creating table -->
		<script type="text/javascript">
			var floorCount = 4;
			var rowsCount = 10;
			var columnCount = 15;
			var individualCount = 1;

			for(var f = 1; f <= floorCount; f++){

				//Creating the table using the rows and columns provided by the user.
				var myTable = "<h4>Floor " + f + "</h4>";
				myTable += "<table id='carPark" + f + "' cellspacing=0 cellpadding=10 border=1>";
				myTable += "<tbody>";

				//Outputting all rows
				for(var i = 1; i <= rowsCount; i++){
					myTable += "<tr >";

					//Outputting all columns.
					for (var j = 1; j <= columnCount; j++) {
						myTable += "<td id='" + individualCount + "' class='column" + j + "'>" + j;
						individualCount++;
						myTable += "</td>";


						//Insert into database here

						/*
								$CarParkID
								$FloorNumber = f;
								$SpaceRow = i;
								$SpaceColumn = j;

								//SpaceTypeID defaulted to 1 and marked as available.
								$SpaceTypeID = 1
						*/
					}

					myTable += "</tr>";
				}
				myTable += "</tbody>";
				myTable += "</table><br/><br/>";

				$("#result").append(myTable);
			}
			//Appending myTable variable to the div with the id tag of result.
		</script>

		
		<script type="text/javascript">
			//Script for space types
			var idList = [];
			$("table > tbody > tr").on("click", "td", function() {
					
				var cellID = $(this).attr('id');
				
				if(jQuery.inArray(cellID, idList) !== -1){
					for(var i = idList.length-1; i>=0; i--){
						if(idList[i] === cellID){
							idList.splice(i, 1);
						}
					}
				}else{
					idList.push(cellID);
				}
				
				console.log(idList);
			});//End Script for space types


			function setSpaceType($spaceType){

				for(var i = 0; i < idList.length; i++){
					console.log(idList[i]);

					$("td#"+idList[i]).removeClass("Available");
					$("td#"+idList[i]).removeClass("Unavailable");
					$("td#"+idList[i]).removeClass("Disabled");
					$("td#"+idList[i]).removeClass("Family");
					$("td#"+idList[i]).removeClass("Road");

					$("td#"+idList[i]).addClass($spaceType);
				}
				idList = [];
			}

		</script>
	</body>
</html>