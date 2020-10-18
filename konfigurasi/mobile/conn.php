<?php
 $con = mysqli_connect('localhost','root','','peternakan') OR die(mysql_error());
?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
	
    header('Location: ../../login.php');
}

elseif (isset ($_GET['logout'])) {
    session_destroy();
    header('Location: ../../login.php');
}
?>