<?php include_once("scripts/php/AP_functions.php"); ?>
  <?php getHead(); ?>
     <body>
      <?php getNav(); ?>
      <div id="wrapper" class="sidebarDisplayed">
      
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
          <li><a href="#">Account</a></li>          
          <li><a href="#">Settings</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div><!-- End Sidebar -->

      <!-- Main Content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <a href="#" class="btn btn-primary" id="menu-toggle"><i id="menu-toggle-button" class="fa fa-arrow-left"></i></a>
              <h1>Sidebar Layout</h1>      
              <p>This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. </p>
            </div>
          </div>
        </div>

        
      </div><!-- End Main Content -->
    </div><!-- End Wrapper -->


    

    <?php getScripts() ?>

    <!-- Menu Toggle Script -->
    <script type="text/javascript">
      $("#menu-toggle").click(function(e){
        //Stops browser from going to URL
        e.preventDefault();
        //Collapases and shows sidebar
        $("#wrapper").toggleClass("sidebarDisplayed");

        if($("#menu-toggle-button").hasClass("fa-arrow-left")){
          $("#menu-toggle-button").removeClass("fa-arrow-left");
          $("#menu-toggle-button").addClass("fa-arrow-right");
        }else{
          $("#menu-toggle-button").removeClass("fa-arrow-right");
          $("#menu-toggle-button").addClass("fa-arrow-left");
        }
      });

      
      $("#btnSignIn").click(function(e){
        //Stops browser from going to URL
        e.preventDefault();
      });

    </script>

    <script type="text/javascript">
      $(function () {
        $('#ArrivalDate').datetimepicker();
      });
    </script>
  </body>
</html>