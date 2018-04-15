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
            <div class="col-lg-12">
              <a href="#" class="btn btn-primary" id="menu-toggle"><i id="menu-toggle-button" class="fa fa-arrow-left"></i></a>
              <h1>Create New Car Park</h1>
				<?php 
					require_once("scripts/php/AP_functions.php");

					global $db;
					db_connect();
					
					$cpName = $_POST["cpName"];
					$cpCode = $_POST["cpCode"];
					$cpAddress = $_POST["cpAddress"];
					$cpPostCode = $_POST["cpPostCode"];
					$cpCity = $_POST["cpCity"];
					$cpFloors = $_POST["cpFloors"];
					$cpDetails = $_POST["cpDetails"];

					// echo "cpName - ";var_dump($cpName);
					// echo "<br/><br/>";
					// echo "cpCode - ";var_dump($cpCode);
					// echo "<br/><br/>";
					// echo "cpAddress - ";var_dump($cpAddress);
					// echo "<br/><br/>";
					// echo "cpPostCode - ";var_dump($cpPostCode);
					// echo "<br/><br/>";
					// echo "cpCity - ";var_dump($cpCity);
					// echo "<br/><br/>";
					// echo "cpFloors - ";var_dump($cpFloors);
					// echo "<br/><br/>";
					// echo "cpDetails - ";var_dump($cpDetails);

					$query = "INSERT INTO carpark (`CarParkName`, `CarParkCode`, `Address`, `PostCode`, `City`, `Details`, `Floors`) VALUES (?, ?, ?, ?, ?, ?, ?)";

					$stmt = $db->prepare($query);
					$stmt->bind_param("sssssss", $cpName, $cpCode, $cpAddress, $cpPostCode, $cpCity, $cpDetails, $cpFloors);

					$cpName = $_POST["cpName"];
					$cpCode = $_POST["cpCode"];
					$cpAddress = $_POST["cpAddress"];
					$cpPostCode = $_POST["cpPostCode"];
					$cpCity = $_POST["cpCity"];
					$cpFloors = $_POST["cpFloors"];
					$cpDetails = $_POST["cpDetails"];

					$stmt->execute();

					// echo "New records created successfully";

					$stmt->close();
					$db->close();

					echo "<form action='test2.php' method='post'>
					";
					for ($i= 1; $i <= $cpFloors; $i++) { 
						echo "<div class='row'>";
							echo "<div class='col-xs-12'>";
								echo "<h3>Floor $i</h3>";
							echo "</div>";
						echo "</div>";


						echo "<div class='row'>";
							echo "<div class='col-lg-6 col-xs-12'>";
								echo "<input name='rows_$i' type='number' placeholder='Amount of Rows' style='width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;' required/> ";
							echo "</div>";
							echo "<div class='col-lg-6 col-xs-12'>";
								echo "<input name='columns_$i' type='number' placeholder='Amount of Columns' style='width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;' required/>";
							echo "</div>";
						echo "</div>";
					}

					echo "<br /><br />
							<input type='hidden' value='$cpFloors' name='Floors'/>";
					
					echo "<input class='btn btn-success' type='submit' value='Submit' />";
					echo "</form>";
				?>
            </div>
          </div>
        </div>

        
      </div><!-- End Main Content -->
    </div><!-- End Wrapper -->

    <?php getScripts() ?>
  </body>
</html>
