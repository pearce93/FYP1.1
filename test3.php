<?php include_once("scripts/php/AP_functions.php"); ?>



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

?>

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
	<div class="container">

		<div class="row">
			<div class="col-xs-12">
				<h1>Draw out car park</h1>
				<?php getNewCarPark(); ?>				
			</div>
		</div>
	</div>

	<div class="container topMargin">
		<div class="row">
			<div class="col-xs-12">
				<form method="POST" id="Available">
					<input type="hidden" value="1">
					<input class="btn btn-primary" type="submit" value="Available">
					<button onclick="setSpaceType('Available')">Available</button>
				</form>

				<form method="POST" id="Unavailable">
					<input type="hidden" value="2">
					<input class="btn btn-primary" type="submit" value="Unavailable">
					<button onclick="setSpaceType('Unavailable')">Unavailable</button>
				</form>

				<form method="POST" id="Disabled">
					<input type="hidden" value="3">
					<input class="btn btn-primary" type="submit" value="Disabled">
					<button onclick="setSpaceType('Disabled')">Disabled</button>
				</form>

				<form method="POST" id="Family">
					<input type="hidden" value="4">
					<input class="btn btn-primary" type="submit" value="Family">
					<button onclick="setSpaceType('Family')">Family</button>
				</form>

				<form method="POST" id="Road">
					<input type="hidden" value="5">
					<input class="btn btn-primary" type="submit" value="Road">
					<button onclick="setSpaceType('Road')">Road</button>
				</form>
			</div>
		</div>
	</div>


	<?php getScripts(); ?>
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
				$(this).toggleClass("spaceSelected");
				cellID = cellID.split("_")[1];
				console.log(cellID);

				if(jQuery.inArray(cellID, idList) !== -1){
					for(var i = idList.length-1; i>=0; i--){
						if(idList[i] === cellID){
							idList.splice(i, 1);
							console.log("Hello");
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
					$("td#Space_"+idList[i]).removeClass("spaceSelected");
					$("td#Space_"+idList[i]).removeClass("Available");
					$("td#Space_"+idList[i]).removeClass("Unavailable");
					$("td#Space_"+idList[i]).removeClass("Disabled");
					$("td#Space_"+idList[i]).removeClass("Family");
					$("td#Space_"+idList[i]).removeClass("Road");
					$("td#Space_"+idList[i]).addClass($spaceType);


					/**************
					PICK UP FROM HERE
					POST FORM ON SUBMIT
					**************/


				}
				idList = [];
			}

			$(document).ready(function(){
				$("Available").submit(function(){
					alert("Submitted");
				});
				
				$("Unavailable").submit(function(){
					alert("Submitted");
				});
				
				$("Disabled").submit(function(){
					alert("Submitted");
				});
				
				$("Family").submit(function(){
					alert("Submitted");
				});
				
				$("Road").submit(function(){
					alert("Submitted");
				});
			});
			
		</script>
</body>
</html>