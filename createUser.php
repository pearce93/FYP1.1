<?php include_once("scripts/php/AP_functions.php"); ?>
  <?php getHead(); ?>
     <body>
      <?php getNav(); ?>
      <div id="wrapper" class="sidebarDisplayed">
      
      <?php getSideBar(); ?>

      <!-- Main Content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">


            <div class="panel panel-default">
              <div class="panel-body">
                <form id="registrationFormBooking" class="modal-content animate bookingForm" action="registerAdminUser.php" method="post">
                  <div class="imgcontainer">
                    <span onclick="document.getElementById('registrationModal').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <h1>Register Admin User</h1>
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
        </div>

        
      </div><!-- End Main Content -->
    </div><!-- End Wrapper -->

    <?php getScripts() ?>
  </body>
</html>