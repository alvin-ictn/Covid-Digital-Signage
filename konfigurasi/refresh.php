<?php
	include './conn.php';
	$id = 1;
    $refresh = 1;
    mysqli_query($con, "UPDATE `ref` SET `refresh`='$refresh' WHERE id=$id");
	
    header('Location: index.php');
?>