<script type="text/javascript">
var cek =  <?php
	include './conn.php';
	$pilihan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `ref`"));
	// echo $pilihan['refresh'];
	if ($pilihan[1]==1){
		$id = 1;
	    $refresh = 0;
	    mysqli_query($con, "UPDATE `ref` SET `refresh`='$refresh' WHERE id=$id");
		// header('Location: ashar.php');
		// return 5;
		echo "1";
	}else {
		echo "0";
	}
?>;


if (cek==1){
	window.location.href="routing.php";
}
</script>