<?php
$localhost = 'localhost';
$username = 'root';
$password = '';
$database = 'peternakan';

$dbs = new mysqli($localhost, $username, $password,$database);
if ($dbs->connect_error) {
   die("Connection failed: " . $dbs->connect_error);
}

if(isset($_POST['btn'])){
	if($_POST['teks'] != ""){
	$tk = $_POST['teks'];
	$sql = "INSERT INTO agenda (agenda) VALUES('$tk')";
	$hsl = $dbs->query($sql);
	}
	
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="jquery/css/jquery-ui.css">
<script type="text/javascript" src="jquery/js/jquery-2.2.3.min.js"></script>
<script  type="text/javascript" src="jquery/js/jquery-ui.min.js"></script>
<script  type="text/javascript" src="tes.js"></script>
</head>
<body>
<div>
	<form method="post" action="">
		<input type="text" name="teks" />
		<input type="submit" name="btn" value="submit"/>
	</form>
</div>

<hr>


</body>
</html>