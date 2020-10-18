<?php
include_once("./conn.php");
if(isset($_POST['change_color'])) {
	$background = $_POST['background'];
	mysqli_query($con,"UPDATE `main` set `flip_clock_1`='$background' WHERE `main`.`id` = 1");
}

if(isset($_POST['change_color2'])) {
	$background2 = $_POST['background2'];
	mysqli_query($con,"UPDATE `main` set `flip_clock_2`='$background2', `flip_clock_3`='$background2' WHERE `main`.`id` = 1");
}

if(isset($_POST['change_color3'])) {
	$background3 = $_POST['background3'];
	mysqli_query($con,"UPDATE `konfigurasi` set `clockcolor`='$background3' WHERE `konfigurasi`.`id` = 1");
}

if(isset($_POST['resets'])) {
	$background = $_POST['background'];
	$background2 = $_POST['background2'];
	$background3 = $_POST['background3'];
	mysqli_query($con,"UPDATE `main` set `flip_clock_1`='$background', `flip_clock_2`='$background2', `flip_clock_3`='$background2' WHERE `main`.`id` = 1");
	mysqli_query($con,"UPDATE `konfigurasi` set `clockcolor`='$background3' WHERE `konfigurasi`.`id` = 1");
}
?>