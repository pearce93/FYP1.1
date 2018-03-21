<?php include_once("scripts/php/AP_functions.php");

	$startDate = date ("Y-m-d H:i:s", strtotime($_POST["authenticatedInStartDate"])); 
	$endDate = date ("Y-m-d H:i:s", strtotime($_POST["authenticatedInEndDate"])); 
	$CarSelected = $_POST["carSelected"];
	$CarParkID = $_POST["carParkID"];

?>
<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>

    <?php getScripts() ?>

	<!-- Main Content -->
				<div class="container containerMargin bookingBackground">
					<div class="row">
						<div class="col-xs-12">
							<h2>Book Parking Space</h2>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-12 col-md-9">
							<?php getCarPark($CarParkID, $startDate, $endDate); ?> 
						</div>
						<div class="col-xs-12 col-md-3">
							<form method="post" action="authenticatedReservation.php">
										<input type="hidden" id="carParkID" name="CarParkID" required="" value="<?php echo $CarParkID ?>" />
										<input type="hidden" id="spaceSelected" name="spaceSelected" required="" />
										<input type="hidden" id="carSelected" name="carSelected" required="" value="<?php echo $CarSelected ?>" />
										<input type="hidden" id="authenticatedInStartDate" name="authenticatedInStartDate" required="" value="<?php echo $startDate ?>" />
										<input type="hidden" id="authenticatedInEndDate" name="authenticatedInEndDate" required=""  value="<?php echo $endDate ?>" />
										<div class="row">
											<div class="col-xs-12">
												<input type="submit" name="submit" class="btn btn-success btn-block hide" id="submitBooking">
											</div>
										</div>
									</form>
						</div>						
					</div>
			</div>


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

		//Declaring Date times 
		$("#authenticatedInStartDate").datetimepicker();
		$("#authenticatedInEndDate").datetimepicker();

		//Making necessary changes to datetime to set min values etc.
		$("#authenticatedInStartDate").on("dp.change", function (e) {
			$('#datetimepicker2').data("DateTimePicker").minDate(e.date);
		});
	</script>


    <!-- Accordion js -->
    <script type="text/javascript">    	

    	$('#r1').on('click', function(){
			$(this).parent().find('a').trigger('click');
			$('html, body').animate({
				scrollTop: $("#collapseOne").offset().top
			}, 800);
		});

		$('#r2').on('click', function(){
			$(this).parent().find('a').trigger('click');
			$('html, body').animate({
				scrollTop: $("#collapseTwo").offset().top
			}, 800);
		});

		$('#r3').on('click', function(){
			$(this).parent().find('a').trigger('click');
		});
    </script><!-- End Accordion js -->


    <!-- Alert on DropDown Change -->
    <script type="text/javascript">
	$('#spaceSelected').change(function(){
    	var parkingTypeID = $(this).val();
    	switch(parkingTypeID){
    		//Available
    		case "1":
    			$("#spaceTypeIcon").removeClass("fa-car");
    			$("#spaceTypeIcon").removeClass("fa-wheelchair");
    			$("#spaceTypeIcon").removeClass("fa-users");

    			$("#spaceTypeIcon").addClass("fa-car");
    		break;

    		//Disabled
    		case "3":
				$("#spaceTypeIcon").removeClass("fa-car");
    			$("#spaceTypeIcon").removeClass("fa-wheelchair");
    			$("#spaceTypeIcon").removeClass("fa-users");

    			$("#spaceTypeIcon").addClass("fa-wheelchair");
    		break;

    		//Family
    		case "4":
				$("#spaceTypeIcon").removeClass("fa-car");
    			$("#spaceTypeIcon").removeClass("fa-wheelchair");
    			$("#spaceTypeIcon").removeClass("fa-users");

    			$("#spaceTypeIcon").addClass("fa-users");
    		break;
    	}
    });

    </script>

    <script type="text/javascript">
			var idList = [];
			<?php getFloors('2'); ?>
			$("table > tbody > tr").on("click", "td", function() {

				if($(this).hasClass("spaceSelected")){
					$(".spaceSelected").removeClass("spaceSelected");
				}
				//Element has any of these classes then the space can be selected
				if($(this).hasClass("Available") || $(this).hasClass("Disabled") || $(this).hasClass("Family")){

					//Removing class if the user has selected a space different from their first selection.
					$(".spaceSelected").removeClass("spaceSelected");
				
					var cellID = $(this).attr('id');
					if(jQuery.inArray(cellID, idList) !== -1){
						for(var i = idList.length-1; i>=0; i--){
							if(idList[i] === cellID){
								idList.splice(i, 1);
							}
						}
					}else{
						idList.shift();
						idList.push(cellID);
					}
					
					console.log(idList);
					if(idList.length > 0){
						$(this).addClass("spaceSelected");
						//Show submit button
						$('#submitBooking').removeClass('hide');
					}else{
						$('#submitBooking').addClass('hide');
					}
				}

				if(idList.length > 0){
					var spaceID = idList[0].split('_')[1];
					document.getElementById("spaceSelected").value = spaceID;
				}

			});

			
		</script>
  </body>
</html>