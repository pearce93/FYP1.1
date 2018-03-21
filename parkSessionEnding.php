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
              <h1>Sidebar Layout</h1>      
              <p>This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. </p>
            </div>
          </div>
        </div>        
      </div><!-- End Main Content -->
    </div><!-- End Wrapper -->

    <?php getScripts() ?>


    <!-- Refresh page every minute so that the board stays updated -->
    <script type="text/javascript">
      setTimeout(function(){
        location = ''
      },10000)
    </script>
  </body>
</html>