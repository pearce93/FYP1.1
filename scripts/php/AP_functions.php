<?php 
	session_start();

	function db_connect(){
		global $db;
		$db = new mysqli('localhost', 'root', '', 'AcceleratedParking');
		//Returns an error code value. Zero if no error occurred.
		if (mysqli_connect_errno()) 
		{
			// echo "<p>Could not connect to database</p>";
		} else {
			// echo "<p>Connected to AcceleratedParking</p>";	
		}
	}

	function getHead(){
		echo "<!DOCTYPE html>
        <html>
        <head>
        <title>Bootstrap 101 Template</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>


        <link rel='stylesheet' href='css/custom/navigation.css'>
        <link rel='stylesheet' href='css/custom/login.css'>
        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>

        <!-- Optional theme -->
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'>

        <link href='css/bootstrap-datetimepicker.min.css' rel='stylesheet' media='screen'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        </head>";
	}

	function getNav(){
    global $Username;   

    global $db;
    db_connect();
    if(isset($_SESSION['UserID'])){
      $user_id = $_SESSION['UserID'];
      $adminCheck = "";
      $sql = "SELECT UserTypeID FROM User WHERE UserID = $user_id AND UserTypeID = 1";
      $result = $db->query($sql);

      if ($result->num_rows > 0) {
        $adminCheck = "<li><a href='admin.php'>Admin</a></li>";
      }
    }


		echo "<nav class='navbar navbar-inverse'>
            <div class='container-fluid'>

              <!-- Logo -->
              <div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#mainNavBar'>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                </button>
                <a href='index.php' class='navbar-brand'>AP</a>  
              </div>

              <!-- Menu Items -->
              <div class='collapse navbar-collapse' id='mainNavBar'>
                <ul class='nav navbar-nav'>
                  <li class='active'><a href='index.php'>Home</a></li>

                  <!-- DropDown Menu -->
                  <li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Car Parks <span class='fa fa-caret-down'></span></a>
                    <ul class='dropdown-menu'>
                      <li><a href='sseArena.php'>SSE Arena</a></li>
                      <li><a href='castleCourt.php'>Castle Court</a></li>
                      <li><a href='handyPark.php'>Handy Park</a></li>
                    </ul>
                  </li>


                  <li><a href='about.php'>About</a></li>
                  <li><a href='contact.php'>Contact</a></li>

                </ul>

                <!-- Right Align User Info -->
                <ul class='nav navbar-nav navbar-right'>
                  <li><a id=\"btnSignIn\" onclick=\"document.getElementById('loginModal').style.display='block'\" style=\"width:auto;\">Sign In</a></li>
                  <li><a id=\"btnSignIn\" onclick=\"document.getElementById('registrationModal').style.display='block'\" style=\"width:auto;\">Register</a></li>
                </ul>
              </div><!-- End Menu Items -->
            </div>
          </nav>



          <!-- Login Modal -->
          <div class=\"container\">
            <div class=\"row\">
                <div id=\"loginModal\" class=\"modal\">  
                  <form class=\"modal-content animate\" action=\"/action_page.php\">
                    <div class=\"imgcontainer\">
                      <span onclick=\"document.getElementById('loginModal').style.display='none'\" class=\"close\" title=\"Close Modal\">&times;</span>
                      <h1>Sign In</h1>
                      <img src=\"img/avatar/account.png\" alt=\"Avatar\" class=\"avatar\">
                    </div>
                    <div class=\"row\">
                      <div class=\"col-md-offset-2 col-md-8 col-xs-12\">
                        <div class=\"modalContainer\">
                          <label for=\"uname\"><b>Username</b></label>
                          <input type=\"text\" placeholder=\"Enter Username\" name=\"uname\" required>

                          <label for=\"psw\"><b>Password</b></label>
                          <input type=\"password\" placeholder=\"Enter Password\" name=\"psw\" required>
                            
                          <button class=\"btn btn-primary btn-block\" type=\"submit\">Login</button>
                          <label>
                            <input type=\"checkbox\" checked=\"checked\" name=\"remember\"> Remember me
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class=\"modalContainer\" style=\"background-color:#f1f1f1\">
                      <button type=\"button\" onclick=\"document.getElementById('loginModal').style.display='none'\" class=\"btn btn-danger\">Cancel</button>
                      <span class=\"psw\">Forgot <a href=\"#\">password?</a></span>
                    </div>
                  </form>
                </div><!-- End Login Modal -->
            </div>
          </div>    


          <!-- Registration Modal -->
          <div class=\"container\">
            <div class=\"row\">

              <div id=\"registrationModal\" class=\"modal\">  
                <form class=\"modal-content animate\" action=\"/action_page.php\">
                  <div class=\"imgcontainer\">
                    <span onclick=\"document.getElementById('registrationModal').style.display='none'\" class=\"close\" title=\"Close Modal\">&times;</span>
                    <h1>Register</h1>
                    <img src=\"img/avatar/avatar.png\" alt=\"Avatar\" class=\"avatar\">
                  </div>

                  <div class=\"row\">
                    <div class=\"col-md-offset-2 col-md-8 col-xs-12\">
                      <div class=\"modalContainer\">
                        <label for=\"uname\"><b>Username</b></label>
                        <input type=\"text\" placeholder=\"Enter Username\" name=\"uname\" required>

                        <label for=\"psw\"><b>Password</b></label>
                        <input type=\"password\" placeholder=\"Enter Password\" name=\"psw\" required>
                          
                        <button class=\"btn btn-primary btn-block\" type=\"submit\">Register</button>
                        <label>
                          <input type=\"checkbox\" checked=\"checked\" name=\"remember\"> Remember me
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class=\"modalContainer\" style=\"background-color:#f1f1f1\">
                    <button type=\"button\" onclick=\"document.getElementById('registrationModal').style.display='none'\" class=\"btn btn-danger\">Cancel</button>
                    <span class=\"psw\">Forgot <a href=\"#\">password?</a></span>
                  </div>
                </form>
              </div><!-- End Login Modal -->
            </div>
          </div>";
	}

	function getScripts(){
		echo "<script src='scripts/js/jquery-3.3.1.min.js'></script>
				<!-- Latest compiled and minified JavaScript -->
				<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
				<script src='scripts/js/bootstrap-datetimepicker.min.js'></script>";
	}

  function loggedIn(){
    if(isset($_SESSION['UserID']) && $_SESSION['UserID'] > 0){
      return true;
    }else{
      return false;
    }
  }

?>