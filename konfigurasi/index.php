<html>
<?php
include "conn.php";
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$cek = mysqli_fetch_array(mysqli_query($con, "SELECT * from user where username='$username' AND password='$password'"));
	print_r($cek); 
	$result = $cek ? 1 : 0;
	echo "THIS IS CEK".$result;
} 
?>
<head>
	<?php include 'head.php'; ?>
</head>
<?php include 'control.php'; ?>

<body>
	<?php include 'asides.php'; ?>
	<div class="main-content">
		<div class="menu">
			<div class="container">
				<form method="post">
					<input type="text" name="username"/>
					<input type="text" name="password"/>
					<button type="submit" name="login">CLIKC</button>
				</form>
			</div>
			<img class="arrow left" src="assets/images/demo-arrow-left.png" alt="arrow" height="120">
			<img class="arrow up" src="assets/images/demo-arrow-up.png" alt="arrow" height="150">
		</div>
	</div>
	<?php include 'foot.php'; ?>
</body>

</html>