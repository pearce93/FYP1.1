<?php 
	include_once("scripts/php/AP_functions.php");

	$startDate = date ("Y-m-d H:i:s", strtotime($_POST["inStartDate"])); 
	$endDate = date ("Y-m-d H:i:s", strtotime($_POST["inEndDate"])); 
	$spaceType = $_POST["spaceSelected"];
	$FirstName = $_POST["firstName"];
	$LastName = $_POST["lastName"];
	$EmailAddress = $_POST["email"];
	$CarParkID = $_POST["carParkID"];
	
	$carSpaceArray = array();
	$spaceList = array();

	global $db;
	db_connect();


	//CarID needs to be set to 7 as an anonymous user. TODO: Change default ID to 0
	$CarID = 7;
	//CarParkID = the value that we have recieved from the function call.

	$CarParkName = getCarParkName($CarParkID);

	//Filtering between start and end date to find out what spaces are free on those dates.
	$sql = "SELECT * FROM `reservation` WHERE (EnterDate >= '$startDate' AND ExitDate <= '$endDate') OR (EnterDate <= '$endDate' AND ExitDate >= '$endDate')";
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
    	$sql = "SELECT * FROM `space` WHERE `CarParkID` = 8 AND SpaceTypeID = 1 LIMIT 1";
    	$result = $db->query($sql);
    	if($result->num_rows > 0){
    		while ($row = $result->fetch_assoc()) {
    			$SpaceID = (int)$row["SpaceID"];
    		}
    	}
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
			$carParkRate = $row["RateAmount"];
			$hours = $Duration / 60;
			$Price = $carParkRate * $hours;

			// echo $row['RateAmount'];
			// echo "  * $Duration";
			// echo "----------------------";

			// echo $Price;
		}
	}

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
?>


<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>

    <!-- Main Content -->
    <div class="container containerMargin confirmBackground">
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<h1>Confirm Reservation</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<h3>Car Park - <?php echo $CarParkName; ?></h3>
			</div>
			<div class="col-xs-12">
				<h3>Space ID - <?php echo $SpaceID; ?></h3>
			</div>
			<div class="col-xs-12">
				<h3>Start of Reservation - <?php echo date_format(new DateTime($startDate), 'l jS F Y - H:i:s'); ?></h3>
			</div>
			<div class="col-xs-12">
				<h3>End of Reservation - <?php echo date_format(new DateTime($endDate), 'l jS F Y - H:i:s'); ?></h3>
			</div>
			<div class="col-xs-12">
				<h3>Total Hours - <?php echo round($hours, 2); ?></h3>
				<h3>Cost Per Hour - <?php echo "£".$carParkRate; ?></h3>
				<h2>Total - <?php echo "£".round($Price, 2); ?></h2>
			</div>

			
			<div class="col-xs-12">
				<hr />
			</div>
			<div class="col-xs-12">
				<form action="./charge.php" method="post" id="payment-form">
					<div class="form-row">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $FirstName . "'"?> name="firstName" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $LastName . "'"?> name="lastName" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $EmailAddress . "'"?> name="emailAddress" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $CarID . "'"?> name="carID" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $CarParkID . "'"?> name="CarParkID" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $SpaceID . "'"?> name="SpaceID" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $Paid . "'"?> name="Paid" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $Active . "'"?> name="Active" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $EnterDate . "'"?> name="EnterDate" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $ExitDate . "'"?> name="ExitDate" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $Duration . "'"?> name="Duration" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $ParkingRateID . "'"?> name="ParkingRateID" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". $SpaceTypeID . "'"?> name="SpaceTypeID" type="hidden">
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". round($Price, 2) * 100 . "'"?> name="Price" type="hidden">

						<input class="form-control mb-3 StripeElement StripeElement--empty" type="hidden" name="lastName">
						<input class="form-control mb-3 StripeElement StripeElement--empty" type="hidden" name="email">
						<div id="card-element" class="form-control">
							<!-- A Stripe Element will be inserted here. -->
						</div>

						<!-- Used to display form errors. -->
						<div id="card-errors" role="alert"></div>
					</div>

					<button>Submit Payment</button>
				</form>
			</div>

		</div>
    </div>


    <?php getScripts() ?>

	<script type="text/javascript" src="scripts/js/DatePair/datepair.js"></script>
	<script type="text/javascript" src="scripts/js/DatePair/jquery.datepair.js"></script>
	<script>

		//Declaring Date times 
		$("#inStartDate").datetimepicker();
		$("#inEndDate").datetimepicker();

		//Making necessary changes to datetime to set min values etc.
		$("#inStartDate").on("dp.change", function (e) {
			$('#datetimepicker2').data("DateTimePicker").minDate(e.date);
		});
	</script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://js.stripe.com/v3/"></script>
	<script src="./scripts/js/charge.js"></script>

  </body>
</html>