<?php include_once("scripts/php/AP_functions.php"); ?>
<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>

    <!-- Main Content -->

    <form id="loginForm2" class="modal-content animate" action="registration.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('loginModal').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h1>Sign In</h1>
      <img src="img/avatar/account.png" alt="Avatar" class="avatar">
    </div>
    <div class="row">
      <div class="col-md-offset-2 col-md-8 col-xs-12">
        <div class="modalContainer">
       		<label for="userName"><b>Username</b></label>
          	<input type="text" class="form-control" name="username" required placeholder="Username"/>

          	<label for="password"><b>Email</b></label>
			<input type="email" class="form-control" name="email"pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required placeholder="Email Address"/>


       		<label for="password"><b>Password</b></label>
          	<input id="password1" type="password" class="form-control" name="password" required placeholder="Password"/>
							

       		<label for="confirmPassword"><b>Confirm Password</b>
       		</label><input id="confirmPassword1" type="password" class="form-control" name="confirmPassword" required placeholder="Confirm Password"/>

          	<input class="btn btn-success btn-block" type="submit" value="Register" />
        </div>
      </div>
    </div>
    <div class="modalContainer" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('loginModal').style.display='none'" class="btn btn-danger">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
    <div id="status"></div>
  </form>
  <br/><br/>


    <?php getScripts() ?>

    <script type="text/javascript">
			function passwordCheck() {
				var password = document.getElementById("password").value;
				var confirmPassword = document.getElementById("confirmPassword").value;
				var ok = true;
				alert("Password: " + Password + "\nconfirm: " + confirmPassword);
				if (password != confirmPassword) {
					//alert("Passwords Do not match");
					document.getElementById("password").style.borderColor = "#E34234";
					document.getElementById("confirmPassword").style.borderColor = "#E34234";
					ok = false;
					alert("Passwords do not match");
				}
				return ok;
			}
		</script>
  </body>
</html>