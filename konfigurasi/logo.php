<?php
include './conn.php';
include 'head.php';

if (isset($_POST['tambahslide'])) {
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		$lokasi = 'C:/xampp/htdocs/darq/konfigurasi/gambar/slide-kanan-bawah/';
	} else {
		$lokasi = '/var/www/konfigurasi/gambar/slide-kanan-bawah/';
	}
	$judul = basename($_FILES['gambar']['name']);
	$uploadfile = $lokasi . $judul;
	if (file_exists($uploadfile)) {
		echo "<div class='alert alert-danger' role='alert' style='width:70%;float:none;margin:0 auto;'>
<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
<strong>Terjadi Kesalahan!</strong> File sejenisnya sudah ada!</div>";
	} else {
		if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)) {
			$keterangan = $_POST['keterangan'];
			mysqli_query($con, "INSERT INTO `kanan_bawah`(`keterangan`,`judul`) VALUES ('$keterangan','$judul')");
		}
	}
} elseif (isset($_POST['edit'])) {
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		$lokasi = 'C:/xampp/htdocs/darq/konfigurasi/gambar/slide-kanan-bawah/';
	} else {
		$lokasi = '/var/www/konfigurasi/gambar/slide-kanan-bawah/';
	}
	$judul = basename($_FILES['gambar']['name']);
	$uploadfile = $lokasi . $judul;
	$id = $_POST['id'];
	$keterangan = $_POST['keterangan'];
	$tmp_judul = mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM kanan_bawah WHERE id=$id"));
	$hapus_slider = $lokasi . $tmp_judul[0];
	if ($judul != NULL) {
		unlink($hapus_slider);
		if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)) {
			mysqli_query($con, "UPDATE `kanan_bawah` SET `keterangan`='$keterangan', `judul`='$judul' WHERE id=$id");
		}
	} else {
		mysqli_query($con, "UPDATE `kanan_bawah` SET `keterangan`='$keterangan' WHERE id=$id");
	}
}
?>
<style>
	.logoContainer {
		width: 400px;
		margin: 15px auto 0 auto;
		/*background: url(http://img1.wikia.nocookie.net/__cb20130901213905/battlebears/images/9/98/Team-icon-placeholder.png) no-repeat 0 0;*/
		padding: 11px 10px 21px 10px;
		text-align: center;
		line-height: 120px;
	}

	.logoContainer img {
		max-width: 100%;
	}

	.fileContainer {
		background: #ccc;
		max-width: 402px;
		height: 31px;
		overflow: hidden;
		position: relative;
		font-size: 16px;
		line-height: 31px;
		color: #434343;
		padding: 0px 41px 0 53px;
		margin: 0 auto 60px auto;
		cursor: pointer !important;
	}

	.fileContainer span {
		overflow: hidden;
		display: block;
		white-space: nowrap;
		text-overflow: ellipsis;
		cursor: pointer;
	}

	.fileContainer input[type="file"] {
		opacity: 0;
		margin: 0;
		padding: 0;
		width: 100%;
		height: 100%;
		left: 0;
		top: 0;
		position: absolute;
		cursor: pointer;
	}
</style>
<?php include 'asides.php' ?>
<div class="mt-5 pt-5 container">
	<form enctype="multipart/form-data" method="post">
		<div class="logoContainer">
			<img src="./placeholder.svg">
		</div>
		<div class="fileContainer sprite">
			<span>choose file</span>
			<input type="file" value="Choose File" accept="image/*">
		</div>
		<button class="btn btn-warning " name="postImage" type="submit">
			Edit
		</button>
	</form>
</div>
<script>
	$("input:file").change(function() {
		var fileName = $(this).val();
		if (fileName.length > 0) {
			$(this).parent().children('span').html(fileName);
		} else {
			$(this).parent().children('span').html("Choose file");
		}
	});
	//file input preview
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('.logoContainer img').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("input:file").change(function() {
		readURL(this);
	});
</script>
<?php include 'foot.php'; ?>