<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery/css/jquery-ui.css">
<script type="text/javascript" src="jquery/js/jquery-2.2.3.min.js"></script>
<script  type="text/javascript" src="jquery/js/jquery-ui.min.js"></script>
<script  type="text/javascript" src="color_flip_1.js"></script>

<script src="bootstrap-colorpicker.js"></script>
<script src="test.js"></script>
<link href="bootstrap-colorpicker.css" rel="stylesheet">
<?php include_once("./conn.php");?>
<script src="scripts.js"></script>
</head>
<body class="text-align:left">
	<link rel="stylesheet" href="../assets/demo.css">
	<link rel="stylesheet" href="../assets/sidebar-collapse.css">

	<link rel="stylesheet" href="../assets/fontawesome/css/all.css">
	
<style>

<?php include 'asides.php';?>
<?php include 'compiled/flipclock.php';?>
<script src="compiled/flipclock.js"></script>
<div class="container" style="min-height:500px; padding-left:160px">
<br>
	<?php $query = mysqli_query($con, "SELECT * FROM main");
	$row1 = mysqli_fetch_array($query)?>

	<div class="container">	
	<br>
	<br>
		<div class="row">
			<div class="col-md-7 col-md-offset-0 well">
				<a class="btn btn-default" id="change-color">Change Clock Background Color</a>
				
				<a class="btn btn-default" id="change-color2">Change Clock Number Color</a> 
				
				<a class="btn btn-default" id="reset-color">Reset Default</a>		
			</div>
		</div>	
		<div class='color_data_1' id='color_data_1'></div>
		<div class='color_data_2' id='color_data_2'></div>
		<style>
		.square{
		width: 40px;
		height: 40px;
		}
		</style>
		<div class="col-sm9 clock" style="center"></div>
	</div>
	<script type="text/javascript">
		var clock;
		
		$(document).ready(function() {
			clock = $('.clock').FlipClock({
				clockFace: 'TwentyFourHourClock',
				showSeconds: false
			});
		});
	</script>
</div>

</body>
</html>