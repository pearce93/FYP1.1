<?php include_once("scripts/php/AP_functions.php"); ?>
<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>

    <!-- Main Content -->
    <div class="container containerMargin">
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<h2>Book Parking Space</h2>
			</div>
		</div>
		<div class="row">
			<div class="panel-group" id="accordion">	

				<!-- Login -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<label for='r1'>
								<input class="radioButton" type='radio' id='r1' name='occupation' value='Login' required /> 
								<h1 style="display: inline;">Sign In</h1>
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"></a>
							</label>
							<p>
								10% discount
							</p>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse">
						<div class="panel-body">
							<form id="loginFormBooking" class="modal-content animate" action="signIn.php" method="post">
								<div class="imgcontainer">
									<span onclick="document.getElementById('loginModal').style.display='none'" class="close" title="Close Modal">&times;</span>
									<h1>Sign In</h1>
									<img src="img/avatar/account.png" alt="Avatar" class="avatar">
								</div>
								<div class="row">
									<div class="col-md-offset-2 col-md-8 col-xs-12">
										<div class="modalContainer">
											<label for="userName"><b>Username</b></label>
											<input type="text" placeholder="Enter Username" name="userName" required>

											<label for="passwordpassword"><b>Password</b></label>
											<input type="password" placeholder="Enter Password" name="password" required>

											<input class="btn btn-primary btn-block" type="submit" value="Login" onclick="ajax_post();" />
										</div>
									</div>
								</div>

								<div class="modalContainer" style="background-color:#f1f1f1">
									<button type="button" onclick="document.getElementById('loginModal').style.display='none'" class="btn btn-danger">Cancel</button>
									<span class="psw">Forgot <a href="#">password?</a></span>
								</div>
								<div id="status"></div>
							</form>
						</div>
					</div>
				</div>

				<!-- Register -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class=panel-title>
							<label for='r2'>
								<input class="radioButton" type='radio' id='r2' name='occupation' value='Register' required /><h1 style="display: inline;">Register</h1>
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"></a>
							</label>
							<p>
								Get 10% discount and access to exclusive offers
							</p>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse">
						<div class="panel-body">
							<form id="registrationFormBooking" class="modal-content animate bookingForm" action="registration.php" method="post">
								<div class="imgcontainer">
									<span onclick="document.getElementById('registrationModal').style.display='none'" class="close" title="Close Modal">&times;</span>
									<h1>Register</h1>
									<img src="img/avatar/account.png" alt="Avatar" class="avatar">
								</div>
								<div class="row">
									<div class="col-md-offset-2 col-md-8 col-xs-12">
										<div class="modalContainer">
											<label for="userName"><b>Username</b></label>
											<input type="text" class="form-control" name="username" required placeholder="Username"/>

											<label for="passwordpassword"><b>Email</b></label>
											<input type="email" class="form-control" name="email"pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required placeholder="Email Address" />


											<label for="password"><b>Password</b></label>
											<input type="password" class="form-control" name="password" required placeholder="Password"/>


											<label for="confirmPassword"><b>Confirm Password</b>
											</label><input type="password" class="form-control" name="confirmPassword" required placeholder="Confirm Password" />

											<input class="btn btn-success btn-block" type="submit" value="Register" />
										</div>
									</div>
								</div>
								<div class="modalContainer" style="background-color:#f1f1f1">
								<button type="button" onclick="document.getElementById('registrationModal').style.display='none'" class="btn btn-danger">Cancel</button>
								<span class="psw">Forgot <a href="#">password?</a></span>
								</div>
								<div id="status"></div>
							</form>
						</div>
					</div>
				</div>

				<!-- Book Space -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class=panel-title>
							<label for='r3'>
								<input class="radioButton" type='radio' id='r3' checked='checked' name='occupation' value='book' required /> 
								<h1 style="display: inline;">Book Parking Space</h1>
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"></a>
							</label>
							<p>
								Discount will not apply
							</p>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse in">
						<div class="panel-body">
							<form id="notRegisteredBooking" class="modal-content animate bookingForm" action="randomParkingSpace.php" method="post">
								<div class="row">
									<div class="col-md-offset-2 col-md-8 col-xs-12">
										<div class="modalContainer">
											<div id="reservation">
												<form method="post" action="#">
													<div id="dateTimePair" class="row">
														<div class="col-xs-12">
															<input type="text" id="inStartDate" name="inStartDate" class="date start" placeholder="Choose Arrival Date">
														</div>
														<div class="col-xs-12">
															<input type="text" id="inStartTime" name="inStartTime" class="time start" placeholder="Choose Arrival Time">
														</div>
														<div class="col-xs-12">
															<input type="text" id="inEndDate" name="inEndDate" placeholder="Choose Departure Date" class="date end">
														</div>
														<div class="col-xs-12">
															<input type="text" id="inEndTime" name="inEndTime" placeholder="Choose Departure Time" class="time end">
														</div>	
														
													</div>
													<div class="row">
														<div class="col-xs-12"><input type="submit" name="submit" class="btn btn-success btn-block"></div>
													</div>
												</form>
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
    </div>    

    <?php getScripts() ?>

	<script type="text/javascript" src="scripts/js/DatePair/datepair.js"></script>
	<script type="text/javascript" src="scripts/js/DatePair/jquery.datepair.js"></script>
	<script>
		$('input.date').each(function() {
		    $(this).datepicker({
				minDate: 0,
		        dateFormat: 'dd/mm/yy',
		        autoclose: true
		    });
		});

		$('input.time').each(function() {
		    $(this).timepicker({
		        showDuration: true,
		        timeFormat: 'g:i a',
		        forceRoundTime: true
		    });
		});

		$('#dateTimePair').datepair({
			parseDate: function(input){
			return $(input).datepicker('getDate');
			},
			updateDate: function(input, dateObj){
			return $(input).datepicker('setDate', dateObj);
			}
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

  </body>
</html>