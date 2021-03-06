<style>
	body {
		text-align: center;
	}
</style>
<?php

if (session_status() != 1) {
	session_start();
	if (!isset($_SESSION['username'])) {
		header("Location: login.php");
	}
}

?>
<?php include 'conn.php';
$uri = explode("/", $_SERVER['REQUEST_URI']);
$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `company` WHERE id=1")); ?>
<aside class="sidebar-left-collapse">
	<img style="width:5vw" src="./gambar/logo/logo.png"></img>
	<label class="text-light"><?php echo $data[1] ?></label>
	<div class="sidebar-links">
		<div class="link-blue 
		<?php if ($uri[sizeof($uri) - 1] == "logo.php") {
			echo "selected";
		} ?>">
			<a href="#">
				<i class="fal fa-hand-receiving"></i>Logo
			</a>
			<ul class="sub-links">
				<li><a href="logo.php">Logo Changer</a></li>
			</ul>
		</div>
		<div class="link-blue 
		<?php if ($uri[sizeof($uri) - 1] == "company.php") {
			echo "selected";
		} ?>">
			<a href="#">
				<i class="fas fa-building"></i>Company
			</a>
			<ul class="sub-links">
				<li><a href="company.php">Company Info</a></li>
			</ul>
		</div>
		<div class="link-blue 
		<?php if ($uri[sizeof($uri) - 1] == "time.php") {
			echo "selected";
		} ?>">
			<a href="#">
				<i class="fal fa-alarm-clock"></i>Time
			</a>
			<ul class="sub-links">
				<li><a href="time.php">Set Time</a></li>
			</ul>
		</div>
		<div class="link-red 
		<?php if ($uri[sizeof($uri) - 1] == "background.php") {
			echo "selected";
		} ?>">
			<a href="#">
			<i class="fas fa-image"></i>Background
			</a>
			<ul class="sub-links">
				<li><a href="background.php">Background</a></li>
			</ul>
		</div>
		<div class="link-red 
		<?php if ($uri[sizeof($uri) - 1] == "slider1.php") {
			echo "selected";
		} ?>">
			<a href="#">
				<i class="fa fa-clone"></i>Slider
			</a>
			<ul class="sub-links">
				<li><a href="slider1.php">Slider Utama</a></li>
			</ul>
		</div>
		<div class="link-red 
		<?php if ($uri[sizeof($uri) - 1] == "text.php") {
			echo "selected";
		} ?>">
			<a href="#">
				<i class="fa fa-edit"></i>Berita
			</a>
			<ul class="sub-links">
				<li><a href="text.php">Running Text</a></li>
			</ul>
		</div>
		<div class="link-green <?php if ($uri[sizeof($uri) - 1] == "covid.php") {
															echo "selected";
														} ?>">
			<a href="#">
				<i class="fa fa-bahai"></i> Covid
			</a>
			<ul class="sub-links">
				<li><a href="covid.php">Covid Data</a></li>
			</ul>
		</div>
	<div class="link-green <?php if ($uri[sizeof($uri) - 1] == "user.php") {
														echo "selected";
													} ?>">
			<a href="#">
				<i class="fas fa-user-circle"></i> User
			</a>
			<ul class="sub-links">
				<li><a href="user.php">User Data</a></li>
			</ul>
		</div>
		<!-- <div class="link-green">
			<a href="#">
				<i class="fa fa-cogs"></i>General
			</a>
			<ul class="sub-links">
				<li><a href="clock/clock.php">Color Panel</a></li>
			</ul>
		</div> -->
		<div class="link-yellow">
			<a href="refresh.php">
				<i class="fa fa-check"></i> <span>Apply</span>
			</a>
		</div>
		<div class="link-yellow">
			<a href="logout.php">
				<i class="fas fa-sign-out-alt"></i> <span>Logout</span>
			</a>
		</div>
	</div>
</aside>