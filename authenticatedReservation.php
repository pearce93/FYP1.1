<?php 
	include_once("scripts/php/AP_functions.php");

	$startDate = date ("Y-m-d H:i:s", strtotime($_POST["authenticatedInStartDate"])); 
	$endDate = date ("Y-m-d H:i:s", strtotime($_POST["authenticatedInEndDate"])); 
	$SpaceID = $_POST["spaceSelected"];
	$CarSelected = $_POST["carSelected"];
	$FirstName = getUserFirstName();
	$LastName = getUserLastName();
	$EmailAddress = getUserEmailAddress();

	$carSpaceArray = array();
	$spaceList = array();

	global $db;
	db_connect();


	//CarID needs to be set to 7 as an anonymous user. TODO: Change default ID to 0
	$CarID = 0;

	//Assigning first available space to $SpaceID
		//Filtering between start and end date to find out what spaces are free on those dates.
		$sql = "SELECT * FROM car where userid = " . $_SESSION['UserID'] . " AND CarLicensePlate = '$CarSelected'";
		$result = $db->query($sql);		
		while($row = $result->fetch_assoc()){
			$CarID = $row["CarID"];
		}

	//CarParkID = the value that we have recieved from the function call.
	$CarParkID = 1;

	//Filtering between start and end date to find out what spaces are free on those dates.
	$sql = "SELECT * FROM `reservation` WHERE (EnterDate >= '$startDate' AND ExitDate <= '$endDate') OR (EnterDate <= '$endDate' AND ExitDate >= '$endDate')";
    $result = $db->query($sql);

    //If there are spaces already booked between these dates then ensure the user does not book/reserve that space.
    if ($result->num_rows > 0) {
      //TODO: FILTER BY RESERVATION DATE
    }else{
    	//User can be given first available space with no check needed because the dates have already been compared and everything was fine.
    	//TODO: FILTER BY RESERVATION DATE
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

	$sql = "SELECT * FROM ParkingRates WHERE RateTypeID = $ParkingRateID AND CarParkID = $CarParkID";
	$result = $db->query($sql);

	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$carParkRate = $row["RateAmount"];
			$hours = $Duration / 60;
			$Price = $carParkRate * $hours;
			$Percentage = ($Price / 100) * 10;
			$Total = $Price - $Percentage;

			// echo $row['RateAmount'];echo "<br/>";
			// echo "  * $Duration";echo "<br/>";
			// echo "----------------------";echo "<br/>";
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
				<h3>Start of Reservation - <?php echo date_format(new DateTime($startDate), 'l jS F Y - H:i:s'); ?></h3>
			</div>
			<div class="col-xs-12">
				<h3>End of Reservation - <?php echo date_format(new DateTime($endDate), 'l jS F Y - H:i:s'); ?></h3>
			</div>
			<div class="col-xs-12">
				<h3>Total Hours - <?php echo round($hours, 2); ?></h3>
				<h3>Cost Per Hour - <?php echo "£".round($carParkRate,2); ?></h3>
				<h2>Total - <?php echo "£".round($Price, 2); ?></h2>
			</div>

			
			<div class="col-xs-12">
				<hr />
			</div>
			<div class="col-xs-12">
				<form action="./authenticatedCharge.php" method="post" id="payment-form">
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
						<input class="form-control mb-3 StripeElement StripeElement--empty" <?php echo "value='". round($Total, 2) * 100 . "'"?> name="Price" type="hidden">

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