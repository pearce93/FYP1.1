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
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12"><!-- Modal Personal Details  -->
              <div class="modal fade" id="updatePersonalDetails" style="display:none;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form action="scripts/php/updatePersonalDetails.php" method="post">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="modal-title" id="exampleModalLabel">Personal Information</h2>        
                      </div>
                      <div class="modal-body">
                        
                          <div class="row">
                            <div class="col-lg-offset-2 col-lg-4">
                              <label>First Name: </label>
                            </div>
                            <div class="col-lg-offset-1 col-lg-4">
                              <input type="text" class="form-control" name="firstName" placeholder="First Name" style="width:  100%;">
                            </div>
                          </div>

                          <div class="row bottomMargin">
                            <div class="col-lg-offset-2 col-lg-4">
                              <label>Last Name: </label>
                            </div>
                            <div class="col-lg-offset-1 col-lg-4">
                              <input type="text" class="form-control" name="lastName" placeholder="Last Name" style="width:  100%;">
                            </div>
                          </div>

                          <div class="row bottomMargin">
                            <div class="col-lg-offset-2 col-lg-4">
                              <label>Address: </label>
                            </div>
                            <div class="col-lg-offset-1 col-lg-4">
                              <input type="text" class="form-control" name="address" placeholder="Address" style="width:  100%;">
                            </div>
                          </div>

                          <div class="row bottomMargin">
                            <div class="col-lg-offset-2 col-lg-4">
                              <label>Contact Number: </label>
                            </div>
                            <div class="col-lg-offset-1 col-lg-4">
                              <input type="number" id="contactNumber" class="form-control" name="contactNumber" placeholder="Contact Number" style="width:  100%;">
                            </div>
                          </div>                
                      </div>
                      <div class="modal-footer">
                        <div class="row">
                          <div class="col-lg-2">
                            <a href="" data-dismiss="modal">Close</a>
                          </div>
                          <div class="col-lg-offset-8 col-lg-2">
                            <input id="updatePersonalDetails" class="btn btn-primary" type="submit" name="submit" value="Save"> 
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12">
              <div class="modal fade" id="addCar" style="display:none;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form action="scripts/php/addCar.php" method="post">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="modal-title" id="exampleModalLabel">Add Car</h2>        
                      </div>
                      <div class="modal-body">
                        
                          <div class="row">
                            <div class="col-lg-offset-1 col-lg-4">
                              <label>Car License Plate: </label>
                            </div>
                            <div class="col-lg-offset-1 col-lg-4">
                              <input type="text" class="form-control" name="carLicensePlate" placeholder="Car License Plate" style="width:  100%;" required="">
                            </div>
                          </div>

                          <div class="row bottomMargin">
                            <div class="col-lg-offset-2 col-lg-3">
                              <label>Car Model: </label>
                            </div>
                            <div class="col-lg-offset-1 col-lg-4">
                              <input type="text" class="form-control" name="carModel" placeholder="Car Model" style="width:  100%;" required="">
                            </div>
                          </div>                
                      </div>
                      <div class="modal-footer">
                        <div class="row">
                          <div class="col-lg-2">
                            <a href="" data-dismiss="modal">Close</a>
                          </div>
                          <div class="col-lg-offset-8 col-lg-2">
                            <input id="addCar" class="btn btn-primary" type="submit" name="submit" value="Save"> 
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12">
              <div class="container">
                <div class="row">
                  <div class="col-lg-9">
                    <div class="row">
                      <div class="col-lg-11 registrationBox bottomMargin">
                        <h1 class="text-center">Personal Information</h1>
                        <hr>

                        <div class="row">
                          <div class="col-lg-offset-2 col-lg-3">
                            <label>First Name: </label>
                          </div>
                          <div class="col-lg-offset-1 col-lg-4">
                            <?php echo getUserFirstName() ?>
                          </div>
                        </div>

                        <div class="row bottomMargin">
                          <div class="col-lg-offset-2 col-lg-3">
                            <label>Last Name: </label>
                          </div>
                          <div class="col-lg-offset-1 col-lg-4">
                            <?php echo getUserLastName() ?>
                          </div>
                        </div>

                        <div class="row bottomMargin">
                          <div class="col-lg-offset-2 col-lg-3">
                            <label>Address: </label>
                          </div>
                          <div class="col-lg-offset-1 col-lg-5">
                            <?php getUserAddress() ?>
                          </div>
                        </div>

                        <div class="row bottomMargin">
                          <div class="col-lg-offset-2 col-lg-3">
                            <label>Contact Number: </label>
                          </div>
                          <div class="col-lg-offset-1 col-lg-4">
                            <?php getUserContactNumber() ?>
                          </div>
                        </div>
                        <hr/>
                        <div class="row bottomMargin">
                          <div class="col-lg-offset-10 col-lg-2">
                            <a href="" data-toggle="modal" data-target="#updatePersonalDetails">Update</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="row registrationBox">
                        <h1 class="text-center bottomMargin">Cars</h1>
                      <div class="col-lg-12" style="max-height: 260px; overflow-y: scroll;">
                        <hr>            
                        <table class="greyGridTable">
                          <tr>
                            <th class="text-center">License Plate</th>
                            <th class="text-center">Model</th>
                            <th></th>
                          </tr>
                          <?php getUserCars() ?>
                        </table>

                        <hr/>
                        <div class="row bottomMargin">
                          <div class="col-lg-offset-6 col-lg-6">
                            <a href="" data-toggle="modal" data-target="#addCar">Add a Car</a><br/><br/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-12 registrationBox">
                          <h1 class="text-center">Booking History</h1>
                          <hr/>
                          
                          <div class="col-lg-12 bottomMargin">
                            <div class="table-responsive">
                              <table id="bookingHistory">
                                <thead>
                                  <tr>
                                    <th>Car</th>
                                    <th>Car Park</th>
                                    <th>Space</th>
                                    <th>Reservation Date</th>
                                    <th>Enter Date</th>
                                    <th>Exit Date</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php bookingHistory(); ?>
                                  </tbody>
                              </table>
                            </div>
                            
                            <hr/>
                            <div class="col-lg-offset-10 col-lg-2">
                              <a href="carParks.php">Create a Booking</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                  
                </div>        
              </div>
            </div>
          </div>



        </div>

        
      </div><!-- End Main Content -->
    </div><!-- End Wrapper -->


    

    <?php getScripts() ?>

    <script type="text/javascript">
      $(document).ready( function () {
        $('#bookingHistory').DataTable({
          "searching": true,
          "pageLength": 50,
          "paging": true,
          "order": [ 3, 'desc' ]
        });
      });
    </script>
  </body>
</html>