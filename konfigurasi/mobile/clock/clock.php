<html>
<head>
<link rel="stylesheet" type="text/css" href="jquery/css/jquery-ui.css">
<script type="text/javascript" src="jquery/js/jquery-2.2.3.min.js"></script>
<script  type="text/javascript" src="jquery/js/jquery-ui.min.js"></script>
<script  type="text/javascript" src="color_flip_1.js"></script>

<script src="bootstrap-colorpicker.js"></script>
<script src="test.js"></script>
<link href="bootstrap-colorpicker.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/demo.css">

<link rel="stylesheet" href="../../assets/clock/bootstrap.min.css">
<script src="../../assets/clock/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../assets/fontawesome/css/all.css">
<link rel="stylesheet" href="../style4.css">
<?php include_once("./conn.php");?>
<?php include "control.php";?>
<script src="scripts.js"></script>
</head>


<style>
.modal-open, body, .navbar-fixed-top, .navbar-fixed-bottom{
    padding-right: 0px !important;
	margin-right: 0px !important
}
</style>
<body>
<link rel="stylesheet" href="../../assets/css/close.css" />
<link rel="stylesheet" href="../../assets/css/bootstrap-datetimepicker.css" />

<script src="../../assets/js/moment-with-locales.js"></script>
<script src="../../assets/js/bootstrap-datetimepicker.js"></script>


<div class="wrapper">
        <!-- Sidebar  -->
		<?php include "side.php";?>
		<?php include 'compiled/flipclock.php';?>
		<script src="compiled/flipclock.js"></script>
        <!-- Page Content  -->
        <div id="content">
		<button type="button" id="sidebarCollapse" class="btn btn-info">
				<i class="fas fa-align-left"></i>
				<span>Menu</span>
			</button><b>&nbsp&nbsp&nbsp&nbsp&nbspClock Style</b>
			
<div class="main-content">
	<?php include 'compiled/flipclock.php';?>
<script src="compiled/flipclock.js"></script>

	
	
<br>
	<?php $query = mysqli_query($con, "SELECT * FROM main");
	$row1 = mysqli_fetch_array($query)?>
	 <?php include "control.php";?>
	<div class="container">	
	<br>
	<br>
		<div class="row">
			<div class="col-md-7 col-md-offset-0 well">
				<a class="btn btn-default" id="change-color">Change Clock Background Color</a>
				
				<a class="btn btn-default" id="change-color2">Change Clock Number Color</a> 
				
				<a class="btn btn-default" id="reset-color">Reset Default</a>		
			</div>
			
			<div class="col-md-7 col-md-offset-0 well">
				<a class="btn btn-default" id="change-color3">Change Background Login Color</a> 
			</div>
		</div>	
		<div class='color_data_1' id='color_data_1'></div>
		<div class='color_data_2' id='color_data_2'></div>
		<div class='color_data_3' id='color_data_3'></div>
		<style>
		.square{
		width: 40px;
		height: 40px;
		}
		</style>
		<div class="col-sm9 clock" style="center"></div>
	</div>
</div>  
</div>
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
<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
	<script src="../assets/js/bootstrap.js"></script>
</body>


</html>