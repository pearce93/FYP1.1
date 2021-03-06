<?php include_once("scripts/php/AP_functions.php"); 

	$CarParkID = $_GET["cp"];

?>
<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>

<?php 

	if(!loggedIn()){
			//If logged in then output assign unauthenticated page.
	echo "<!-- Main Content -->
		<div class=\"container containerMargin\">
			<div class=\"row\">
				<div class=\"col-xs-12 col-md-8\">
					<h2>Book Parking Space</h2>
				</div>
			</div>
			<div class=\"row\">
				<div class=\"panel-group\" id=\"accordion\">	

					<!-- Login -->
					<div class=\"panel panel-default\">
						<div class=\"panel-heading\">
							<h4 class=\"panel-title\">
								<label for='r1'>
									<input class=\"radioButton\" type='radio' id='r1' name='occupation' value='Login' required /> 
									<h1 style=\"display: inline;\">Sign In</h1>
									<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne\"></a>
								</label>
								<p>
									10% discount
								</p>
							</h4>
						</div>
						<div id=\"collapseOne\" class=\"panel-collapse collapse\">
							<div class=\"panel-body\">
								<form id=\"loginFormBooking\" class=\"modal-content animate\" action=\"signIn.php\" method=\"post\">
									<div class=\"imgcontainer\">
										<span onclick=\"document.getElementById('loginModal').style.display='none'\" class=\"close\" title=\"Close Modal\">&times;</span>
										<h1>Sign In</h1>
										<img src=\"img/avatar/account.png\" alt=\"Avatar\" class=\"avatar\">
									</div>
									<div class=\"row\">
										<div class=\"col-md-offset-2 col-md-8 col-xs-12\">
											<div class=\"modalContainer\">
												<label for=\"userName\"><b>Username</b></label>
												<input type=\"text\" placeholder=\"Enter Username\" name=\"userName\" required>

												<label for=\"passwordpassword\"><b>Password</b></label>
												<input type=\"password\" placeholder=\"Enter Password\" name=\"password\" required>

												<input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Login\" onclick=\"ajax_post();\" />
											</div>
										</div>
									</div>

									<div class=\"modalContainer\" style=\"background-color:#f1f1f1\">
										<button type=\"button\" onclick=\"document.getElementById('loginModal').style.display='none'\" class=\"btn btn-danger\">Cancel</button>
										<span class=\"psw\">Forgot <a href=\"#\">password?</a></span>
									</div>
									<div id=\"status\"></div>
								</form>
							</div>
						</div>
					</div>

					<!-- Register -->
					<div class=\"panel panel-default\">
						<div class=\"panel-heading\">
							<h4 class=panel-title>
								<label for='r2'>
									<input class=\"radioButton\" type='radio' id='r2' name='occupation' value='Register' required /><h1 style=\"display: inline;\">Register</h1>
									<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseTwo\"></a>
								</label>
								<p>
									Get 10% discount and access to exclusive offers
								</p>
							</h4>
						</div>
						<div id=\"collapseTwo\" class=\"panel-collapse collapse\">
							<div class=\"panel-body\">
								<form id=\"registrationFormBooking\" class=\"modal-content animate bookingForm\" action=\"registration.php\" method=\"post\">
									<div class=\"imgcontainer\">
										<span onclick=\"document.getElementById('registrationModal').style.display='none'\" class=\"close\" title=\"Close Modal\">&times;</span>
										<h1>Register</h1>
										<img src=\"img/avatar/account.png\" alt=\"Avatar\" class=\"avatar\">
									</div>
									<div class=\"row\">
										<div class=\"col-md-offset-2 col-md-8 col-xs-12\">
											<div class=\"modalContainer\">
												<label for=\"userName\"><b>Username</b></label>
												<input type=\"text\" class=\"form-control\" name=\"username\" required placeholder=\"Username\"/>

												<label for=\"passwordpassword\"><b>Email</b></label>
												<input type=\"email\" class=\"form-control\" name=\"email\"pattern=\"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$\" required placeholder=\"Email Address\" />


												<label for=\"password\"><b>Password</b></label>
												<input type=\"password\" class=\"form-control\" name=\"password\" required placeholder=\"Password\"/>


												<label for=\"confirmPassword\"><b>Confirm Password</b>
												</label><input type=\"password\" class=\"form-control\" name=\"confirmPassword\" required placeholder=\"Confirm Password\" />

												<input class=\"btn btn-success btn-block\" type=\"submit\" value=\"Register\" />
											</div>
										</div>
									</div>
									<div class=\"modalContainer\" style=\"background-color:#f1f1f1\">
									<button type=\"button\" onclick=\"document.getElementById('registrationModal').style.display='none'\" class=\"btn btn-danger\">Cancel</button>
									<span class=\"psw\">Forgot <a href=\"#\">password?</a></span>
									</div>
									<div id=\"status\"></div>
								</form>
							</div>
						</div>
					</div>

					<!-- Book Space -->
					<div class=\"panel panel-default\">
						<div class=\"panel-heading\">
							<h4 class=panel-title>
								<label for='r3'>
									<input class=\"radioButton\" type='radio' id='r3' checked='checked' name='occupation' value='book' required /> 
									<h1 style=\"display: inline;\">Book Parking Space</h1>
									<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseThree\"></a>
								</label>
								<p>
									Discount will not apply
								</p>
							</h4>
						</div>
						<div id=\"collapseThree\" class=\"panel-collapse collapse in\">
							<div class=\"panel-body\">
								<form id=\"notRegisteredBooking\" class=\"modal-content animate bookingForm\" action=\"unauthenticatedReservation.php\" method=\"post\">
										<input type='hidden' name='carParkID' value='"; echo $CarParkID; echo "' />
									<div class=\"row\">
										<div class=\"col-md-offset-2 col-md-8 col-xs-12\">
											<div class=\"modalContainer\">
												<div id=\"reservation\">
													<div class=\"col-xs-12\">
														<h1 class=\"text-center\">Select Date's</h1>
														<p>
															<ul>
																<li>Insert the date and time that you plan on arriving.</li>
																<li>Insert the date and time that you plan on leaving.</li>
															</ul>
														<p>
													</div>
													<div id=\"dateTimePair\" class=\"row\">
														<div class=\"col-xs-1\">
															<div class=\"bookingIcons\">
																<i class=\"fa fa-user\"></i>
															</div>
														</div>
														<div class=\"col-xs-11\">
															<input type=\"text\" id=\"firstName\" name=\"firstName\" class=\"\" placeholder=\"First Name\" required=\"\">
														</div>
														<div class=\"col-xs-1\">
															<div class=\"bookingIcons\">
																<i class=\"fa fa-user\"></i>
															</div>
														</div>
														<div class=\"col-xs-11\">
															<input type=\"text\" id=\"lastName\" name=\"lastName\" class=\"\" placeholder=\"Last Name\" required=\"\">
														</div>
														<div class=\"col-xs-1\">
															<div class=\"bookingIcons\">
																<i class=\"fa fa-at\"></i>
															</div>
														</div>
														<div class=\"col-xs-11\">
															<input type=\"text\" id=\"email\" name=\"email\" class=\"\" placeholder=\"Email Address\" required=\"\">
														</div>
														<div class=\"col-xs-1\">
															<div class=\"bookingIcons\">
																<i class=\"fa fa-calendar\"></i>
															</div>
														</div>
														<div class=\"col-xs-11\">
															<input type=\"text\" id=\"inStartDate\" name=\"inStartDate\" class=\"date start\" placeholder=\"Choose Arrival Date\" required=\"\">
														</div>
														<div class=\"col-xs-1\">
															<div class=\"bookingIcons\">
																<i class=\"fa fa-calendar\"></i>
															</div>
														</div>
														<div class=\"col-xs-11\">
															<input type=\"text\" id=\"inEndDate\" name=\"inEndDate\" placeholder=\"Choose Departure Date\" class=\"date end\" required=\"\">
														</div>
														<div class=\"col-xs-1\">
															<div class=\"bookingIcons\">
																<i id=\"spaceTypeIcon\" class=\"fa fa-car\"></i>
															</div>
														</div>
														<div class=\"col-xs-11\">
															<div class=\"form-group\"> ";  
																 getSpaceTypeList(); 
															 echo "</div>
														</div>														
														
													</div>
													<div class=\"row\">
														<div class=\"col-xs-12\">
															<input type=\"submit\" name=\"submit\" class=\"btn btn-success btn-block\">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>";
	}else{
		 echo "<!-- Main Content -->
				<div class=\"container containerMargin bookingBackground\">
					<div class=\"row\">
						<div class=\"col-xs-12 col-md-8\">
							<h2>Book Parking Space</h2>
						</div>
					</div>
					
					<div class=\"row\">
						<div class=\"col-xs-12 col-md-4\">
							<div class=\"form-group\">
								<form method=\"post\" action=\"bookParkingSpace.php\">
								<input type='hidden' name='carParkID' value='"; echo $CarParkID; echo "' />
									<div id=\"dateTimePair\">
										<div class=\"row\">
											<div class=\"col-xs-1\">
												<div class=\"bookingIcons\">
													<i class=\"fa fa-car\"></i>
												</div>
											</div>															
											<div class=\"col-xs-offset-1 col-xs-10\">";
											getUserCarsList(); 
								echo "
										</div>
										</div>										

										<div class=\"row\">
											<div class=\"col-xs-1\">
												<div class=\"bookingIcons\">
													<i class=\"fa fa-calendar\"></i>
												</div>
											</div>
											<div class=\"col-xs-offset-1 col-xs-10\">
												<input type=\"text\" id=\"authenticatedInStartDate\" name=\"authenticatedInStartDate\" class=\"date start\" placeholder=\"Choose Arrival Date\" required=\"\">
											</div>
										</div>
										
										<div class=\"row\">
											<div class=\"col-xs-1\">
												<div class=\"bookingIcons\">
													<i class=\"fa fa-calendar\"></i>
												</div>
											</div>
											<div class=\"col-xs-offset-1 col-xs-10\">
												<input type=\"text\" id=\"authenticatedInEndDate\" name=\"authenticatedInEndDate\" placeholder=\"Choose Departure Date\" class=\"date end\" required=\"\">
											</div>
										</div>

									
									</div>
									<div class=\"row\">
										<div class=\"col-xs-12\">
											<input type=\"submit\" name=\"submit\" class=\"btn btn-success btn-block\">
										</div>
									</div>
								</form>								
							</div>
						</div>
					</div>
			</div>";
	}


	?>

	

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

				if($(this).hasClass("Available") || $(this).hasClass("Disabled") || $(this).hasClass("Family")){
					$(".spaceSelected").removeClass("spaceSelected");
				
					var cellID = $(this).attr('id');
					$(this).toggleClass("spaceSelected");
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
				}

				if(idList.length > 0){
					var spaceID = idList[0].split('_')[1];
					document.getElementById("spaceSelected").value = spaceID;
				}

			});

			
		</script>
  </body>
</html>