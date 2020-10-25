<?php
include 'conn.php';
// memulai session
session_start();
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$cek = mysqli_fetch_array(mysqli_query($con, "SELECT * from user where username='$username' AND password='$password'"));
	$result = $cek ? 1 : 0;
  if($result == 1){
    $_SESSION['username'] = $username;
    header("Location: .");
  }else {
    header("Location: login.php");
  }
} 