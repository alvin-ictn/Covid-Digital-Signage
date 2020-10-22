<?php
 $con = mysqli_connect('localhost','root','','peternakan');
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
}

elseif (isset ($_GET['logout'])) {
    session_destroy();
    header('Location: ../login.php');
}
?>