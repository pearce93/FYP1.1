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

        <!-- Favicon -->
        <link rel='shortcut icon' type='image/png' href='img/icons/favicon.ico'/>

          <link rel='stylesheet' href='css/custom/carPark.css'> 
        <!-- Bootstrap latest compiled and minified CSS -->
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'>
          <link href='css/bootstrap-datetimepicker.min.css' rel='stylesheet' media='screen'>

        <!-- Font Awesome Icons -->
          <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

        <!-- DataTable -->
          <link rel='stylesheet' href='https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css'>

        <!-- Custom CSS -->       
          <link rel='stylesheet' href='css/custom/login.css'>
          <link rel='stylesheet' href='css/custom/navigation.css'>
          <link rel='stylesheet' href='css/custom/style.css'>

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

    if(!loggedIn()){
      $userSignIn = "<li><a id=\"btnSignIn\" onclick=\"document.getElementById('loginModal').style.display='block'\" style=\"width:auto;\">Sign In</a></li>
        <li><a id=\"btnRegister\" onclick=\"document.getElementById('registrationModal').style.display='block'\" style=\"width:auto;\">Register</a></li>";
    }else{
      
      //TODO: Add an admin check here to differentiate users
      $userSignIn = "<li><a href='admin.php'>" . getUserFirstName() . "</a></li>";
     
    }


    loggedInCheck();


		echo "<nav class='navbar navbar-inverse navbar-fixed-top'>
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
                  <li><a href='carParks.php'>Car Parks</a></li>
                  <li><a href='about.php'>About</a></li>
                  <li><a href='contact.php'>Contact</a></li>

                </ul>

                <!-- Right Align User Info -->
                <ul class='nav navbar-nav navbar-right'>" . 
                  $userSignIn . 
                "</ul>
              </div><!-- End Menu Items -->
            </div>
          </nav>



          <!-- Login Modal -->
          <div class=\"container\">
            <div class=\"row\">
                <div id=\"loginModal\" class=\"modal\">  
                  <form id=\"loginForm1\" class=\"modal-content animate\" action=\"signIn.php\" method=\"post\">
                    <div class=\"imgcontainer\">
                      <span onclick=\"document.getElementById('loginModal').style.display='none'\" class=\"close\" title=\"Close Modal\">&times;</span>
                      <h1>Sign In</h1>
                      <img src=\"img/avatar/account.png\" alt=\"Avatar\" class=\"avatar\">
                    </div>
                    <div class=\"row\">
                      <div class=\"col-md-offset-2 col-md-8 col-xs-12\">
                        <div class=\"modalContainer\">
                          <label for=\"userName\"><b>Username</b></label>
                          <input id=\"userName\" type=\"text\" placeholder=\"Enter Username\" name=\"userName\" required>

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
                </div><!-- End Login Modal -->
            </div>
          </div>    


          <!-- Registration Modal -->
          <div class=\"container\">
            <div class=\"row\">

              <div id=\"registrationModal\" class=\"modal\">  
                <form id=\"registrationForm1\" class=\"modal-content animate\" action=\"registration.php\" method=\"post\">
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
                        </label><input id=\"confirmPassword\" type=\"password\" class=\"form-control\" name=\"confirmPassword\" required placeholder=\"Confirm Password\" />

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
              </div><!-- End Login Modal -->
            </div>
          </div>

          <div class=\"topMargin\"></div>
          ";
	}

	function getScripts(){
		echo "

    <footer class=\"footer\">
      <div class=\"container\">
        <span class=\"text-muted\">Place sticky footer content here.</span>
      </div>
    </footer>
    <script src='scripts/js/jquery-3.3.1.min.js'></script>
				<!-- Latest compiled and minified JavaScript -->
				<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
				<script src='scripts/js/bootstrap-datetimepicker.min.js'></script>
        <script type='text/javascript' src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>


    <script type=\"text/javascript\">
      function passwordCheck() {
        var password = document.getElementById(\"password\").value;
        var confirmPassword = document.getElementById(\"confirmPassword\").value;
        var ok = true;
        alert('Password: ' + Password + 'confirm: ' + confirmPassword);
        if (password != confirmPassword) {
          //alert(\"Passwords Do not match\");
          document.getElementById(\"password\").style.borderColor = \"#E34234\";
          document.getElementById(\"confirmPassword\").style.borderColor = \"#E34234\";
          ok = false;
          alert(\"Passwords do not match\");
        }
        return ok;
      }
    </script>";
	}

  function loggedIn(){
    if(isset($_SESSION['UserID']) && $_SESSION['UserID'] > 0){
      return true;
    }else{
      return false;
    }
  }

  function login($Username, $Password){

    global $db;
    db_connect();

    //Collecting the user inputs and assigning them.
    $Username = $_POST['userName'];
    $Password = $_POST['password'];
    $errors = '';
    //Checking that all the required feilds are set.
    if (!isset($Username) || !isset($Password))
    {
      //Error message telling the user something isn't filled in correctly.
      $errors = "<p>You have not entered all the required details.<br />
      Please go back and try again.</p>";
      exit;
    }else{
      //Stripping HTML and PHP tags from a string. Then escapes special characters in a string for use in an SQL statement.
      $Username = strip_tags(mysqli_real_escape_string($db, trim($Username)));
      $Password = strip_tags(mysqli_real_escape_string($db, trim($Password)));
      
      $query = "SELECT * FROM User WHERE Username = '" . $Username ."'";
      $tbl = $db->query($query);
      $user = $tbl->fetch_assoc();
      
      /*dumps information from database*/
      //var_dump($user);


      //Checking that the username exists in the database.
      if(mysqli_num_rows($tbl)>0){
        //If the username exists then check that the password is correct.
        //$row = mysqli_fetch_array($tbl);
        $password_hash = $user['Password'];
        if(password_verify($Password, $password_hash)){
          //If we are here it means the passwords match.        
          $sql = "SELECT UserID, Username, EmailAddress, CreationDate FROM User";
          $result = $db->query($sql);
      
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $UserID = $row["UserID"];
              $Username = $row["Username"];
              $Email = $row["EmailAddress"];
              $CreationDate = $row["CreationDate"];                         }
          }else{
            //Error message for the user as the login was unsuccessful.
            $FullName = "Unsuccessful";
            $Message = "Please go back and attempt to log in again";      
          }
        }else{
          $errors = "Password Incorrect";
        }   
      }else{
        $errors = "Please go back and attempt to log in again";
      }

      if(!empty($errors)){
        echo $errors;
      }else{
        $user_id = $user['UserID'];
        createSession($user_id);
      }
      
      $db->close();
    } 
  }

  function createSession($user_id){
    $_SESSION['UserID'] = $user_id;
    header("Location: admin.php");
  }

  function loggedInCheck(){

    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
      header("Location: success.php");
    }

    //check if post form values exist
    $Username = '';
    $Password = '';
    
    //Checking that all the required feilds are set.
    if (isset($_POST['userName']) && isset($_POST['password']))
    {
      $Username = $_POST['userName'];
      $Password = $_POST['password'];
      
      login($Username, $Password);

    }
  }

  function registerUser(){
    global $db;
    db_connect();
    //Collecting the user inputs and assigning them.
    $Username = $_POST['username'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    //Picking up on the users password and hashing it so that it is stored securely.
    $hashed_password = password_hash($Password, PASSWORD_DEFAULT);
    

    //Checking that all the required feilds are set.
    if (!isset($Username) || !isset($Email) || !isset($Password))
    {
      //Error message telling the user something isn't filled in correctly.
      echo "<p>You have not entered all the required details.<br />
      Please go back and try again.</p>";
      exit;
    }else{    
      /*  This commented code is unsafe from SQL Injection.
        It has been included into the code to show an alternative way of
        adding items into a database.
      

        //Unsafe item inclusion.
        $query = "INSERT INTO users (Firstname, Surname, Username, Password) 
        VALUES ('$Firstname', '$Surname', '$Username', '$Password')";   
        if($db->query($query) === TRUE){
          echo "Info inserted";
        }else{
          echo "Error";
        }   
        $db->close();
      */
      
      $sql = "SELECT UserID, Username, EmailAddress, CreationDate FROM User WHERE Username = '$Username'";
      $result = $db->query($sql);
      
      //Checking that the number of results returned by the sql is greater than 0. If it is then can't create user.
      if($result->num_rows > 0){
        //Error message for the user as the username they've chosen already exists.
        $Header = "UNSUCCESSFUL";
        $SubHead = "Please choose a different Username";
        $Message = "<p>Click <a href='register.php'>here</a> to go back and try again</p>";
      }else{
        //Creating a new user in the database.
        $query = "INSERT INTO user (Username, EmailAddress, Password) VALUES (?, ?, ?)";
      
        $stmt = $db->prepare($query);
        $stmt->bind_param('sss', $Username, $Email, $hashed_password);
        if(false === $stmt){
          echo "Prepare Failed";
          exit;
        }   
        $stmt->execute();
        
        //Checking that the new user has been inputted.
        if ($stmt->affected_rows > 0)
        {
          $query = "SELECT * FROM User WHERE Username = '" . $Username ."'";
          $tbl = $db->query($query);
          $user = $tbl->fetch_assoc();
          $_SESSION["UserID"] = $user["UserID"];
          /*dumps information from database*/
          //var_dump($user);
        }else{
          die();
        }
        //Checking that the username exists in the database.
        if(mysqli_num_rows($tbl)>0){
          $user_id = $user['UserID'];
          createSession($user_id);
        } else {
          echo "die";
          echo "die";
          die();
          header('Location: register.php');
        }
        
      }

      
      
      //Closing the Database connection.
      $db->close();
    }
  }

  function getUserFirstName(){
    global $db;
    db_connect();
    $user_id = $_SESSION['UserID'];
    $sql = "SELECT * FROM user WHERE UserID = $user_id";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        //echo "<div class='col-lg-12'><label>License Plate</label>" . $row["CarLicensePlate"]. "<br/>Car Model - " . $row["CarType"] ."</>";
        if(empty($row["FirstName"])){

          $Username = $row["Username"];
          return $row["Username"];
        
          if(empty($Username)){
            return $row["Username"];
          }else{            
            echo "<p class='missingInfo'>*Please provide your first name*</p>";
          }
        }else{
           return $row["FirstName"];
        }
      }
    }
    $db->close();
  }


  function getAllCarParks(){
    global $db;
    db_connect();
    $sql = "SELECT * FROM carPark";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        //echo "<div class='col-lg-12'><label>License Plate</label>" . $row["CarLicensePlate"]. "<br/>Car Model - " . $row["CarType"] ."</>";

        echo "<div class='col-xs-12 col-md-4'>
        <div class='carParkThumb'>
          <img class='img-thumbnail' src='img/carParks/" . $row["CarParkCode"] . ".jpg' alt='An Image of a car park/car park building' />
          <p class='carParktitle'>" . $row["CarParkName"] . "</p>
          <div class='carParkoverlay'></div>
          <div class='carParkbutton'><a class='btn btn-primary' href='" . $row["CarParkCode"]. ".php'>BOOK</a></div>
        </div>
      </div>";

        $row["CarParkName"];

      }
    }
    $db->close();
  }

  function getCarPark($CarParkID){

    
        global $db;
        db_connect();
        if(isset($_SESSION['UserID'])){         
          $user_id = $_SESSION['UserID'];

          //Getting Each floor depending on the carParkID
          $sql = "SELECT DISTINCT FloorNumber FROM space WHERE CarParkID = $CarParkID";
          $result = $db->query($sql); 
          if ($result->num_rows > 0) {
            // output data of each row
            echo "
                <ul class='nav nav-tabs topMargin'>";

              //Looping to find the amount floors in the carPark
            while($row = $result->fetch_assoc()) {
              echo "<li><a data-toggle='tab' href='#floor".$row["FloorNumber"]."'>Floor ".$row["FloorNumber"]."</a></li>";
            };

            echo "</ul>";

            //Turning the amount of floors into different tabs with different content for each floor.
            $sql = "SELECT DISTINCT FloorNumber FROM space WHERE CarParkID = $CarParkID";
            $result = $db->query($sql); 
            if($result->num_rows > 0) {

              echo "<div class='tab-content'>

                <div id='floor" . $row["FloorNumber"] . "' class='tab-pane active in home'>
                  <img class='img-responsive' src='img/carparks/CastleCourt.jpg' alt='Castle Court Shopping Center Image' />
                </div>";

              while($row = $result->fetch_assoc()) {
              
                echo "
                    <div id='floor" . $row["FloorNumber"] . "' class='tab-pane fade'>

                      <table id='carPark" . $row["FloorNumber"] . "' class='table'>
                        <thead>";

                        $sqlTH = "SELECT DISTINCT SpaceColumn FROM space WHERE FloorNumber = " . $row["FloorNumber"] . " AND CarParkID = $CarParkID";
                        $resultTH = $db->query($sqlTH);
                        if($resultTH->num_rows > 0){
                          while($rowTH = $resultTH->fetch_assoc()){
                            if(empty($rowTH["SpaceColumn"])){
                              echo "Error";
                            }else{
                              echo "<th></th>";
                            }
                          }
                        }else{
                          echo "here";
                        }                 
                        echo "</thead>
                        <tbody>";
                          

                          //TODO: loop TD's so we can pivot the parking spaces.

                          $sql1 = "SELECT DISTINCT SpaceRow FROM space WHERE CarParkID = $CarParkID AND FloorNumber = " . $row["FloorNumber"] ."";
                          
                          $result1 = $db->query($sql1); 
                          if($result1->num_rows > 0) {

                            while($row1 = $result1->fetch_assoc()){
                              if(empty($row1["SpaceRow"])){

                                echo "<td>hello</td>";
                              }else{


                                echo "<tr id='row". $row1["SpaceRow"] ."'>";

                                  $sql2 = "SELECT DISTINCT `SpaceID`, `CarParkID`, `FloorNumber`, `SpaceRow`, `SpaceColumn`,`space`.SpaceTypeID, `spacetype`.`SpaceType` FROM `space` inner JOIN `spacetype` ON `space`.`SpaceTypeID` = `spacetype`.`SpaceTypeID` WHERE CarParkID = $CarParkID AND FloorNumber = " . $row["FloorNumber"] ." AND `SpaceRow` = ". $row1["SpaceRow"] . " ORDER BY SpaceID";
                                  //var_dump($sql2);
                                  $result2 = $db->query($sql2); 
                                  if($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                      if(empty($row2["SpaceColumn"])){

                                        echo "<td>hello</td>";
                                      }else{
                                        //todo borders in the grid and icons for cars
                                        echo "<td id='".$row2["SpaceID"]."' class='column".$row2["SpaceColumn"]. " " .$row2["SpaceType"]."'>&nbsp;</td>";
                                      }
                                    }
                                  }else{
                                    echo "error";
                                  }
                                echo "</tr>";

                              }
                            }


                          }else{
                            echo "<td>world</td>";
                          }
                          echo "</tr>
                        </tbody>
                      </table>
                    </div>";
  
              };
              echo "</div>";
            }

          }else{
            echo "Error";
          }
          $db->close();
        }else{
          echo "Log in";
        }
  }

  function getFloors($CarParkID){
    global $db;
    db_connect();
    $user_id = $_SESSION['UserID'];

    //Getting Each floor depending on the carParkID
    $sql = "SELECT DISTINCT FloorNumber FROM space WHERE CarParkID = $CarParkID";
    $result = $db->query($sql); 
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {        
        if(empty(!$row["FloorNumber"])){
          echo "
          $(document).ready(function() {
            $('#carPark". $row["FloorNumber"] ."').DataTable({
              'searching': false,
              'paging': false,
              'info': false,
              'ordering': false
            });
          });";
        }
      };
    }
  }
?>