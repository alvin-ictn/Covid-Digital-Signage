<?php
include './conn.php'; ?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Carlos Alvarez - Alvarez.is">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/mdb.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<!-- Le styles -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/maincsseditet6june.css" rel="stylesheet">
	<link href="assets/css/font-style.css" rel="stylesheet">
	<link href="assets/css/flexslider.css" rel="stylesheet">
	<!---------- CAROUSEL SPECIAL ---------->
	<script type="text/javascript" src="car/jquery.min.js"></script>
	<script type="text/javascript" src="car/bootstrap.min.js"></script>
	<style type="text/css">
		@import url('car/bootstrap-combined.min.css');

		#myCarousel {
			margin-top: 0px;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.carousel-linked-nav,
		.item img {
			display: block;
			margin: 0 auto;
		}

		.carousel-linked-nav {
			width: 120px;
			margin-bottom: 20px;
		}
	</style>

	<?php include 'compiled/flipclock.php' ?>
	<script src="compiled/flipclock.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			var t;
			var start = $('#myCarousel').find('.active').attr('data-interval');
			t = setTimeout("$('#myCarousel').carousel({interval: 1000});", start - 1000);

			$('#myCarousel').on('slid.bs.carousel', function() {
				clearTimeout(t);
				var duration = $(this).find('.active').attr('data-interval');

				$('#myCarousel').carousel('pause');
				t = setTimeout("$('#myCarousel').carousel();", duration - 1000);
			})

			$('.carousel-control.right').on('click', function() {
				clearTimeout(t);
			});

			$('.carousel-control.left').on('click', function() {
				clearTimeout(t);
			});

		});
	</script>
	<script type="text/javascript">
		$(window).load(function() {
			var t;
			var start = $('#myCarousel2').find('.active').attr('data-interval');
			t = setTimeout("$('#myCarousel2').carousel({interval: 1000});", start - 1000);

			$('#myCarousel2').on('slid.bs.carousel', function() {
				clearTimeout(t);
				var duration = $(this).find('.active').attr('data-interval');

				$('#myCarousel2').carousel('pause');
				t = setTimeout("$('#myCarousel2').carousel();", duration - 1000);
			})

			$('.carousel-control.right').on('click', function() {
				clearTimeout(t);
			});

			$('.carousel-control.left').on('click', function() {
				clearTimeout(t);
			});

		});
	</script>
	<script type="text/javascript">
		$(window).load(function() {
			var t;
			var start = $('#myCarousel3').find('.active').attr('data-interval');
			t = setTimeout("$('#myCarousel3').carousel({interval: 1000});", start - 1000);

			$('#myCarousel3').on('slid.bs.carousel', function() {
				clearTimeout(t);
				var duration = $(this).find('.active').attr('data-interval');

				$('#myCarousel3').carousel('pause');
				t = setTimeout("$('#myCarousel3').carousel();", duration - 1000);
			})

			$('.carousel-control.right').on('click', function() {
				clearTimeout(t);
			});

			$('.carousel-control.left').on('click', function() {
				clearTimeout(t);
			});

		});
	</script>
	<script type="text/javascript">
		$(window).load(function() {
			var t;
			var start = $('#myCarousel4').find('.active').attr('data-interval');
			t = setTimeout("$('#myCarousel4').carousel({interval: 1000});", start - 1000);

			$('#myCarousel4').on('slid.bs.carousel', function() {
				clearTimeout(t);
				var duration = $(this).find('.active').attr('data-interval');

				$('#myCarousel4').carousel('pause');
				t = setTimeout("$('#myCarousel4').carousel();", duration - 1000);
			})

			$('.carousel-control.right').on('click', function() {
				clearTimeout(t);
			});

			$('.carousel-control.left').on('click', function() {
				clearTimeout(t);
			});

		});
	</script>
	<script type="text/javascript">
		$(window).load(function() {
			var t;
			var start = $('#myCarousel5').find('.active').attr('data-interval');
			t = setTimeout("$('#myCarousel5').carousel({interval: 1000});", start - 1000);

			$('#myCarousel5').on('slid.bs.carousel', function() {
				clearTimeout(t);
				var duration = $(this).find('.active').attr('data-interval');

				$('#myCarousel5').carousel('pause');
				t = setTimeout("$('#myCarousel5').carousel();", duration - 1000);
			})

			$('.carousel-control.right').on('click', function() {
				clearTimeout(t);
			});

			$('.carousel-control.left').on('click', function() {
				clearTimeout(t);
			});

		});
	</script>
	<!------END CAR----->
	<style>
		div.zoomed {
			zoom: 3;
			-moz-transform: scale(3);
			-moz-transform-origin: 0 0;
		}
	</style>
	<link rel="shortcut icon" href="assets/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

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
	</script>

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

		.menu {
			grid-area: 2 / 2 / 4 / 3;
			background: yellow;
		}

		div[class$="content"] {
			background: white;
			width: 100%;
			height: 100%;
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
			font-size: 1.2rem
		}

		.menu--content>* {
			background: grey;
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

<?php $datamain = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `konfigurasi`")); ?>

<body style="background: #<?php echo $datamain[3] ?>">
	<div class="grid-container">
		<div class="profile">
			<div class="profile--content">
				<img src="./assets/images/logo.png" />
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
				<div class="menu--content--item" id="#mytime"><?php echo date("d F Y H:i:s");?></div>
				<div class="menu--content--item">
					<div class="menu--content--item--title">Konfirmasi</div>
					<div class="menu--content--item--info">12321321</div>
				</div>
				<script>
					let numDay = new Date().getDay();
					let numMonth = new Date().getMonth();
					let dateData = {
						days: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
						months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember' ]
					}
					let timeDOM = document.querySelector('#mytime');

				</script>
				<div class="menu--content--item">
					<div class="menu--content--item--title">Isolasi</div>
					<div class="menu--content--item--info">12321321</div>
				</div>
				<div class="menu--content--item">
					<div class="menu--content--item--title">Rawat</div>
					<div class="menu--content--item--info">12321321</div>
				</div>
				<div class="menu--content--item">
					<div class="menu--content--item--title">Sembuh</div>
					<div class="menu--content--item--info">12321321</div>
				</div>
				<div class="menu--content--item">
					<div class="menu--content--item--title">Meninggal</div>
					<div class="menu--content--item--info">12321321</div>
				</div>
				<div class="menu--content--item">10:20:30</div>
			</div>
		</div>
	</div>


	</head>
	<link rel="stylesheet" href="style_slider.css">
	<script src="js/jquery.anythingslider.js"></script>
	<script src="js/jquery.easing.1.2.js"></script>

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
	<div id="cek">

	</div>

	<script>
		setInterval(
			function() {
				$('#cek').load('cek.php');

			},
			500);
	</script>


	<!------------------ FLIP CLOCK -->
	<script type="text/javascript">
		var clock;

		$(document).ready(function() {
			clock = $('.clock').FlipClock({
				clockFace: 'TwentyFourHourClock',
				showSeconds: false
			});
		});
	</script>

	<!-- NOTY JAVASCRIPT -->
	<script type="text/javascript" src="assets/js/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/top.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topLeft.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topRight.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topCenter.js"></script>

	<!-- You can add more layouts if you want -->
	<script type="text/javascript" src="assets/js/noty/themes/default.js"></script>
	<!-- <script type="text/javascript" src="assets/js/dash-noty.js"></script> This is a Noty bubble when you init the theme-->

	<script src="assets/js/jquery.flexslider.js" type="text/javascript"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/script.js"></script>

	<script>
		function enableAutoplay() {
			$(".panel").children()[0].autoplay = true;
			$(".panel").children()[0].load();
			console.log($(".panel").children()[0].load());
			console.log($(".panel").children()[0].autoplay);
		}

		function toggleMute() {
			var video = $(".panel").children()[0];
			if (video.muted) {
				video.muted = false;
				video.play()
			} else {

				video.muted = true;
				video.play()
			}
			console.log(video.muted)
		}
		$(document).ready(function() {
			var interval = setInterval(function() {
				var momentNow = moment().locale("id");
				$("#date-part").html(momentNow.format("DD "));
				$("#day-part").html(
					momentNow
					.format("dddd")
					.substring(0, 3)
					.toUpperCase()

				);

				$("#month-part").html(momentNow.format("DD MMMM"));
			}, 100);


		});
	</script>

	<script>
		var date = new Date();
		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();
		var monthNames = ["Januari", "Februari", "Maret", "April", "Mai", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"];
		var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];

		var monthLabel = document.getElementsByClassName("month-label")[0].innerHTML = monthNames[date.getMonth()];

		var dayLabel = document.getElementsByClassName("day-label")[0].innerHTML = day;

		var weekdayLabel = document.getElementsByClassName("weekday-label")[0].innerHTML = dayNames[date.getDay(0)];
	</script>
	<!--Carousel Wrapper-->

	<!-- /Start your project here-->

	<!-- SCRIPTS -->
	<!-- JQuery -->

	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->

	<!-- MDB core JavaScript -->

</body>

</html>