<?php
include './conn.php'; ?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Alvin Mantovani">
	<link rel="stylesheet" href="test/assets/bootstrap/css/bootstrap.min.css">

	<style>
		*,
		::after,
		::before {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		.grid-container {
			width: 100vw;
			height: 100vh;
			display: grid;
			grid-template-columns: 80% 20%;
			grid-template-rows: 25% 55% 20%;
			gap: 0px 0px;
		}

		.running {
			grid-area: 3 / 1 / 4 / 2;
			background: red;
		}

		.slider {
			grid-area: 1 / 1 / 3 / 2;
			background: blue;
		}

		.profile {
			grid-area: 1 / 2 / 2 / 3;
			background: green;
		}

		.profile--content {
			box-shadow: inset -0px -10px 20px -8px rgba(0, 0, 0, 0.4);
			width: 100%;
			height: 20%;
			padding: 0 10px;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
		}

		.profile--content>img {
			max-width: 100%;
			max-height: 100%;
			height: auto !important;
		}

		.menu {
			grid-area: 2 / 2 / 4 / 3;
			background: yellow;
			box-shadow: -10px 0px 10px -10px rgba(0, 0, 0, 0.4);
		}

		div[class$="content"] {
			background: #343a40;
			width: 100%;
			height: 100%;
			color: white;
		}

		.running--content {
			display: flex;
			align-items: center;
			height: 100%;
		}

		.menu--content {
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			text-align: center;
		}

		.menu--content>*:first-child {
			/* tanggal */
			font-size: 1.4rem
		}

		.row {
			margin: 0;
		}

		.menu--content--item--title {
			font-size: 1.4rem;
			text-align: left;
			margin-left: 20px;
			padding: 0;
		}

		.menu--content--item--percentage {
			font-size: 1.4rem;
			text-align: right !important;
		}

		.menu--content>*:not(:first-child):not(:last-child)>div[class*="title"] {
			/* menu */
			font-size: 1.4rem;
		}

		.menu--content>*:not(:first-child):not(:last-child)>div[class*="info"] {
			/* menu */
			font-size: 2.2rem
		}

		.menu--content>*:last-child {
			/* jam */
			font-size: 4.4rem
		}

		.menu--content {
			box-sizing: content-box !important;
		}

		.menu--content>* {
			box-sizing: content-box !important;
		}

		.menu--item {
			min-height: 90vh;
			width: 100%;
			max-width: 100%;
		}

		.card.company-profile {
			text-align: center;
		}

		.card.company-profile>img {
			width: 100%;
			height: auto;
		}

		.menu-logo img {
			width: 30%;
			height: inherit;
		}

		.anythingSlider,
		.anythingWindow,
		#slider {
			height: 80vh !important;
		}

		.panel {
			border: 0 !important;
		}
	</style>
