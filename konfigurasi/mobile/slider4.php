<?php 
$uri= $_SERVER['REQUEST_URI'];
$uri = explode('/',$uri);

?>
<?php include './conn.php';
function set_progress($val = 0) {
    $data = "<div class='progress-container' style='display:none'>
                <div class='progress'>
                      <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: " . $val . "%'>
                      </div>
                </div>
            </div>";
    return $data;
}

if (isset($_POST['tambahslide'])) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		$lokasi='C:/xampp/htdocs/darq/konfigurasi/gambar/slide-kiri-atas/';
	} else {
		$lokasi='/var/www/konfigurasi/gambar/slide-kiri-atas/';
	}
    $judul=basename($_FILES['gambar']['name']);
    $uploadfile=$lokasi.$judul;
	if (file_exists($uploadfile)) {
		echo "<div class='alert alert-danger' role='alert' style='width:70%;float:none;margin:0 auto;'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>Terjadi Kesalahan!</strong> File sejenisnya sudah ada!</div>";
	} else {
		if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)){
		$keterangan = $_POST['keterangan'];
		mysqli_query($con,"INSERT INTO `kiri_atas`(`keterangan`,`judul`) VALUES ('$keterangan','$judul')");
		}
	}  
}
elseif (isset($_POST['hapusslider'])) {
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		$lokasi='C:/xampp/htdocs/darq/konfigurasi/gambar/slide-kiri-atas/';
	} else {
		$lokasi='/var/www/konfigurasi/gambar/slide-kiri-atas/';
	}
    $id=$_POST['id'];   
	
    $tmp_judul=mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM kiri_atas WHERE id=$id"));
    $hapus=$lokasi.$tmp_judul[0];
    unlink($hapus);
    mysqli_query($con,"delete FROM `kiri_atas` WHERE id=$id");
    
}

elseif (isset($_POST['edit'])) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		$lokasi='C:/xampp/htdocs/darq/konfigurasi/gambar/slide-kiri-atas/';
	} else {
		$lokasi='/var/www/konfigurasi/gambar/slide-kiri-atas/';
	}
    $judul=basename($_FILES['gambar']['name']);
    $uploadfile=$lokasi.$judul;
    $id=$_POST['id'];
    $keterangan = $_POST['keterangan'];
    $tmp_judul=mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM kiri_atas WHERE id=$id"));
    $hapus_slider=$lokasi.$tmp_judul[0];
    if ($judul!=NULL){
        unlink($hapus_slider);   
		if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)){
			mysqli_query($con, "UPDATE `kiri_atas` SET `keterangan`='$keterangan', `judul`='$judul' WHERE id=$id");
		}
    }
    else{
        mysqli_query($con, "UPDATE `kiri_atas` SET `keterangan`='$keterangan' WHERE id=$id");
    }
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


	<?php include "head.php";?>
	<?php include "control.php";?>
    
	
	
	<link rel="stylesheet" href="../conditional/bootstrap-iso.css">
    <!-- Font Awesome JS -->
    
</head>
<style>


.modal-backdrop {
  z-index: -1;
}


</style>
<body><?php
include 'modalslide2.php';
include 'deleteslide2.php';
include 'editslide2.php'; ?>
    <div class="wrapper">
        <!-- Sidebar  -->
		<?php include "side.php";?>

        <!-- Page Content  -->
        <div id="content">
			
			<button type="button" id="sidebarCollapse" class="btn btn-info">
				<i class="fas fa-align-left"></i>
				<span>Menu</span>
			</button><b>&nbsp&nbsp&nbsp&nbsp&nbspSlide Kiri Atas</b>
			<br><br><button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#tambah-data-gambar"><i class="glyphicon glyphicon-plus"></i> Slider Gambar</button>
			<div class="main-content">
				<table class="table" id="datatable-editable">
			<thead>
				<tr>
					<th>Id</th>
					<th>keterangan</th>
					<th>View</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$query = mysqli_query($con, "SELECT * FROM kiri_atas");
				$y=0;
				while ($row1 = mysqli_fetch_array($query)) {
					$y=$y+1;
					?>
					<tr class="gradeX">
						<td style="vertical-align: middle;"><?php echo $y; ?></td>
						<td style="vertical-align: middle;"><?php echo $row1[1]; ?></td>
						<td style="vertical-align: middle;"><img src="../gambar/slide-kiri-atas/<?php echo $row1[2];?>" class="img-responsive" width="100vw"></td>
						<td style="vertical-align: middle;"><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>"
								data-toggle="modal" data-target="#delete-slider">
								<i class="glyphicon glyphicon-trash">
								</i>
							</a> 
							<a  class="btn btn-xs btn-warning" href="javascript:;"
								data-id="<?php echo $row1[0]; ?>"
								data-keterangan="<?php echo $row1[1]; ?>"
								data-judul="<?php echo $row1[2]; ?>"
								data-toggle="modal" data-target="#edit-slider">
								<i class="glyphicon glyphicon-edit"></i>
							</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
				</div>
			</div>  

            
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
<script src="../assets/js/bootstrap.js"></script>
</html>