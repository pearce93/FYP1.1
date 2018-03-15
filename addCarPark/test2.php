<?php

	$arrayList = [];
	$rowList = [];
	$columnList = [];
	foreach ($_POST as $key => $value){
		echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
		array_push($arrayList, $value);
	}

	$counter = 1;


	/*PICK UP FROM HERE*/
	while ($counter <= count($arrayList)) {
		echo "$counter";
		$counter++;
	}




	for ($i=1; $i <= count($arrayList); $i++) {
		echo "$i";
		// echo $arrayList[$i]."<br/>";

		//if $i multiple of 2
		if((count($arrayList) % 2) == 1){
			echo "Row<br/>";
			array_push($rowList, $value);
			array_shift($arrayList);
		}else{
			array_push($columnList, $value);
			echo "Column<br/>";
			array_shift($arrayList);
		}
		//else




		
	}
		echo "Row - ";
		var_dump($rowList);
		echo "<br/><br/>";

		echo "Column - ";
		var_dump($columnList);
		echo "<br/><br/>";

	echo count($arrayList);
	echo "<br/><br/><br/>";
	die();
	// var_dump($arrayList);
	// echo "<br /><br />". count($arrayList);

	// for($i = 0; $i < count($arrayList); $i++){
	// 	echo "<br /><br />";
	// 	echo $arrayList[$i];
	// }


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<div id="result"></div>
	<br /><br /><br />
	<button onclick="setSpaceType('Available')">Available</button><br />
	<button onclick="setSpaceType('Unavailable')">Unavailable</button><br />
	<button onclick="setSpaceType('Disabled')">Disabled</button><br />
	<button onclick="setSpaceType('Family')">Family</button><br />
	<button onclick="setSpaceType('Road')">Road</button>


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