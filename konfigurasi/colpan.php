<?php include './conn.php';
function set_progress($val = 0) {
    $data = "<div class='progress-container' style='display:none'>
                <div class='progress'>
                      <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: " . $val . "%'>
                      </div>
                </div>
            </div>";
    return $data;
}
if (isset($_POST['btn-save'])) {
    $jarak = $_POST['jarak'];
		$color1 = $_POST['color1'];
		$color2 = $_POST['color2'];
		$clockcolor = $_POST['clockcolor'];
		$textcolor = $_POST['textcolor'];
    mysqli_query($con,"UPDATE `konfigurasi` SET `jarak`='$jarak',`color1`='$color1',`color2`='$color2',`clockcolor`='$clockcolor',`textcolor`='$textcolor' WHERE id=1");
}?>
<html>
<head>
<?php include 'head.php'; ?>
</head>
<link rel="stylesheet" href="conditional/bootstrap-iso.css">
</head>
<style>
.modal-open, body, .navbar-fixed-top, .navbar-fixed-bottom{
    padding-right: 0px !important;
	margin-right: 0px !important
}
</style>
<body>
<?php 
include 'asides3.php'; ?>

<!--START ENDDDDDDDDDDDDDDDDDDDDDDDDDDDD<style>
label { text-align:right;}
@media (max-width: 900px) {
  .btn-group.my-btn-group-responsive > .btn {
    display: block;
    width: 100%;
  }
  .btn {width:50%;}
  /* making the border-radius correct */
  .btn-group.my-btn-group-responsive > .btn:first-child {
    border-radius: 6px 6px 0 0;
  }
  .btn-group.my-btn-group-responsive > .btn:first-child:not(:last-child):not(.dropdown-toggle) {
    border-top-right-radius: 6px;
  }
  .btn-group.my-btn-group-responsive > .btn:last-child:not(:first-child) {
    border-radius: 0 0 6px 6px;
  }
  
  /* fixing margin */
  .btn-group.my-btn-group-responsive .btn + .btn {
    margin-left: 0;
  }
  
}
</style>
<div class="main-content">
<script src="assets/js/radio_toggle.js"></script>							
	<form method="post" action="colpan.php">	
		<div class="form-group">
			<label for="jarak" class="control-label text-left"><b>Jarak</b></label>
				<div id="gender_radio" class="btn-group">
					<a class="btn btn-secondary btn-sm noAactive" data-toggle="jarak" data-title="1">ON</a>
					<a class="btn btn-secondary btn-sm noActive" data-toggle="jarak" data-title="0">OFF</a>
				</div>
				<?php $query = mysqli_query($con, "SELECT * FROM konfigurasi");
				$row1= mysqli_fetch_array($query)?>
				<input type="hidden" name="jarak" id="jarak" value="<?php echo $datamain[2];?> ">
		</div>
		<br><br/>
		<div class="form-group">
			<label for="color1" class="control-label text-left"><b>Background Color</b></label>
				<div id="gender_radio" class="btn-group flex-wrap">
					<a class="btn btn-default btn-sm noActive" data-toggle="color1" data-title="ffffff">White</a>
					<a class="btn btn-flatblue btn-sm noActive" data-toggle="color1" data-title="337ab7">Flat-Blue</a>
					<a class="btn btn-flatgreen btn-sm noActive" data-toggle="color1" data-title="5cb85c">Green</a>
					<a class="btn btn-flatyellow btn-sm noActive" data-toggle="color1" data-title="f0ad4e">Yellow</a>
					<a class="btn btn-dark btn-sm noActive" data-toggle="color1" data-title="1f1f1f">Dark</a>
					<a class="btn btn-flatred btn-sm noActive" data-toggle="color1" data-title="d9534f">Red</a>
					<a class="btn btn-lightdark btn-sm noActive" data-toggle="color1" data-title="3d3d3d">Light Dark</a>
					<a class="btn btn-orange btn-sm noActive" data-toggle="color1" data-title="eba804">Orange</a>
					<a class="btn btn-emarld btn-sm noActive" data-toggle="color1" data-title="2ecc71">Emerald</a>
					<a class="btn btn-flatteal btn-sm noActive" data-toggle="color1" data-title="5bc0de">Teal</a>
					<a class="btn btn-pixgrass btn-sm noActive" data-toggle="color1" data-title="009432">Pixelrated Grass</a>
				</div>
				<?php $query = mysqli_query($con, "SELECT * FROM konfigurasi");
				$row1= mysqli_fetch_array($query)?>
				<input type="hidden" name="color1" id="color1" value="<?php echo $datamain[3];?>">
		</div>			
		<br><br/>			
		<div class="form-group">
			<label for="color2" class="control-label text-left"><b>Menu Color</b></label>
			<div id="gender_radio" class="btn-group flex-wrap">
				<a class="btn btn-default btn-sm noActive" data-toggle="color2" data-title="ffffff">White</a>
				<a class="btn btn-flatblue btn-sm noActive" data-toggle="color2" data-title="337ab7">Flat-Blue</a>
				<a class="btn btn-flatgreen btn-sm noActive" data-toggle="color2" data-title="5cb85c">Green</a>
				<a class="btn btn-flatyellow btn-sm noActive" data-toggle="color2" data-title="f0ad4e">Yellow</a>
				<a class="btn btn-dark btn-sm noActive" data-toggle="color2" data-title="1f1f1f">Dark</a>
				<a class="btn btn-flatred btn-sm noActive" data-toggle="color2" data-title="d9534f">Red</a>
				<a class="btn btn-lightdark btn-sm noActive" data-toggle="color2" data-title="3d3d3d">Light Dark</a>
				<a class="btn btn-orange btn-sm noActive" data-toggle="color2" data-title="eba804">Orange</a>
				<a class="btn btn-emarld btn-sm noActive" data-toggle="color2" data-title="2ecc71">Emerald</a>
				<a class="btn btn-flatteal btn-sm noActive" data-toggle="color2" data-title="5bc0de">Teal</a>
				<a class="btn btn-pixgrass btn-sm noActive" data-toggle="color2" data-title="009432">Pixelrated Grass</a>
			</div>
			<?php $query = mysqli_query($con, "SELECT * FROM konfigurasi");
			$row1= mysqli_fetch_array($query)?>
			<input type="hidden" name="color2" id="color2" value="<?php echo $datamain[4];?>">
		</div>
		<br></br>
		<div class="form-group">
			<label for="clockcolor" class="control-label text-left"><b>Clock Color</label></b></label>
			<div id="gender_radio" class="btn-group flex-wrap">
				<a class="btn btn-default btn-sm noActive" data-toggle="clockcolor" data-title="ffffff">White</a>
				<a class="btn btn-flatblue btn-sm noActive" data-toggle="clockcolor" data-title="337ab7">Flat-Blue</a>
				<a class="btn btn-flatgreen btn-sm noActive" data-toggle="clockcolor" data-title="5cb85c">Green</a>
				<a class="btn btn-flatyellow btn-sm noActive" data-toggle="clockcolor" data-title="f0ad4e">Yellow</a>
				<a class="btn btn-dark btn-sm noActive" data-toggle="clockcolor" data-title="1f1f1f">Dark</a>
				<a class="btn btn-flatred btn-sm noActive" data-toggle="clockcolor" data-title="d9534f">Red</a>
				<a class="btn btn-lightdark btn-sm noActive" data-toggle="clockcolor" data-title="3d3d3d">Light Dark</a>
				<a class="btn btn-orange btn-sm noActive" data-toggle="clockcolor" data-title="eba804">Orange</a>
				<a class="btn btn-emarld btn-sm noActive" data-toggle="clockcolor" data-title="2ecc71">Emerald</a>
				<a class="btn btn-flatteal btn-sm noActive" data-toggle="clockcolor" data-title="5bc0de">Teal</a>
				<a class="btn btn-pixgrass btn-sm noActive" data-toggle="clockcolor" data-title="009432">Pixelrated Grass</a>
			</div>
			<?php $query = mysqli_query($con, "SELECT * FROM konfigurasi");
			$row1= mysqli_fetch_array($query)?>
			<input type="hidden" name="clockcolor" id="clockcolor" value="<?php echo $datamain[5];?>">
		</div>	
		<br></br>
		<div class="form-group">
			<label for="textcolor" class="control-label text-left"><b>Text Color</label></b></label>
			<div id="gender_radio" class="btn-group flex-wrap">
				<a class="btn btn-default btn-sm noActive" data-toggle="textcolor" data-title="ffffff">White</a>
				<a class="btn btn-flatblue btn-sm noActive" data-toggle="textcolor" data-title="337ab7">Flat-Blue</a>
				<a class="btn btn-flatgreen btn-sm noActive" data-toggle="textcolor" data-title="5cb85c">Green</a>
				<a class="btn btn-flatyellow btn-sm noActive" data-toggle="textcolor" data-title="f0ad4e">Yellow</a>
				<a class="btn btn-dark btn-sm noActive" data-toggle="textcolor" data-title="1f1f1f">Dark</a>
				<a class="btn btn-flatred btn-sm noActive" data-toggle="textcolor" data-title="5">Red</a>
				<a class="btn btn-lightdark btn-sm noActive" data-toggle="textcolor" data-title="3d3d3d">Light Dark</a>
				<a class="btn btn-orange btn-sm noActive" data-toggle="textcolor" data-title="eba804">Orange</a>
				<a class="btn btn-emarld btn-sm noActive" data-toggle="textcolor" data-title="2ecc71">Emerald</a>
				<a class="btn btn-flatteal btn-sm noActive" data-toggle="textcolor" data-title="5bc0de">Teal</a>
				<a class="btn btn-pixgrass btn-sm noActive" data-toggle="textcolor" data-title="009432">Pixelrated Grass</a>
			</div>
			<?php $query = mysqli_query($con, "SELECT * FROM konfigurasi");
			$row1= mysqli_fetch_array($query)?>
			<input type="hidden" name="textcolor" id="textcolor" value="<?php echo $datamain[6];?>">
		</div>
		<br>
		<button type="submit" class="btn btn-primary" name="btn-save"  id="btn-save">
					 Submit
				</button> 			
	</form>
</div>  -->

<?php include 'foot.php';?>
</body>
</html>