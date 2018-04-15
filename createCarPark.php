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
                <form id="createCarPark" action="test1.php" method="post">
                  <div class="row">
                    <div class="col-lg-6">          
                      <input type="text" name="cpName" placeholder="Car Park Name" required="">     
                    </div>
                    <div class="col-lg-6">
                      <input type="text" name="cpCode" placeholder="Code" required="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <input type="text" name="cpAddress" placeholder="Address" required="">
                    </div>
                    <div class="col-lg-6">
                      <input type="text" name="cpPostCode" placeholder="Post Code" required="">         
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <input type="text" name="cpCity" placeholder="City" required="">
                    </div>
                    <div class="col-lg-6">
                      <input type="text" name="cpFloors" placeholder="Floors" required="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <textarea rows="5" cols="60" name="cpDetails" placeholder="Details" form="createCarPark"></textarea>
                    </div>
                  </div>

                  <input class="btn btn-success" type="submit" value="Submit">
                </form>
            </div>
          </div>
        </div>

        
      </div><!-- End Main Content -->
    </div><!-- End Wrapper -->

    <?php getScripts() ?>
  </body>
</html>