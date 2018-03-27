<?php include_once("scripts/php/AP_functions.php"); ?>


<!DOCTYPE html>
<html>
<head>
	<?php getHead(); ?>
	<title></title>

    <?php getNav(); ?>

</head>
<body>
<style type="text/css">
		.Available {
			position:relative;
			border-left: solid;
			width: 4px;
		}

		.Available:last-of-type{
			border-right: solid;
		}

		.Available:before {
			content: "\f1b9";  /* this is your text. You can also use UTF-8 character codes as I do here */
			font-family: FontAwesome;
			left:-5px;
			top:0;
		}

		.Available:hover {
			border-color: black;
			color: #1275BB;
			cursor: pointer;
		}

		.Road {
			position:relative;
			background-color: grey;
		}

		.Road{
			cursor: not-allowed;
		}

		.Road:first-of-type {
			border-left: solid;
		}

		.Road:last-of-type {
			border-right: solid;
		}
</style>
	<div class="container">

		<div class="row">
			<div class="col-xs-12">
				<h1>Draw out car park</h1>
				<?php getNewCarPark(); ?>				
			</div>
		</div>
	</div>

	<div class="container topMargin">
		<div class="row">
			<div class="col-xs-2">
				<input class="btn btn-primary btn-block" type="button" value="Available" onclick="setSpaceType('Available');" />
			</div>
			<div class="col-xs-2">
				<input class="btn btn-primary btn-block" type="button" value="Unavailable" onclick="setSpaceType('Unavailable');" />
			</div>
			<div class="col-xs-2">
				<input class="btn btn-primary btn-block" type="button" value="Disabled" onclick="setSpaceType('Disabled');" />
			</div>
			<div class="col-xs-2">
				<input class="btn btn-primary btn-block" type="button" value="Family" onclick="setSpaceType('Family');" />
			</div>
			<div class="col-xs-2">
				<input class="btn btn-primary btn-block" type="button" value="Road" onclick="setSpaceType('Road');" />
			</div>
			<div class="col-xs-2">
				<a href="index.php" class="btn btn-success btn-block">Finished</a>
			</div>
		</div>
	</div>


	<?php getScripts(); ?>
		
		<script type="text/javascript">
			//Script for space types
			var idList = [];
			$("table > tbody > tr").on("click", "td", function() {
					
				var cellID = $(this).attr('id');
				$(this).toggleClass("spaceSelected");
				cellID = cellID.split("_")[1];
				console.log(cellID);

				if(jQuery.inArray(cellID, idList) !== -1){
					for(var i = idList.length-1; i>=0; i--){
						if(idList[i] === cellID){
							idList.splice(i, 1);
							console.log("Hello");
						}
					}
				}else{
					idList.push(cellID);
				}
				
				console.log(idList);
			});//End Script for space types


			function setSpaceType($spaceType){
				for(var i = 0; i < idList.length; i++){
					console.log(idList[i]);
					$("td#Space_"+idList[i]).removeClass("spaceSelected");
					$("td#Space_"+idList[i]).removeClass("Available");
					$("td#Space_"+idList[i]).removeClass("Unavailable");
					$("td#Space_"+idList[i]).removeClass("Disabled");
					$("td#Space_"+idList[i]).removeClass("Family");
					$("td#Space_"+idList[i]).removeClass("Road");
					$("td#Space_"+idList[i]).addClass($spaceType);

					$.post('test5.php',{spaceID:idList[i],spaceType:$spaceType},function(data){
						$('#result').html(data);
					});
				}
				idList = [];
			}

			
		</script>
</body>
</html>