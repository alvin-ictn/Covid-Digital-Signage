<?php
include './conn.php';

$result = mysqli_query($con,"delete FROM `agenda` WHERE `jadwal_selesai` <= CURDATE()") or die("Error connecting to database!");

?>