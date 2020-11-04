<?php
include './conn.php';
include 'head.php';

if(isset($_POST['waktuset'])){
	$waktu = $_POST['waktu'];
		shell_exec("sudo date -s '".$waktu."'");
		shell_exec("sudo hwclock -D -r");
		shell_exec("sudo hwclock -w");
		
	}
?>
<?php include 'asides.php' ?>
<div class="main-content my-5 pt-5 mr-5">
  <form enctype="multipart/form-data" method="post">
    <label class="my-3 font-weight-bold">Set Time</label>
    <input class="my-5 form-control" name="waktu" placeholder="Tahun-Bulan-Tanggal Jam:Menit:Detik"/>
    <button class="btn btn-info " name="waktuset" type="submit">
      Update Time
    </button>
  </form>
</div>
<?php include 'foot.php'; ?>