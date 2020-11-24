<?php include './conn.php';
$config['assetsdir'] = "/gambar";
$config['mainslidedir'] = "/slide-utama";
$config['prefixname'] = "sliderUtama24112020";

function set_progress($val = 0)
{
	$data = "
	<div class='progress-container' style='display:none'>
		<div class='progress'>
			<div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: " . $val . "%'>
			</div>
		</div>
	</div>";
	return $data;
}

$lokasi = getcwd() . $config['assetsdir'] . $config['mainslidedir'] . "/";

$getSliderData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `slider` ORDER BY ID DESC LIMIT 1"));
$num = $getSliderData['id'] + 1;

if (isset($_POST['tambahslide'])) {
	$judul = basename($_FILES['gambar']['name']) or $judul = basename($_FILES['video']['name']);
	if (strlen(basename($_FILES['gambar']['type'])) > 1) {
		$extension = basename($_FILES['gambar']['type']);
	} else {
		$extension = basename($_FILES['video']['type']);
	}

	$newTitle = $config['prefixname'] . $num;
	$pathFile = $lokasi . $newTitle;
	$fullFile = $newTitle . "." . $extension;
	$fullPath = $pathFile . "." . $extension;
	$keterangan = $_POST['keterangan'];
	// $uploadfile = $lokasi . $config['prefixname'] . $num . "." . $extension;
	// $without_extension = substr($judul, 0, strrpos($judul, "."));
	// $uploadfile2 = $lokasi . $config['prefixname'] . $num;
	if (file_exists($fullPath)) {
		echo "<div class='alert alert-danger' role='alert' style='top:10%;width:70%;float:none;margin:0 auto;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Terjadi Kesalahan!</strong> File sejenisnya sudah ada!</div>";
	} else {
		if (move_uploaded_file($_FILES['gambar']['tmp_name'], $fullPath)) {
			// $image_properties = getimagesize($fullPath);
			// $width_image = $image_properties[0];
			// $height_image = $image_properties[1];
			$durasi = $_POST['durasi'];
			$duration = $durasi / 1000;
			$tipe = 1;
			exec("ffmpeg -loop 1 -i " . $fullPath . " -c:v libx264 -t " . $duration . " -pix_fmt yuv420p -vf scale=1280:720 " . $pathFile . ".mp4");
			$judul_konversi = $newTitle . ".mp4";
			mysqli_query($con, "INSERT INTO `slider`(`keterangan`,`judul`,`judul_konversi`,`tipe`,`durasi`) VALUES ('$keterangan','$judul_konversi','$fullFile',$tipe,'$durasi')");
			echo "<div class='alert alert-success' role='alert' style='top:10%;width:70%;float:none;margin:0 auto;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Berhasil!</strong> File Telah diupload!</div>";
		} else if (move_uploaded_file($_FILES['video']['tmp_name'], $fullPath)) {
			$time = exec("ffprobe -i " . $fullPath . " -show_entries format=duration -v quiet -of csv=\"p=0\"", $output);
			$tumnel = $time / 2;
			$durasi = $time * 1000;
			exec("ffmpeg -i " . $fullPath . " -ss " . $tumnel . " -vframes 1 " . $pathFile . ".png");
			$judul_konversi = $newTitle . ".png";
			
			$tipe = 2;
			mysqli_query($con, "INSERT INTO `slider`(`keterangan`,`judul`,`judul_konversi`,`tipe`,`durasi`) VALUES ('$keterangan','$fullFile','$judul_konversi',$tipe,'$durasi')");
			echo "<div class='alert alert-success' role='alert' style='top:10%;width:70%;float:none;margin:0 auto;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Berhasil!</strong> File Telah diupload!</div>";
		}
	}
} elseif (isset($_POST['hapusslider'])) {
	$id = $_POST['id'];
	$tmp_judul = mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM slider WHERE id=$id"));
	$tmp_judul2 = mysqli_fetch_array(mysqli_query($con, "SELECT judul_konversi FROM slider WHERE id=$id"));
	$hapus = $lokasi . $tmp_judul[0];
	$hapus2 = $lokasi . $tmp_judul2[0];
	if (file_exists($hapus)) {
		unlink($hapus);
		unlink($hapus2);
		echo "<div class='alert alert-success' role='alert' style='top:10%;width:70%;float:none;margin:0 auto;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Berhasil!</strong> File Telah dihapus!</div>";
	} else {
		echo "<div class='alert alert-danger' role='alert' style='top:10%;width:70%;float:none;margin:0 auto;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Terjadi Kesalahan!</strong> File yang sama sudah dihapus!</div>";
	}
	mysqli_query($con, "delete FROM `slider` WHERE id=$id");
} elseif (isset($_POST['editgambar'])) {
	$judul = basename($_FILES['gambar']['name']);
	echo $judul;
	echo "WORK HEREEEEEEEE";
	$uploadfile = $lokasi . $judul;
	echo $uploadfile;
	$id = $_POST['id'];
	$keterangan = $_POST['keterangan'];
	$without_extension = substr($judul, 0, strrpos($judul, "."));
	$uploadfile2 = $lokasi . $without_extension;
	$tmp_judul = mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM slider WHERE id=$id"));
	$tmp_judul2 = mysqli_fetch_array(mysqli_query($con, "SELECT judul_konversi FROM slider WHERE id=$id"));
	$hapus_slider = $lokasi . $tmp_judul[0];
	$hapus_slider2 = $lokasi . $tmp_judul2[0];
	if ($judul != NULL) {
		if (file_exists($uploadfile)) {
			echo "<div class='alert alert-danger' role='alert' style='top:10%;width:70%;float:none;margin:0 auto;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Terjadi Kesalahan!</strong> File sejenisnya sudah ada!</div>";
		} else {
			unlink($hapus_slider);
			unlink($hapus_slider2);
			if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)) {
				$image_properties = getimagesize($uploadfile);
				$width_image = $image_properties[0];
				$height_image = $image_properties[1];
				$keterangan = $_POST['keterangan'];
				$durasi = $_POST['durasi'];
				$duration = $durasi / 1000;
				exec("ffmpeg -loop 1 -i " . $uploadfile . " -c:v libx264 -t " . $duration . " -pix_fmt yuv420p -vf scale=" . $width_image . ":" . $height_image . " " . $uploadfile2 . ".mp4");
				$judul_konversi = $without_extension . ".mp4";
				mysqli_query($con, "UPDATE `slider` SET `keterangan`='$keterangan', `judul`='$judul_konversi', `judul_konversi`='$judul'  WHERE id=$id");
				echo "<div class='alert alert-primary' role='alert' style='top:10%;width:70%;float:none;margin:0 auto;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Berhasil!</strong> Slider Telah diganti!</div>";
			}
		}
	} else {
		unlink($hapus_slider);
		$tmp_judul = mysqli_fetch_array(mysqli_query($con, "SELECT judul_konversi FROM slider WHERE id=$id"));
		$uploadfile = $lokasi . $tmp_judul[0];
		$without_extension = substr($tmp_judul[0], 0, strrpos($tmp_judul[0], "."));
		$image_properties = getimagesize($uploadfile);
		$width_image = $image_properties[0];
		$height_image = $image_properties[1];

		$uploadfile2 = $lokasi . $without_extension;
		$keterangan = $_POST['keterangan'];
		$durasi = $_POST['durasi'];
		$duration = $durasi / 1000;
		exec("ffmpeg -loop 1 -i " . $uploadfile . " -c:v libx264 -t " . $duration . " -pix_fmt yuv420p -vf scale=" . $width_image . ":" . $height_image . " " . $uploadfile2 . ".mp4");
		$judul_konversi = $without_extension . ".mp4";
		mysqli_query($con, "UPDATE `slider` SET `keterangan`='$keterangan',`durasi`='$durasi' WHERE id=$id");
		echo "<div class='alert alert-primary' role='alert' style='top:10%;width:70%;float:none;margin:0 auto;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Berhasil!</strong> Deskripsi slider Telah diganti!</div>";
	}
} elseif (isset($_POST['editvideo'])) {
	$judul = basename($_FILES['video']['name']);
	$uploadfile = $lokasi . $judul;
	$without_extension = substr($judul, 0, strrpos($judul, "."));
	$uploadfile2 = $lokasi . $without_extension;
	$id = $_POST['id'];
	$keterangan = $_POST['keterangan'];
	$tmp_judul = mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM slider WHERE id=$id"));
	$tmp_judul2 = mysqli_fetch_array(mysqli_query($con, "SELECT judul_konversi FROM slider WHERE id=$id"));
	$hapus_slider = $lokasi . $tmp_judul[0];
	$hapus_slider2 = $lokasi . $tmp_judul2[0];
	if ($judul != NULL) {
		if (file_exists($uploadfile)) {
			echo "<div class='alert alert-danger' role='alert' style='top:10%;width:70%;float:none;margin:0 auto;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Terjadi Kesalahan!</strong> File sejenisnya sudah ada!</div>";
		} else {
			unlink($hapus_slider);
			unlink($hapus_slider2);
			if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadfile)) {
				$time = exec("ffprobe -i " . $uploadfile . " -show_entries format=duration -v quiet -of csv=\"p=0\"", $output);
				$tumnel = $time / 2;
				$durasi = $time * 1000;
				exec("ffmpeg -i " . $uploadfile . " -ss " . $tumnel . " -vframes 1 " . $uploadfile2 . ".png");
				$judul_konversi = $without_extension . ".png";
				$keterangan = $_POST['keterangan'];
				mysqli_query($con, "UPDATE `slider` SET `keterangan`='$keterangan', `durasi`='$durasi', `judul`='$judul',`judul_konversi`='$judul_konversi' WHERE id=$id");
			}
		}
	} else {
		mysqli_query($con, "UPDATE `slider` SET `keterangan`='$keterangan' WHERE id=$id");
	}
}
?>
<html>

