<?php
include './conn.php';
include 'head.php';

if (isset($_POST['postImage'])) {
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		$lokasi = 'C:/xampp/htdocs/covidinfo/konfigurasi/gambar/background/';
	} else {
		$lokasi = '/var/www/html/covidinfo/konfigurasi/gambar/background/';
	}
	$judul = basename($_FILES['gambar']['name']);
	$uploadfile = $lokasi . "bg.png";

	if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)) {
		echo "
		<div class='alert alert-success' role='alert' style='width:70%;float:none;margin:0 auto;'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<strong>Selamat!</strong> Logo Berhasil di upload!</div>";
	}
}
?>
<style>
	.logoContainer {
		width: 400px;
		margin: 15px auto 0 auto;
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
			<img src="<?php if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
									echo './gambar/background/bg.png';
								} else {
									echo './gambar/background/bg.png';
								} ?>">
		</div>
		<div class="fileContainer sprite">
			<span>choose file</span>
			<input type="file" name="gambar" value="Choose File" accept="image/*">
		</div>
		<button class="btn btn-info " name="postImage" type="submit">
			Upload
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