</head>
<body style="background: #<?php echo $datamain[3] ?>">
	<?php $datamain = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `konfigurasi`")); ?>
	<div class="grid-container">
		<div class="profile">
			<div class="profile--content">
				<img src="./Adobe-Logo.png" />
				<p>Adobo Corporation</p>
			</div>
		</div>
		<div class="slider">
			<div class="slider--content" style="align-items:center;
				height: 100vh;
				justify-content:center; 
				overflow: hidden;
				<?php if ($datamain[2] == 1) {	?>padding:0px;<?php } ?>">
				<ul id="slider" style="height:100vh;">
					<?php $dataslideutama = mysqli_query($con, "SELECT * FROM `slider`") or die(mysqli_error($con));
					$i = 0;
					while ($slide_utama = mysqli_fetch_array($dataslideutama)) {
						$i += 1; ?>
						<li style="height:100vh;" class="panel<?php $i; ?>">
							<video autoplay muted style=" object-fit: fill;height:100%;">
								<source src="./konfigurasi/gambar/slide-utama/<?php echo $slide_utama[2]; ?>" type="video/mp4">
							</video>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="running">
			<div class="running--content">
				<?php
				$bodytext = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `beritagabung`ORDER BY ID DESC LIMIT 1"));
				$jeda = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `konfigurasi`"));
				?>
				<marquee style="font-size:45px;"><?php echo $bodytext[1]; ?></marquee>
			</div>
		</div>
		<div class="menu">
			<div class="menu--content">
				<div class="menu--content--item" id="mydate">
					<?php
					date_default_timezone_set('Asia/Jakarta');
					setlocale(LC_ALL, 'IND');
					echo strftime("%A, %e %B %G"); ?>
				</div>
				<?php $datacovid = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `covid`")); ?>
				<div class="menu--content--item">
					<div class="menu--content--item--title">Konfirmasi</div>
					<div class="menu--content--item--info text-warning">
						<?php echo number_format($datacovid["konfirmasi"], 0, ",", "."); ?>
					</div>
				</div>
				<div class="menu--content--item">
					<div class="row">
						<div class="menu--content--item--title col-sm-6">Isolasi</div>
						<div class="menu--content--item--percentage col-sm-3">
							<?php echo number_format($datacovid["isolasi"] / $datacovid["konfirmasi"] * 100, 2, ",", ".") . "%"; ?>
						</div>
					</div>
					<div class="menu--content--item--info text-primary">
						<?php echo number_format($datacovid["isolasi"], 0, ",", "."); ?>
					</div>
				</div>
				<div class="menu--content--item">
					<div class="row">
						<div class="menu--content--item--title col-sm-6">Rawat</div>
						<div class="menu--content--item--percentage col-sm-3">
							<?php echo number_format($datacovid["rawat"] / $datacovid["konfirmasi"] * 100, 2, ",", ".") . "%"; ?>
						</div>
					</div>
					<div class="menu--content--item--info text-info">
						<?php echo number_format($datacovid["rawat"], 0, ",", "."); ?>
					</div>
				</div>
				<div class="menu--content--item">
					<div class="row">
						<div class="menu--content--item--title col-sm-6">Sembuh</div>
						<div class="menu--content--item--percentage col-sm-3">
							<?php echo number_format($datacovid["sembuh"] / $datacovid["konfirmasi"] * 100, 2, ",", ".") . "%"; ?>
						</div>
					</div>
					<div class="menu--content--item--info text-success">
						<?php echo number_format($datacovid["sembuh"], 0, ",", "."); ?>
					</div>
				</div>
				<div class="menu--content--item">
					<div class="row">
						<div class="menu--content--item--title col-sm-6">Meninggal</div>
						<div class="menu--content--item--percentage col-sm-3">
							<?php echo number_format($datacovid["wafat"] / $datacovid["konfirmasi"] * 100, 2, ",", ".") . "%"; ?>
						</div>
					</div>
					<div class="menu--content--item--info text-danger">
						<?php echo number_format($datacovid["wafat"], 0, ",", "."); ?>
					</div>
				</div>
				<div class="menu--content--item" id="mytime">
					<?php
					echo date("H:i:s"); ?>
				</div>
			</div>
		</div>
		<div id="cek"></div>
	</div>

	<link rel="stylesheet" href="style_slider.css">
	<script type="text/javascript" src="car/jquery.min.js"></script>
	<script src="js/jquery.anythingslider.js"></script>
	<!-- <script src="js/jquery.easing.1.2.js"></script> -->
	<script>
		let thisdate = new Date();
		let numDay = thisdate.getDay();
		let numMonth = thisdate.getMonth();
		let dateData = {
			days: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
			months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
		}

		$(document).ready(function() {
			clockUpdate();
			setInterval(clockUpdate, 1000);
		})

		function clockUpdate() {
			date = new Date();
			function addZero(x) {
				if (x < 10) {
					return x = '0' + x;
				} else {
					return x;
				}
			}

			function twelveHour(x) {
				if (x > 12) {
					return x = x - 12;
				} else if (x == 0) {
					return x = 12;
				} else {
					return x;
				}
			}

			let h = addZero(date.getHours());
			let m = addZero(date.getMinutes());
			let s = addZero(date.getSeconds());
			$('#mytime').text(h + ':' + m + ':' + s)
			$('#mydate').text(`${dateData.days[numDay]}, ${date.getDate()} ${dateData.months[numMonth]} ${date.getFullYear()}`)
		}
	</script>
	<script>
		// DOM Ready
		$(function() {
			$('#slider').anythingSlider({
				easing: 'easeInOutSine',
				animationTime: 1000,
				buildArrows: false, // If true, builds the forwards and backwards buttons
				buildNavigation: false, // If true, builds a list of anchor links to link to each panel
				buildStartStop: false, // If true, builds the start/stop button and adds slideshow functionality
				// play the video on the first slide
				onInitialized: function(e, slider) {
					var vid = slider.$currentPage.find('video');
					if (vid.length && typeof(vid[0].pause) !== 'undefined') {
						vid[0].play();
						vid[0].onplay = poll(vid);
					}
				},
				// start video again
				onSlideComplete: function(slider) {
					var vid = slider.$currentPage.find('video');
					if (vid.length && typeof(vid[0].pause) !== 'undefined') {
						vid[0].play();
						vid[0].onplay = poll(vid);
					}
					//Reset time of prev video (now that it's out of view)
					var prevVid = slider.$lastPage.find('video');
					if (prevVid.length && typeof(prevVid[0].pause) !== 'undefined') {
						prevVid[0].currentTime = 0;
					}
				},
			});
			//Add the event listener to the current video
			function poll(vid) {
				vid[0].addEventListener('ended', vidEnded, false);

				function vidEnded(e) {
					if (!e) {
						e = window.event;
					}
					$('#slider').data('AnythingSlider').goForward();
				}
			}
		});
	</script>


	<script>
		setInterval(
			function() {
				$('#cek').load('cek.php');
			},
			500);
	</script>
</body>

</html>