<head>
	<?php include 'head.php'; ?>
	<?php include 'control.php'; ?>
</head>
<link rel="stylesheet" href="conditional/bootstrap-iso.css">
</head>
<style>
	.modal-open,
	body,
	.navbar-fixed-top,
	.navbar-fixed-bottom {
		padding-right: 0px !important;
		margin-right: 0px !important
	}
</style>

<body>
	<?php
	include 'asides.php';
	include 'modalslide1.php';
	include 'deleteslide1.php';
	include 'editslide1.php'; ?>

	<h1>Slider Utama</h1>
	<button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#tambah-data-gambar"><i class="glyphicon glyphicon-plus"></i> Slider Gambar</button>
	<div class="main-content">
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Id</th>
						<th>keterangan</th>
						<th>View</th>
						<th>durasi(ms)</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = mysqli_query($con, "SELECT * FROM slider");
					$y = 0;
					while ($row1 = mysqli_fetch_array($query)) {
						$y = $y + 1;
					?>
						<tr class="gradeX">
							<td style="vertical-align: middle;"><?php echo $y; ?></td>

							<td style="vertical-align: middle;"><?php echo $row1[1]; ?></td>
							<?php $b = $row1[4];
							$c = "";
							if ($b == 1) { ?>
								<td style="vertical-align: middle;"><img src="gambar/slide-utama/<?php echo $row1[3]; ?>" class="img-responsive" width="100vw"></td><?php
																																																																									} elseif ($b == 2) {
																																																																										?>
								<td style="vertical-align: middle;"><img src="gambar/slide-utama/<?php echo $row1[3]; ?>" class="img-responsive" width="100vw"></td><?php
																																																																									} ?>
							<td style="vertical-align: middle;"><?php echo $row1[5]; ?></td>
							<td style="vertical-align: middle;"><a class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>" data-toggle="modal" data-target="#delete-slider">
									<i class="glyphicon glyphicon-trash">
									</i>
								</a>
								<a class="btn btn-xs btn-warning" href="javascript:;" data-id="<?php echo $row1[0]; ?>" data-keterangan="<?php echo $row1[1]; ?>" data-judul="<?php echo $row1[2]; ?>" <?php if ($b == 1) { ?> data-durasi="<?php echo $row1[5]; ?>" <?php } else {
																																																																																																																										} ?> data-toggle="modal" data-target="<?php
																																																																																																																																													if ($b == 1) {
																																																																																																																																														echo "#edit-slide-gambar";
																																																																																																																																													} elseif ($b == 2) {
																																																																																																																																														echo "#edit-slide-video";
																																																																																																																																													}
																																																																																																																																													?>">
									<i class="glyphicon glyphicon-edit"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php include 'foot.php'; ?>

</body>

</html>