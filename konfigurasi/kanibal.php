<?php
include './conn.php';

session_start();
if (!isset($_SESSION['username'])) {
	header('Location: login.php');
} elseif (isset($_GET['logout'])) {
	session_destroy();
	header('Location: login.php');
}
function set_progress($val = 0)
{

	$data = "<div class='progress-container' style='display:none'>
            
                <div class='progress'>
                      <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: " . $val . "%'>
                      </div>
                </div>
            </div>";
	return $data;
}



//** UNTUK AGENDA **//
if (isset($_POST['addagenda'])) {
	$agenda = $_POST['agenda'];
	$status = $_POST['status'];
	mysqli_query($con, "INSERT INTO `Agenda`(`agenda`,`status`) VALUES ('$agenda','$status')");
} elseif (isset($_POST['hapusagenda'])) {
	$id = $_POST['id'];
	mysqli_query($con, "delete FROM `Agenda` WHERE id=$id");
} elseif (isset($_POST['editagenda'])) {
	$id = $_POST['id'];
	$agenda = $_POST['agenda'];
	$status = $_POST['status'];
	mysqli_query($con, "UPDATE `Agenda` SET `agenda`='$agenda', `status`='$status' WHERE id=$id");
}
?>
<!doctype html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- 
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    Bootstrap core CSS -->
	<link href="css/buttons.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->

	<!-- Your custom styles (optional) -->
	<link href="css/style.css" rel="stylesheet">

	<!-- Le styles -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">
	<link href="assets/css/font-style.css" rel="stylesheet">
	<link href="assets/css/flexslider.css" rel="stylesheet">

	<script type="text/javascript" src="js/jquery-latest.js"></script>
	<!---CLOCK JS-->
	<script type="text/javascript">
		function date_time(id) {
			date = new Date;
			year = date.getFullYear();
			month = date.getMonth();
			months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
			d = date.getDate();
			day = date.getDay();
			days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum`at', 'Sabtu');
			h = date.getHours();
			if (h < 10) {
				h = "0" + h;
			}
			m = date.getMinutes();
			if (m < 10) {
				m = "0" + m;
			}
			s = date.getSeconds();
			if (s < 10) {
				s = "0" + s;
			}
			data = '' + days[day] + ', ' + d + ' ' + months[month] + ' ' + year;
			data2 = '' + h + ':' + m + ':' + s;
			document.getElementById(id).innerHTML = data + "<br>" + data2;
			setTimeout('date_time("' + id + '");', '1000');
			return true;
		}
	</script>

	</style>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="assets/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

	<!-- Google Fonts call. Font Used Open Sans & Raleway
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
  	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"> -->

	<script type="text/javascript">
		$(document).ready(function() {

			$("#btn-blog-next").click(function() {
				$('#blogCarousel').carousel('next')
			});
			$("#btn-blog-prev").click(function() {
				$('#blogCarousel').carousel('prev')
			});

			$("#btn-client-next").click(function() {
				$('#clientCarousel').carousel('next')
			});
			$("#btn-client-prev").click(function() {
				$('#clientCarousel').carousel('prev')
			});

		});

		$(window).load(function() {

			$('.flexslider').flexslider({
				animation: "slide",
				slideshow: true,
				start: function(slider) {
					$('body').removeClass('loading');
				}
			});
		});
	</script>

</head>
<div class="col-xs-12 col-md-12" style="margin-bottom:10px">
	<center>
		<a href="?logout=true" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-arrow-left"></i> OUT</a>
	</center>
</div>

<body>
	<div class="container">







		<?php $datamain = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `konfigurasi`")); ?>
		<div class="col-sm-12 col-lg-12" style="height:auto">
			<div class="dash-unit" style="height:auto">
				<script src="radio_toggle.js"></script>
				<form method="post" action="konfigurasi.php">
					<div class="form-group">
						<label for="jarak" class="col-sm-1 col-md-1 control-label text-right">Jarak: </label>
						<div class="col-sm-5 col-md-5">
							<div class="input-group">
								<div id="gender_radio" class="btn-group">
									<a class="btn btn-secondary btn-sm noAactive" data-toggle="jarak" data-title="1">ON</a>
									<a class="btn btn-secondary btn-sm noActive" data-toggle="jarak" data-title="0">OFF</a>
								</div>
								<?php $query = mysqli_query($con, "SELECT * FROM `konfigurasi`");
								$row1 = mysqli_fetch_array($query) ?>
								<input type="hidden" name="jarak" id="jarak" value="<?php echo $datamain[2]; ?> ">
							</div>
						</div>
					</div>
					<br><br><br />
					<div class="form-group">
						<label for="color1" class="col-sm-1 col-md-1 control-label text-right">Background Color </label>
						<div class="col-sm-10 col-md-10">
							<div class="input-group">
								<div id="gender_radio" class="btn-group">
									<div id="gender_radio" class="btn-group">
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
								</div>
								<?php $query = mysqli_query($con, "SELECT * FROM `konfigurasi`");
								$row1 = mysqli_fetch_array($query) ?>

								<input type="hidden" name="color1" id="color1" value="<?php echo $row1[3]; ?>">
							</div>
						</div>
					</div>
					<br> <br />
					<div class="form-group">
						<label for="color2" class="col-sm-1 col-md-1 control-label text-right">Menu Color: </label>
						<div class="col-sm-10 col-md-10">
							<div class="input-group">
								<div id="gender_radio" class="btn-group">
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
								<?php $query = mysqli_query($con, "SELECT * FROM `konfigurasi`");
								$row1 = mysqli_fetch_array($query) ?>
								<input type="hidden" name="color2" id="color2" value="<?php echo $datamain[4]; ?>">
							</div>
						</div>
					</div>
					<br></br>
					<div class="form-group">
						<label for="clockcolor" class="col-sm-1 col-md-1 control-label text-right">Clock Color: </label>
						<div class="col-sm-10 col-md-10">
							<div class="input-group">
								<div id="gender_radio" class="btn-group">
									<div id="gender_radio" class="btn-group">
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
								</div>
								<?php $query = mysqli_query($con, "SELECT * FROM `konfigurasi`");
								$row1 = mysqli_fetch_array($query) ?>
								<input type="hidden" name="clockcolor" id="clockcolor" value="<?php echo $datamain[5]; ?>">
							</div>
						</div>
					</div>
					<br></br>
					<div class="form-group">
						<label for="textcolor" class="col-sm-1 col-md-1 control-label text-right">Text Color: </label>
						<div class="col-sm-10 col-md-10">
							<div class="input-group">
								<div id="gender_radio" class="btn-group">
									<div id="gender_radio" class="btn-group">
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
								</div>
								<?php $query = mysqli_query($con, "SELECT * FROM `konfigurasi`");
								$row1 = mysqli_fetch_array($query) ?>
								<input type="hidden" name="textcolor" id="textcolor" value="<?php echo $datamain[6]; ?>">
							</div>
						</div>
					</div>
					<br><button type="submit" class="btn btn-default float-none" name="btn-save" id="btn-save">
						Submit
					</button>
				</form>

			</div>
		</div>
		<!-- INFORMATION BLOCK -->
		<div class="col-sm-12 col-lg-12">
			<div class="footdash-unit" style="width:99%;height:auto;margin:10px;">
				<dtitle>Informasi</dtitle>
				<hr>
				<div class="runningtext">
					<!--for running text space -->
					<?php
					$bodytext = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `beritagabung`ORDER BY ID DESC LIMIT 1"));
					$jeda = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `konfigurasi`"));
					?>
					<marquee scrollamount="<?php echo $jeda['speedtexts']; ?>">
						<h2><?php echo $bodytext[1]; ?><h2>
					</marquee>
				</div>
				<br>

			</div>
		</div>




	</div>




	</div> <!-- /container -->


	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>

	<!-- NOTY JAVASCRIPT -->
	<script type="text/javascript" src="assets/js/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/top.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topLeft.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topRight.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topCenter.js"></script>

	<!-- You can add more layouts if you want -->
	<script type="text/javascript" src="assets/js/noty/themes/default.js"></script>
	<!-- <script type="text/javascript" src="assets/js/dash-noty.js"></script> This is a Noty bubble when you init the theme-->





	<!--Carousel Wrapper-->

	<!-- /Start your project here-->

	<!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="js/mdb.min.js"></script>

	<script>
		$(function() {
			$('#modal-konfirmasiagenda').on('show.bs.modal', function(event) {
				var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

				// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
				var id = div.data('id')

				var modal = $(this)

				// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
				//modal.find('#hapus-true').attr("href", "konfigurasi.php?hapus=hapus&id=" + id);
				modal.find('#id').attr("value", id);
			});
			$('#edit-dataagenda').on('show.bs.modal', function(event) {
				var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

				var id = div.data('id');
				var agenda = div.data('agenda');
				var status = div.data('status');
				var modal = $(this);

				// Isi nilai pada field
				modal.find('#id').attr("value", id);
				modal.find('#agenda').attr("value", agenda);
				modal.find('#status').attr("value", status);
			});
		});
	</script>


</body>

</html>