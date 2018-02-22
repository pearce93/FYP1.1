<?php include_once("scripts/php/AP_functions.php"); ?>
<!DOCTYPE html>
<html>
  <?php getHead(); ?>

  <body>

    <?php getNav(); ?>

    <!-- Main Content -->
    <div class="container-fluid" style="background-color: #415262;">
    	<div class="row">
    		<div class="col-md-4">    			
				<?php getCarPark('2'); ?>
    		</div>
    	</div>
    </div>

    <?php getScripts() ?>


    <script type="text/javascript">
			var idList = [];
			<?php getFloors('2'); ?>

			$("table > tbody > tr").on("click", "td", function() {
				
				var cellID = $(this).attr('id');
				
				if(jQuery.inArray(cellID, idList) !== -1){
					for(var i = idList.length-1; i>=0; i--){
						if(idList[i] === cellID){
							idList.splice(i, 1);
						}
					}
				}else{
					idList.push(cellID);
				}
				
				console.log(idList);
			});
		</script>
  </body>
</html>