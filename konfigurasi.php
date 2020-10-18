<?php
include './conn.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

elseif (isset ($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
}
function set_progress($val = 0) {

    $data = "<div class='progress-container' style='display:none'>
            
                <div class='progress'>
                      <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: " . $val . "%'>
                      </div>
                </div>

            </div>";

    return $data;
}
if (isset($_POST['btn-save'])) {
    $jarak = $_POST['jarak'];
	$color1 = $_POST['color1'];
	$color2 = $_POST['color2'];
	$clockcolor = $_POST['clockcolor'];
	$textcolor = $_POST['textcolor'];
    mysqli_query($con,"UPDATE `konfigurasi` SET `jarak`='$jarak',`color1`='$color1',`color2`='$color2',`clockcolor`='$clockcolor',`textcolor`='$textcolor' WHERE id=1");
}
if (isset($_POST['addberita'])) {
    $info = $_POST['info'];
    mysqli_query($con,"INSERT INTO `berita`(`info`) VALUES ('$info')");
} elseif (isset($_POST['hapusberita'])) {
    $id=$_POST['id'];
    mysqli_query($con,"delete FROM `berita` WHERE id=$id");
}  elseif (isset($_POST['editberita'])) {
    $id=$_POST['id'];
    $info = $_POST['info'];
    mysqli_query($con, "UPDATE `berita` SET `info`='$info' WHERE id=$id");
}  

//** UNTUK PEGAWAI **//
if (isset($_POST['addpegawai'])) {
    $Nama = $_POST['Nama'];
	$Jabatan = $_POST['Jabatan'];
	$Nomor = $_POST['Nomor'];
    mysqli_query($con,"INSERT INTO `Pegawai`(`Nama`,`Jabatan`,`Nomor`) VALUES ('$Nama','$Jabatan','$Nomor')");
} elseif (isset($_POST['hapuspegawai'])) {
    $id=$_POST['id'];
    mysqli_query($con,"delete FROM `Pegawai` WHERE id=$id");
}  elseif (isset($_POST['editpegawai'])) {
    $id=$_POST['id'];
    $Nama = $_POST['Nama'];
	$Jabatan = $_POST['Jabatan'];
	$Nomor = $_POST['Nomor'];
    mysqli_query($con, "UPDATE `Pegawai` SET `Nama`='$Nama', `Jabatan`='$Jabatan', `Nomor`='$Nomor' WHERE id=$id");
}

//** UNTUK AGENDA **//
if (isset($_POST['addagenda'])) {
    $agenda = $_POST['agenda'];
	$status = $_POST['status'];
    mysqli_query($con,"INSERT INTO `Agenda`(`agenda`,`status`) VALUES ('$agenda','$status')");
} elseif (isset($_POST['hapusagenda'])) {
    $id=$_POST['id'];
    mysqli_query($con,"delete FROM `Agenda` WHERE id=$id");
}  elseif (isset($_POST['editagenda'])) {
    $id=$_POST['id'];
    $agenda = $_POST['agenda'];
	$status = $_POST['status'];
    mysqli_query($con, "UPDATE `Agenda` SET `agenda`='$agenda', `status`='$status' WHERE id=$id");
}
/** UNTUK SLIDER**/
if (isset($_POST['add_slider'])) {
    $lokasi='/var/www/gambar/';
    $judul=basename($_FILES['gambar']['name']);
	$tipe=2;
	$durasi=$_POST['durasi'];
    $uploadfile=$lokasi.$judul;
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)){
    $keterangan = $_POST['keterangan'];
    // $judul = $_POST['judul'];
    mysqli_query($con,"INSERT INTO `slider`(`keterangan`,`judul`,`tipe`,`durasi`) VALUES ('$keterangan','$judul',$tipe,'$durasi')");
    }
} elseif (isset($_POST['addt'])) {
    $judul=$_POST['judul'];
    $tipe=1;
    $keterangan = $_POST['keterangan'];
	$durasi=$_POST['durasi'];
    mysqli_query($con,"INSERT INTO `slider`(`keterangan`,`judul`,`tipe`,`durasi`) VALUES ('$keterangan','$judul',$tipe,'$durasi')");
} elseif (isset($_POST['addvid_slider'])) {
    $lokasi='/var/www/gambar/';
    $judul=basename($_FILES['video']['name']);
    $tipe=3;
	$durasi=$_POST['durasi'];
    $uploadfile=$lokasi.$judul;
    if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadfile)){
    $keterangan = $_POST['keterangan'];
    // $judul = $_POST['judul'];
    mysqli_query($con,"INSERT INTO `slider`(`keterangan`,`judul`,`tipe`,`durasi`) VALUES ('$keterangan','$judul',$tipe,'$durasi')");
    }
}
elseif (isset($_POST['hapus_slider'])) {
    $id=$_POST['id'];
    // supaya file foto di folder terhapus
    $tmp_judul=mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM slider WHERE id=$id"));
    $lokasi='/var/www/gambar/';
    $hapus_slider=$lokasi.$tmp_judul[0];
    unlink($hapus_slider);
    // =================================
    mysqli_query($con,"delete FROM `slider` WHERE id=$id");
    
}elseif (isset($_POST['hapust'])) {
    $id=$_POST['id'];
    // supaya file foto di folder terhapus
    mysqli_query($con,"delete FROM `slider` WHERE id=$id");
    
}elseif(isset($_POST['editt'])){
    $id=$_POST['id'];
    $judul=$_POST['judul'];
    $keterangan = $_POST['keterangan'];
	$durasi=$_POST['durasi'];
    mysqli_query($con, "UPDATE `slider` SET `keterangan`='$keterangan', `judul`='$judul',`durasi`='$durasi' WHERE id=$id");

}elseif (isset($_POST['edit'])) {
    $lokasi='/var/www/gambar/';
    $judul=basename($_FILES['gambar']['name']);
    $uploadfile=$lokasi.$judul;
    $id=$_POST['id'];
    $keterangan = $_POST['keterangan'];
	$durasi=$_POST['durasi'];
    // echo $id."-".$keterangan."-".$judul;
    // supaya file foto di folder terhapus
    $tmp_judul=mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM slider WHERE id=$id"));
    $lokasi='/var/www/gambar/';
    $hapus_slider=$lokasi.$tmp_judul[0];
    if ($judul!=NULL){
        unlink($hapus_slider);
        // =================================
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)){
        mysqli_query($con, "UPDATE `slider` SET `keterangan`='$keterangan', `judul`='$judul',`durasi`='$durasi' WHERE id=$id");
    }
    }
    else{
        mysqli_query($con, "UPDATE `slider` SET `keterangan`='$keterangan',`durasi`='$durasi' WHERE id=$id");
    }
}elseif (isset($_POST['editvid'])) {
    $lokasi='/var/www/gambar/';
    $judul=basename($_FILES['video']['name']);
    $uploadfile=$lokasi.$judul;
    $id=$_POST['id'];
    $keterangan = $_POST['keterangan'];
	$durasi=$_POST['durasi'];
    // echo $id."-".$keterangan."-".$judul;
    // supaya file foto di folder terhapus
    $tmp_judul=mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM slider WHERE id=$id"));
    $lokasi='/var/www/gambar/';
    $hapus_slider=$lokasi.$tmp_judul[0];
    if ($judul!=NULL){
        unlink($hapus_slider);
        // =================================
    if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadfile)){
        mysqli_query($con, "UPDATE `slider` SET `keterangan`='$keterangan', `judul`='$judul',`durasi`='$durasi' WHERE id=$id");
    }
    }
    else{
        mysqli_query($con, "UPDATE `slider` SET `keterangan`='$keterangan',`durasi`='$durasi' WHERE id=$id");
    }
}

?>
<!doctype html>
<html><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
<!-- 
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    Bootstrap core CSS -->
	<link href="css/buttons.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->

    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
	
    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/font-style.css" rel="stylesheet">
    <link href="assets/css/flexslider.css" rel="stylesheet">
 
	<script type="text/javascript" src="js/jquery-latest.js"></script><!---CLOCK JS-->
	<script type="text/javascript">
		function date_time(id)
		{
			date = new Date;
			year = date.getFullYear();
			month = date.getMonth();
			months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
			d = date.getDate();
			day = date.getDay();
			days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum`at', 'Sabtu');
			h = date.getHours();
			if(h<10)
			{
					h = "0"+h;
			}
			m = date.getMinutes();
			if(m<10)
			{
					m = "0"+m;
			}
			s = date.getSeconds();
			if(s<10)
			{
					s = "0"+s;
			}
			data = ''+days[day]+', '+d+' '+months[month]+' '+year;
			data2 = ''+h+':'+m+':'+s;
			document.getElementById(id).innerHTML = data+"<br>"+data2;
			setTimeout('date_time("'+id+'");','1000');
			return true;
		}
	</script>
 
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

  	<!-- Google Fonts call. Font Used Open Sans & Raleway
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
  	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"> -->

<script type="text/javascript">
$(document).ready(function () {

    $("#btn-blog-next").click(function () {
      $('#blogCarousel').carousel('next')
    });
     $("#btn-blog-prev").click(function () {
      $('#blogCarousel').carousel('prev')
    });

     $("#btn-client-next").click(function () {
      $('#clientCarousel').carousel('next')
    });
     $("#btn-client-prev").click(function () {
      $('#clientCarousel').carousel('prev')
    });
    
});

 $(window).load(function(){

    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
    });  
});

</script>

</head>
<div class="col-xs-12 col-md-12" style="margin-bottom:10px">
<center>
    <a href="?logout=true" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-arrow-left"></i> OUT</a>
</center>
</div>
<body>
<div class="container">
<!------------------------- BERITA MAIN FORM ----------------------->
	<div class="col-xs-6 col-md-6">
		<div class="half-unit" style="height:auto">
			<dtitle>Informasi</dtitle>
			<hr>
			<div class="">
				<?php
				$cek= mysqli_fetch_array(mysqli_query($con, "SELECT count(info) FROM berita"));
				if ($cek[0]<7){
				?>
				<button class="btn btn-success waves-light" data-id='0' data-toggle="modal" data-target="#tambah-databerita"><b><i class="glyphicon glyphicon-plus"></i></b> Tambah Berita</button>
				<?php
				}
				?>
				<div class="">
					<table class="table " id="datatable-editable">
						<thead>
							<tr>
								<th>Id</th>
								<th>Informasi</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$x=0;
							$query = mysqli_query($con, "SELECT * FROM berita");

							while ($row1 = mysqli_fetch_array($query)) {
								$datagabung[]=$row1['info'];
								$comb2=implode("&nbsp&nbsp| &nbsp&nbsp",$datagabung);
								$x=$x+1;
								?>
								<tr class="gradeX">
									<td><?php echo $x ?></td>
									<td><?php echo $row1[1]; ?></td>																				
									<td><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>"
											data-toggle="modal" data-target="#modal-konfirmasiberita"><i class="glyphicon glyphicon-trash"></i></a> 
										<a  class="btn btn-xs btn-warning" href="javascript:;"
											data-id="<?php echo $row1[0]; ?>"
											data-info="<?php echo $row1[1]; ?>"
											data-toggle="modal" data-target="#edit-databerita">
											<i class="glyphicon glyphicon-edit"></i>

										</a></td>
								</tr>
							<?php  }  mysqli_query($con,"INSERT INTO `beritagabung`(`info`) VALUES ('$comb2')");?>
				
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div id="tambah-databerita" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-data" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 style="text-align:left" >Berita</h4>
					</div>
					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">						
								<label for="inputEmail3" >Berita:</label>
								<input type="text" name="info" id="info" class="form-control" style="width:100%">
							</div><!-- /.form-group --> 
															
						</fieldset>
						<?php echo set_progress(); ?>
					</div>
					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="addberita"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="edit-databerita" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Berita</h4>
					</div>
					<div class="modal-body">
						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">			
									<label for="inputEmail3">Berita:</label>
									<input type="text" name="info" id="info" class="form-control" style="width: 100%">
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
					
						<button class="btn btn-info btn-submit" type="submit" name="editberita"><i class="glyphicon glyphicon-ok"></i> Edit</button>
							
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
	<div id="modal-konfirmasiberita" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
				<div>
					<div class="panel-heading"> 
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button> 
						<h3>Hapus Data</h3> 
					</div> 
					<div class="modal-body" style="">
						&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
					</div>
					<?php echo set_progress();
					mysqli_query($con,"INSERT INTO `beritagabung`(`info`) VALUES ('$comb2')")?>
					<form id="form-data" enctype="multipart/form-data" method="post">
						<fieldset>
							<input type="hidden" name="id" id="id">
						</fieldset>
						<div class="modal-footer">
							<button class="btn btn-danger" type="submit" name="hapusberita"><i class="glyphicon glyphicon-ok"></i> Ya</button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
							<br><br>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
<!--------------------------------UNTUK AGENDA ------------------------------------>
	<div class="col-xs-6 col-md-6">
		<div class="half-unit" style="height:auto">
			<dtitle>Agenda</dtitle>
			<hr>
			<div class="box">
				<button class="btn btn-success waves-light" data-id='0' data-toggle="modal" data-target="#tambah-dataagenda"><b><i class="glyphicon glyphicon-plus"></i></b> Tambah Agenda</button>
				<div>
					<table class="table " id="datatable-editable">
						<thead>
							<tr>
								<th>Id</th>
								<th>Agenda</th>
								<th>Rutinitas</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$x=0;
							$queryagenda = mysqli_query($con, "SELECT * FROM Agenda");
							while ($rowagenda = mysqli_fetch_array($queryagenda)) {
								$x=$x+1;
								?>
								<tr class="gradeX">
									<td><?php echo $x ?></td>
									<td><?php echo $rowagenda[1]; ?></td>	
									<td><?php echo $rowagenda[2]; ?></td>										
									<td><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $rowagenda[0]; ?>"
											data-toggle="modal" data-target="#modal-konfirmasiagenda"><i class="glyphicon glyphicon-trash"></i></a> 
										<a  class="btn btn-xs btn-warning" href="javascript:;"
											data-id="<?php echo $rowagenda[0]; ?>"
											data-agenda="<?php echo $rowagenda[1]; ?>"
											data-status="<?php echo $rowagenda[2]; ?>"
											data-toggle="modal" data-target="#edit-dataagenda">
											<i class="glyphicon glyphicon-edit"></i>

										</a></td>
								</tr>
							<?php  }  mysqli_query($con,"INSERT INTO `beritagabung`(`info`) VALUES ('$comb2')");?>		
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
	
	<div id="tambah-dataagenda" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-data" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 style="text-align:left" >Agenda</h4>
					</div>
					<div class="modal-body">
						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">						
								<label>Nama Agenda:</label>
								<input type="text" name="agenda" id="agenda" class="form-control" style="width:100%">
								<label>Rutinitas:</label>
								<select name="status" id="status" class="form-control" style="height:auto">
											<option>--select--</option>
											<option value="Harian">Harian</option>
											<option value="Mingguan">Mingguan</option>
											<option value="Bulanan">Bulanan</option>
											<option value="Tahunan">Tahunan</option>
								</select>
							</div><!-- /.form-group --> 								
						</fieldset>
						<?php echo set_progress(); ?>
					</div>
					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="addagenda"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="edit-dataagenda" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-data" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Agenda</h4>
					</div>
					<div class="modal-body">
						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">						
								<label>Nama Agenda:</label>
								<input type="text" name="agenda" id="agenda" class="form-control" style="width:100%">
								<label>Rutinitas:</label>
								<select name="status" id="status" class="form-control" style="height:auto">
											<option>--select--</option>
											<option value="Harian">Harian</option>
											<option value="Mingguan">Mingguan</option>
											<option value="Bulanan">Bulanan</option>
											<option value="Tahunan">Tahunan</option>
								</select>
							</div><!-- /.form-group --> 								
						</fieldset>
						<?php echo set_progress(); ?>
					</div>
					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="editagenda"><i class="glyphicon glyphicon-ok"></i> Edit</button>	
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modal-konfirmasiagenda" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
				<div>
					<div class="panel-heading"> 
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button> 
						<h3>Hapus Data Agenda</h3> 
					</div> 
					<div class="modal-body" style="">
						&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
					</div>
												
					<form id="form-data" enctype="multipart/form-data" method="post">
						<fieldset>
							<input type="hidden" name="id" id="id">
						</fieldset>
						<div class="modal-footer">
							<button class="btn btn-danger" type="submit" name="hapusagenda"><i class="glyphicon glyphicon-ok"></i> Ya</button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
							<br><br>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	
<!---------------------------------------------- UNTUK PEGAWAI ------------------------------------------------------------------>
	<div class="col-xs-6 col-md-6">
		<div class="half-unit" style="height:auto">
	    	<dtitle>Kepegawaian</dtitle>
			<hr>
			<div class="box">
				<button class="btn btn-success waves-light" data-id='0' data-toggle="modal" data-target="#tambah-datapegawai"><b><i class="glyphicon glyphicon-plus"></i></b> Tambah Nama Pegawai</button>
				<div class="">
						<table class="table " id="datatable-editable">
							<thead>
								<tr>
									<th>Id</th>
									<th>Pegawai</th>
									<th>Jabatan</th>
									<th>No HP</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$x=0;
								$querypegawai = mysqli_query($con, "SELECT * FROM Pegawai");
								while ($rowpegawai = mysqli_fetch_array($querypegawai)) {
									$x=$x+1;
									?>
									<tr class="gradeX">
										<td><?php echo $x ?></td>
										<td><?php echo $rowpegawai[1]; ?></td>	
										<td><?php echo $rowpegawai[2]; ?></td>											
										<td><?php echo $rowpegawai[3]; ?></td>											
										<td><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $rowpegawai[0]; ?>"
												data-toggle="modal" data-target="#modal-konfirmasipegawai"><i class="glyphicon glyphicon-trash"></i></a> 
											<a  class="btn btn-xs btn-warning" href="javascript:;"
												data-id="<?php echo $rowpegawai[0]; ?>"
												data-nama="<?php echo $rowpegawai[1]; ?>"
												data-jabatan="<?php echo $rowpegawai[2]; ?>"
												data-nomor="<?php echo $rowpegawai[3]; ?>"
												data-toggle="modal" data-target="#edit-datapegawai">
												<i class="glyphicon glyphicon-edit"></i>

											</a></td>
									</tr>
								<?php  } ?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
	
	<div id="tambah-datapegawai" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-data" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 style="text-align:left" >Pegawai</h4>
					</div>
					<div class="modal-body">
						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">						
								<label>Nama:</label>
								<input type="text" name="Nama" id="Nama" class="form-control" style="width:100%">
								<label>Jabatan:</label>
								<input type="text" name="Jabatan" id="Jabatan" class="form-control" style="width:100%">
								<label>Nomor HP:</label>
								<input type="text" name="Nomor" id="Nomor" class="form-control" style="width:100%" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
							</div><!-- /.form-group --> 								
						</fieldset>
						<?php echo set_progress(); ?>
					</div>
					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="addpegawai"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="edit-datapegawai" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form-data" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Pegawai</h4>
					</div>
					<div class="modal-body">
						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">						
								<label>Nama:</label>
								<input type="text" name="Nama" id="Nama" class="form-control" style="width:100%">
								<label>Jabatan:</label>
								<input type="text" name="Jabatan" id="Jabatan" class="form-control" style="width:100%">
								<label>Nomor HP:</label>
								<input type="text" name="Nomor" id="Nomor" class="form-control" style="width:100%" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
							</div><!-- /.form-group --> 	                                       
						</fieldset>
						<?php echo set_progress(); ?>
					</div>
					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="edit"><i class="glyphicon glyphicon-ok"></i> Edit</button>	
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modal-konfirmasipegawai" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
				<div>
					<div class="panel-heading"> 
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button> 
						<h3>Hapus Data Pegawai</h3> 
					</div> 
					<div class="modal-body" style="">
						&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
					</div>
												
					<form id="form-data" enctype="multipart/form-data" method="post">
						<fieldset>
							<input type="hidden" name="id" id="id">
						</fieldset>
						<div class="modal-footer">
							<button class="btn btn-danger" type="submit" name="hapuspegawai"><i class="glyphicon glyphicon-ok"></i> Ya</button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
							<br><br>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>		
	
<!--------UNTUK SLIDER ---------------------------------------------------------------------------------------------------------->
	<div class="col-xs-6 col-md-6">
	<div class="half-unit" style="height:auto">
		<dtitle>Slider</dtitle>
		<hr>
		<div class="box-body">
			<div class="box">
				<button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#tambah-data-gambar"><i class="glyphicon glyphicon-plus"></i> Slider Gambar</button>
				<button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#tambah-data-video"><i class="glyphicon glyphicon-plus"></i> Slider Video</button>
				<button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#tambah-data-text"><i class="glyphicon glyphicon-plus"></i> Slider Text</button>
				<div class="box-body">
					<table class="table" id="datatable-editable">
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
							$y=0;
							while ($row1 = mysqli_fetch_array($query)) {
								$y=$y+1;
								?>
								<tr class="gradeX">
									<td><?php echo $y; ?></td>

									<td><?php echo $row1[1]; ?></td>
									
		
									<?php $b=$row1[3];
									$c="";
									if($b==1){
										$c="teks";
									}
									elseif($b==2){
										$c="gambar";
									}
									elseif($b==3){
										$c="video";
									} ?>
									<td><?php echo $c;?></td>
									<td><?php echo $row1[4]; ?></td>
									<td><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>"
											data-toggle="modal" data-target="<?php 
											if ($row1[3]!=NULL){
												echo "#modal-konfirmasi-text";
											}else{
												echo "#modal-konfirmasi";
											}
											?>">
											<i class="glyphicon glyphicon-trash">
											</i>
										</a> 
										<a  class="btn btn-xs btn-warning" href="javascript:;"
											data-id="<?php echo $row1[0]; ?>"
											data-keterangan="<?php echo $row1[1]; ?>"
											data-judul="<?php echo $row1[2]; ?>"
											data-durasi="<?php echo $row1[4]; ?>"
											data-toggle="modal" data-target="<?php 
											if ($b==1){
												echo "#edit-data-text";
											}elseif ($b==2){
												echo "#edit-data";
											}elseif ($b==3){
												echo "#edit-data-video";
											}
											?>">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.content-wrapper -->
	</div>
		<!------------------------------------------------------------- UNTUK SLIDER --------------------------------->
	<div id="modal-konfirmasi" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
				<div>
					<div class="panel-heading"> 
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button> 
						<h3>Hapus Data</h3> 
					</div>  
					<div class="modal-body" style="">                                                                      
						&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
					</div>
					<?php echo set_progress(); ?>
				<form id="form-data" enctype="multipart/form-data" method="post">
					 <fieldset>
								<input type="hidden" name="id" id="id">
					 </fieldset>
					<div class="modal-footer">
						<button class="btn btn-danger" type="submit" name="hapus_slider"><i class="glyphicon glyphicon-ok"></i> ya</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
						<br><br>
					</div>
				</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!--modal konfirmasi delete txt-->
	<div id="modal-konfirmasi-text" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
				<div>
					<div class="panel-heading"> 
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button> 
						<h3>Hapus Data</h3> 
					</div>  
					<div class="modal-body" style="">                                                                                   
						&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
					</div>
					<?php echo set_progress(); ?>
				<form id="form-data" enctype="multipart/form-data" method="post">
					 <fieldset>
								<input type="hidden" name="id" id="id">
					 </fieldset>
					<div class="modal-footer">
						<!-- <a href="javascript:;" class="btn btn-danger" id="hapust-true"><i class="glyphicon glyphicon-ok"></i> Ya</a> -->
						<button class="btn btn-danger" type="submit" name="hapust"><i class="glyphicon glyphicon-ok"></i> ya</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
						<br><br>
					</div>
				</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Modal tambah data gambar-->
	<div id="tambah-data-gambar" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Slider</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%" size="1000">
							</div><!-- /.form-group --> 
							<div class="form-group">
								<label for="inputEmail3" >Durasi(ms)</label>
								<input type="text" name="durasi" id="durasi" class="form-control" style="width: 100%" size="1000">
							</div>
							<div class="form-group">
								<label for="inputEmail3" >Gambar</label>
									<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%;height:auto">
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="add_slider"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
						
						<!-- Modal tambah data gambar-->
	<div id="tambah-data-video" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Slider</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%" size="1000">
							</div><!-- /.form-group --> 
							<div class="form-group">
								<label for="inputEmail3" >Durasi(ms)</label>
								<input type="text" name="durasi" id="durasi" class="form-control" style="width: 100%" size="1000">
							</div>
							<div class="form-group">
								<label for="inputEmail3" >Video</label>
								<input type="file" name="video" id="video" class="form-control" style="width: 100%;height:auto">
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="addvid_slider"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="20000000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
						
						
                        <!--modal tambah data text-->
	<div id="tambah-data-text" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Slider</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
							<label for="inputEmail3" >Keterangan</label>
									<textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="gunakan '<br/>' untuk baris baru (enter)"></textarea>
							</div><!-- /.form-group --> 
							<div class="form-group">
								<label for="inputEmail3" >Durasi(ms)</label>
								<input type="text" name="durasi" id="durasi" class="form-control" style="width: 100%" size="1000">
							</div>
							<div class="form-group">
								<label for="inputEmail3" >Warna</label>
									<select name="judul" id="judul" class="form-control" style="height:auto">
										<option>--select--</option>
										<option value="blueberry-solid.jpg">Blueberry</option>
										<option value="blue.jpg">Blue</option>
										<option value="black.jpg">Black</option>
										<option value="white.jpg">White</option>
										<option value="amber-solid.jpg">Amber</option>
										<option value="ruby-solid.jpg">Ruby</option>
										<option value="Lavender.jpg">Lavender</option>
										<option value="lemon-curry.jpg">Lemon Curry</option>
										<option value="yellow.jpg">Yellow</option>
									</select>
							</div><!-- /.form-group --> 
							<input type="hidden" name="tipe" id="tipe" class="form-control">                                                
						</fieldset>

					<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="addt"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	<!-- Modal edit data -->
	<div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Slider</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%" size="1000">
							</div><!-- /.form-group --> 
							<div class="form-group">
								<label for="inputEmail3" >Durasi(ms)</label>
								<input type="text" name="durasi" id="durasi" class="form-control" style="width: 100%" size="1000">
							</div>
							<div class="form-group">
								<label for="inputEmail3" >Gambar</label>
									<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%;height:auto">
							</div><!-- /.form-group -->                                               
						</fieldset>
						<?php echo set_progress(); ?>
					</div>
					<div class="modal-footer">
						<button class="btn btn-keterangan btn-submit" type="submit" name="edit"><i class="glyphicon glyphicon-ok"></i> Edit</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="1024000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
		
	<div id="edit-data-video" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Slider</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%" size="1000">
							</div><!-- /.form-group --> 
							<div class="form-group">
								<label for="inputEmail3" >Durasi(ms)</label>
								<input type="text" name="durasi" id="durasi" class="form-control" style="width: 100%" size="1000">
							</div>
							<div class="form-group">
								<label for="inputEmail3" >Video</label>
								<input type="file" name="video" id="video" class="form-control" style="width: 100%;height:auto">
							</div><!-- /.form-group -->                                               
						</fieldset>
						<?php echo set_progress(); ?>
					</div>
					<div class="modal-footer">
						<button class="btn btn-keterangan btn-submit" type="submit" name="editvid"><i class="glyphicon glyphicon-ok"></i> Edit</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--edit data text-->
	<div id="edit-data-text" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
					<form id="form-data" enctype="multipart/form-data" method="post">

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Edit Slider</h4>
						</div>

						<div class="modal-body">

							<fieldset>
							
								<input type="hidden" name="id" id="id" class="form-control">
								<div class="form-group">
									<label for="inputEmail3" >Keterangan</label>
										<textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="gunakan '<br/>' untuk baris baru (enter)"></textarea>
								</div>
								<div class="form-group">
								<label for="inputEmail3" >Durasi(ms)</label>
								<input type="text" name="durasi" id="durasi" class="form-control" style="width: 100%" size="1000">
							</div><!-- /.form-group --> 
								<div class="form-group">
									<label for="inputEmail3" >Warna Background</label>
										<select name="judul" id="judul" class="form-control" style="height:auto">
											<option>--select--</option>
											<option value="antique-bronze-solid.jpg">antique-bronze-solid</option>
											<option value="black.jpg">black</option>
											<option value="blue.jpg">blue</option>
											<option value="white.jpg">white</option>
										</select>
								</div><!-- /.form-group -->
								<input type="hidden" name="tipe" id="tipe" class="form-control">                                            
							</fieldset>
							<?php echo set_progress(); ?>
						</div>
						<div class="modal-footer">
							<button class="btn btn-info btn-submit" type="submit" name="editt"><i class="glyphicon glyphicon-ok"></i> Edit</button>
							<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
							<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>		
<!---------------------------------- ATAS ------------------>
	<?php 
if (isset($_POST['add_tab_atas'])) {
    $lokasi='/var/www/gambar/';
    $judul=basename($_FILES['gambar']['name']);
    $uploadfile=$lokasi.$judul;
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)){
    $keterangan = $_POST['keterangan'];
    // $judul = $_POST['judul'];
    mysqli_query($con,"INSERT INTO `atas`(`keterangan`,`judul`) VALUES ('$keterangan','$judul')");
    }
}
elseif (isset($_POST['hapus_tab_atas'])) {
    $id=$_POST['id'];
    // supaya file foto di folder terhapus
    $tmp_judul=mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM atas WHERE id=$id"));
    $lokasi='/var/www/gambar/';
    $hapus_tab_atas=$lokasi.$tmp_judul[0];
    unlink($hapus_tab_atas);
    // =================================
    mysqli_query($con,"delete FROM `atas` WHERE id=$id");
    
}
?>
<div class="col-xs-6 col-md-6">
	<div class="half-unit" style="height:auto">
		<dtitle>Info Atas</dtitle>
		<hr>
		<div class="box-body">
			<div class="box">
				<button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#input-gambar-atas"><i class="glyphicon glyphicon-plus"></i> Slider Gambar</button>
				<div class="box-body">
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
							$query = mysqli_query($con, "SELECT * FROM atas");
							$y=0;
							while ($row1 = mysqli_fetch_array($query)) {
								$y=$y+1;
								?>
								<tr class="gradeX">
									<td><?php echo $y; ?></td>
									<td><?php echo $row1[1]; ?></td>
									<td>&nbsp </td>
									<td><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>"
											data-toggle="modal" data-target="#delete-tab-atas">
											<i class="glyphicon glyphicon-trash">
											</i>
										</a> 
										<a  class="btn btn-xs btn-warning" href="javascript:;"
											data-id="<?php echo $row1[0]; ?>"
											data-keterangan="<?php echo $row1[1]; ?>"
											data-judul="<?php echo $row1[2]; ?>"
											data-toggle="modal" data-target="#edit-tab-atas">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.content-wrapper -->
	</div>
</div>	

<div id="input-gambar-atas" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Info Atas</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%" size="1000">
							</div><!-- /.form-group --> 
							<div class="form-group">
								<label for="inputEmail3" >Gambar</label>
									<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%;height:auto">
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="add_tab_atas"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
<div id="delete-tab-atas" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
				<div>
					<div class="panel-heading"> 
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
						<h3>Hapus Data</h3> 
					</div>  
					<div class="modal-body" style="">                                                                      
						&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
					</div>
					<?php echo set_progress(); ?>
				<form id="form-data" enctype="multipart/form-data" method="post">
					 <fieldset>
								<input type="hidden" name="id" id="id">
					 </fieldset>
					<div class="modal-footer">
						<button class="btn btn-danger" type="submit" name="hapus_tab_atas"><i class="glyphicon glyphicon-ok"></i> ya</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
						<br><br>
					</div>
				</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div id="edit-tab-atas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Info Kiri Bawah</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<div class="col-sm-8">
									<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%">
								</div>
							</div><!-- /.form-group -->                                                 
							<div class="form-group">
								<label for="inputEmail3" >Gambar</label>
								<div class="col-sm-8">
									<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%" size="1000">
								</div>
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-keterangan btn-submit" type="submit" name="edit"><i class="glyphicon glyphicon-ok"></i> Edit</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
	<script>
	$(function() {
		$('#delete-tab-atas').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus_tab_atas
			var id = div.data('id')

			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus_tab_atas-true pada modal.
			// modal.find('#hapus_tab_atas-true').attr("href", "slider.php?hapus_tab_atas=hapus_tab_atas&id=" + id);
			modal.find('#id').attr("value", id);
		});
		$('#edit-tab-atas').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			var id = div.data('id');
			var keterangan = div.data('keterangan');
			var gambar = div.data('gambar');
			var modal = $(this);
			
			// Isi nilai pada field
			modal.find('#id').attr("value", id);
			modal.find('#keterangan').attr("value", keterangan);
			modal.find('#gambar').attr("value", gambar);
		});
	});
		</script>
	
<!------------------------------------------------------ KIRI BAWAH ---------------------------------------->	
	<?php 
if (isset($_POST['add_tab_kiri_bawah'])) {
    $lokasi='/var/www/gambar/';
    $judul=basename($_FILES['gambar']['name']);
    $uploadfile=$lokasi.$judul;
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)){
    $keterangan = $_POST['keterangan'];
    // $judul = $_POST['judul'];
    mysqli_query($con,"INSERT INTO `kiri_bawah`(`keterangan`,`judul`) VALUES ('$keterangan','$judul')");
    }
}
elseif (isset($_POST['hapus_tab_kiri_bawah'])) {
    $id=$_POST['id'];
    // supaya file foto di folder terhapus
    $tmp_judul=mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM kiri_bawah WHERE id=$id"));
    $lokasi='/var/www/gambar/';
    $hapus_tab_kiri_bawah=$lokasi.$tmp_judul[0];
    unlink($hapus_tab_kiri_bawah);
    // =================================
    mysqli_query($con,"delete FROM `kiri_bawah` WHERE id=$id");
    
}
?>
<div class="col-xs-6 col-md-6">
	<div class="half-unit" style="height:auto">
		<dtitle>Info Kiri Bawah</dtitle>
		<hr>
		<div class="box-body">
			<div class="box">
				<button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#input-gambar-kiri-bawah"><i class="glyphicon glyphicon-plus"></i> Slider Gambar</button>
				<div class="box-body">
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
							$query = mysqli_query($con, "SELECT * FROM kiri_bawah");
							$y=0;
							while ($row1 = mysqli_fetch_array($query)) {
								$y=$y+1;
								?>
								<tr class="gradeX">
									<td><?php echo $y; ?></td>
									<td><?php echo $row1[1]; ?></td>
									<td>&nbsp </td>
									<td><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>"
											data-toggle="modal" data-target="#delete-tab-kiri-bawah">
											<i class="glyphicon glyphicon-trash">
											</i>
										</a> 
										<a  class="btn btn-xs btn-warning" href="javascript:;"
											data-id="<?php echo $row1[0]; ?>"
											data-keterangan="<?php echo $row1[1]; ?>"
											data-judul="<?php echo $row1[2]; ?>"
											data-toggle="modal" data-target="#edit-tab-kiri-bawah">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.content-wrapper -->
	</div>
</div>	

<div id="input-gambar-kiri-bawah" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Info Kiri Bawah</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%" size="1000">
							</div><!-- /.form-group --> 
							<div class="form-group">
								<label for="inputEmail3" >Gambar</label>
									<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%;height:auto">
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="add_tab_kiri_bawah"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
<div id="delete-tab-kiri-bawah" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
				<div>
					<div class="panel-heading"> 
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
						<h3>Hapus Data</h3> 
					</div>  
					<div class="modal-body" style="">                                                                      
						&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
					</div>
					<?php echo set_progress(); ?>
				<form id="form-data" enctype="multipart/form-data" method="post">
					 <fieldset>
								<input type="hidden" name="id" id="id">
					 </fieldset>
					<div class="modal-footer">
						<button class="btn btn-danger" type="submit" name="hapus_tab_kiri_bawah"><i class="glyphicon glyphicon-ok"></i> ya</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
						<br><br>
					</div>
				</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div id="edit-tab-kiri-bawah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Info Kiri Bawah</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<div class="col-sm-8">
									<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%">
								</div>
							</div><!-- /.form-group -->                                                 
							<div class="form-group">
								<label for="inputEmail3" >Gambar</label>
								<div class="col-sm-8">
									<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%" size="1000">
								</div>
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-keterangan btn-submit" type="submit" name="edit"><i class="glyphicon glyphicon-ok"></i> Edit</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
	<script>
	$(function() {
		$('#delete-tab-kiri-bawah').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus_tab_kiri_bawah
			var id = div.data('id')

			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus_tab_kiri_bawah-true pada modal.
			// modal.find('#hapus_tab_kiri_bawah-true').attr("href", "slider.php?hapus_tab_kiri_bawah=hapus_tab_kiri_bawah&id=" + id);
			modal.find('#id').attr("value", id);
		});
		$('#edit-tab-kiri-bawah').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			var id = div.data('id');
			var keterangan = div.data('keterangan');
			var gambar = div.data('gambar');
			var modal = $(this);
			
			// Isi nilai pada field
			modal.find('#id').attr("value", id);
			modal.find('#keterangan').attr("value", keterangan);
			modal.find('#gambar').attr("value", gambar);
		});
	});
		</script>
		
		<!------------------------------------------------------------------------------- KIRI ATAS ------------------------------->
<?php 
if (isset($_POST['add_tab_kiri_atas'])) {
    $lokasi='/var/www/gambar/';
    $judul=basename($_FILES['gambar']['name']);
    $uploadfile=$lokasi.$judul;
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)){
    $keterangan = $_POST['keterangan'];
    // $judul = $_POST['judul'];
    mysqli_query($con,"INSERT INTO `kiri_atas`(`keterangan`,`judul`) VALUES ('$keterangan','$judul')");
    }
}
elseif (isset($_POST['hapus_tab_kiri_atas'])) {
    $id=$_POST['id'];
    // supaya file foto di folder terhapus
    $tmp_judul=mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM kiri_atas WHERE id=$id"));
    $lokasi='/var/www/gambar/';
    $hapus_tab_kiri_atas=$lokasi.$tmp_judul[0];
    unlink($hapus_tab_kiri_atas);
    // =================================
    mysqli_query($con,"delete FROM `kiri_atas` WHERE id=$id");
    
}
?>

<div class="col-xs-6 col-md-6">
	<div class="half-unit" style="height:auto">
		<dtitle>INFO KIRI ATAS</dtitle>
		<hr>
		<div class="box-body">
			<div class="box">
				<button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#input-gambar-kiri-atas"><i class="glyphicon glyphicon-plus"></i> Slider Gambar</button>
				<div class="box-body">
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
									<td><?php echo $y; ?></td>
									<td><?php echo $row1[1]; ?></td>
									<td>&nbsp </td>
									<td><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>"
											data-toggle="modal" data-target="#delete-tab-kiri-atas">
											<i class="glyphicon glyphicon-trash">
											</i>
										</a> 
										<a  class="btn btn-xs btn-warning" href="javascript:;"
											data-id="<?php echo $row1[0]; ?>"
											data-keterangan="<?php echo $row1[1]; ?>"
											data-judul="<?php echo $row1[2]; ?>"
											data-toggle="modal" data-target="#edit-tab-kiri-atas">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.content-wrapper -->
	</div>
</div>	
<div id="input-gambar-kiri-atas" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Info Kiri Atas</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%" size="1000">
							</div><!-- /.form-group --> 
							<div class="form-group">
								<label for="inputEmail3" >Gambar</label>
									<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%;height:auto">
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="add_tab_kiri_atas"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
<div id="delete-tab-kiri-atas" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
				<div>
					<div class="panel-heading"> 
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
						<h3>Hapus Data</h3> 
					</div>  
					<div class="modal-body" style="">                                                                      
						&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
					</div>
					<?php echo set_progress(); ?>
				<form id="form-data" enctype="multipart/form-data" method="post">
					 <fieldset>
								<input type="hidden" name="id" id="id">
					 </fieldset>
					<div class="modal-footer">
						<button class="btn btn-danger" type="submit" name="hapus_tab_kiri_atas"><i class="glyphicon glyphicon-ok"></i> ya</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
						<br><br>
					</div>
				</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div id="edit-tab-kiri-atas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Info Kiri Atas</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<div class="col-sm-8">
									<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%">
								</div>
							</div><!-- /.form-group -->                                                 
							<div class="form-group">
								<label for="inputEmail3" >Gambar</label>
								<div class="col-sm-8">
									<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%" size="1000">
								</div>
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-keterangan btn-submit" type="submit" name="edit"><i class="glyphicon glyphicon-ok"></i> Edit</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
	<script>
	$(function() {
		$('#delete-tab-kiri-atas').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus_tab_kiri_atas
			var id = div.data('id')

			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus_tab_kiri_atas-true pada modal.
			// modal.find('#hapus_tab_kiri_atas-true').attr("href", "slider.php?hapus_tab_kiri_atas=hapus_tab_kiri_atas&id=" + id);
			modal.find('#id').attr("value", id);
		});
		$('#edit-tab-kiri-atas').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			var id = div.data('id');
			var keterangan = div.data('keterangan');
			var gambar = div.data('gambar');
			var modal = $(this);
			
			// Isi nilai pada field
			modal.find('#id').attr("value", id);
			modal.find('#keterangan').attr("value", keterangan);
			modal.find('#gambar').attr("value", gambar);
		});
		});
		</script>
		<!---------------------------- KANAN BAWAh -------------->
		<?php 
if (isset($_POST['add_tab_kanan_bawah'])) {
    $lokasi='/var/www/gambar/';
    $judul=basename($_FILES['gambar']['name']);
    $uploadfile=$lokasi.$judul;
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)){
    $keterangan = $_POST['keterangan'];
    // $judul = $_POST['judul'];
    mysqli_query($con,"INSERT INTO `kanan_bawah`(`keterangan`,`judul`) VALUES ('$keterangan','$judul')");
    }
}
elseif (isset($_POST['hapus_tab_kanan_bawah'])) {
    $id=$_POST['id'];
    // supaya file foto di folder terhapus
    $tmp_judul=mysqli_fetch_array(mysqli_query($con, "SELECT judul FROM kanan_bawah WHERE id=$id"));
    $lokasi='/var/www/gambar/';
    $hapus_tab_kanan_bawah=$lokasi.$tmp_judul[0];
    unlink($hapus_tab_kanan_bawah);
    // =================================
    mysqli_query($con,"delete FROM `kanan_bawah` WHERE id=$id");
    
}
?>

<div class="col-xs-6 col-md-6">
	<div class="half-unit" style="height:auto">
		<dtitle>Info Kanan Bawah</dtitle>
		<hr>
		<div class="box-body">
			<div class="box">
				<button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#input-gambar-kanan-bawah"><i class="glyphicon glyphicon-plus"></i> Slider Gambar</button>
				<div class="box-body">
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
							$query = mysqli_query($con, "SELECT * FROM kanan_bawah");
							$y=0;
							while ($row1 = mysqli_fetch_array($query)) {
								$y=$y+1;
								?>
								<tr class="gradeX">
									<td><?php echo $y; ?></td>
									<td><?php echo $row1[1]; ?></td>
									<td>&nbsp </td>
									<td><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>"
											data-toggle="modal" data-target="#delete-tab-kanan-bawah">
											<i class="glyphicon glyphicon-trash">
											</i>
										</a> 
										<a  class="btn btn-xs btn-warning" href="javascript:;"
											data-id="<?php echo $row1[0]; ?>"
											data-keterangan="<?php echo $row1[1]; ?>"
											data-judul="<?php echo $row1[2]; ?>"
											data-toggle="modal" data-target="#edit-tab-kanan-bawah">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.content-wrapper -->
	</div>
</div>	
<div id="input-gambar-kanan-bawah" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Info Kanan Bawah</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%" size="1000">
							</div><!-- /.form-group --> 
							<div class="form-group">
								<label for="inputEmail3" >Gambar</label>
									<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%;height:auto">
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit" type="submit" name="add_tab_kanan_bawah"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
<div id="delete-tab-kanan-bawah" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
				<div>
					<div class="panel-heading"> 
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
						<h3>Hapus Data</h3> 
					</div>  
					<div class="modal-body" style="">                                                                      
						&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
					</div>
					<?php echo set_progress(); ?>
				<form id="form-data" enctype="multipart/form-data" method="post">
					 <fieldset>
								<input type="hidden" name="id" id="id">
					 </fieldset>
					<div class="modal-footer">
						<button class="btn btn-danger" type="submit" name="hapus_tab_kanan_bawah"><i class="glyphicon glyphicon-ok"></i> ya</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
						<br><br>
					</div>
				</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div id="edit-tab-kanan-bawah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" enctype="multipart/form-data" method="post">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Info Kanan Bawah</h4>
					</div>

					<div class="modal-body">

						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label for="inputEmail3" >Keterangan</label>
								<div class="col-sm-8">
									<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%">
								</div>
							</div><!-- /.form-group -->                                                 
							<div class="form-group">
								<label for="inputEmail3" >Gambar</label>
								<div class="col-sm-8">
									<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%" size="1000">
								</div>
							</div><!-- /.form-group -->                                               
						</fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-keterangan btn-submit" type="submit" name="edit"><i class="glyphicon glyphicon-ok"></i> Edit</button>
						<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
						<button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
	<script>
	$(function() {
		$('#delete-tab-kanan-bawah').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus_tab_kanan_bawah
			var id = div.data('id')

			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus_tab_kanan_bawah-true pada modal.
			// modal.find('#hapus_tab_kanan_bawah-true').attr("href", "slider.php?hapus_tab_kanan_bawah=hapus_tab_kanan_bawah&id=" + id);
			modal.find('#id').attr("value", id);
		});
		$('#edit-tab-kanan-bawah').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			var id = div.data('id');
			var keterangan = div.data('keterangan');
			var gambar = div.data('gambar');
			var modal = $(this);
			
			// Isi nilai pada field
			modal.find('#id').attr("value", id);
			modal.find('#keterangan').attr("value", keterangan);
			modal.find('#gambar').attr("value", gambar);
		});
		});
		</script>
</div>		

 <?php $datamain=mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `konfigurasi`"));?>
      <div class="col-sm-12 col-lg-12" style="height:auto">
		<div class="dash-unit" style="height:auto">
	<script src="radio_toggle.js"></script>							
			<form method="post" action="konfigurasi.php">	
				<div class="form-group">
					<label for="jarak" class="col-sm-1 col-md-1 control-label text-right">Jarak: </label>
					<div class="col-sm-5 col-md-5">
						<div class="input-group">
							<div id="gender_radio" class="btn-group">
								<a class="btn btn-secondary btn-sm noAactive" data-toggle="jarak" data-title="1">ON</a>
								<a class="btn btn-secondary btn-sm noActive" data-toggle="jarak" data-title="0">OFF</a>
							</div>
							<?php $query = mysqli_query($con, "SELECT * FROM konfigurasi");
							$row1= mysqli_fetch_array($query)?>
							<input type="hidden" name="jarak" id="jarak" value="<?php echo $datamain[2];?> ">
						</div>
					</div>
				</div>
				<br><br><br/>
				<div class="form-group">
					<label for="color1" class="col-sm-1 col-md-1 control-label text-right">Background Color </label>
					<div class="col-sm-10 col-md-10">
						<div class="input-group">
							<div id="gender_radio" class="btn-group">
								<div id="gender_radio" class="btn-group">
								<a class="btn btn-default btn-sm noActive" data-toggle="color1" data-title="ffffff">White</a>
								<a class="btn btn-flatblue btn-sm noActive" data-toggle="color1" data-title="337ab7">Flat-Blue</a>
								<a class="btn btn-flatgreen btn-sm noActive" data-toggle="color1" data-title="5cb85c">Green</a>
								<a class="btn btn-flatyellow btn-sm noActive" data-toggle="color1" data-title="f0ad4e">Yellow</a>
								<a class="btn btn-dark btn-sm noActive" data-toggle="color1" data-title="1f1f1f">Dark</a>
								<a class="btn btn-flatred btn-sm noActive" data-toggle="color1" data-title="d9534f">Red</a>
								<a class="btn btn-lightdark btn-sm noActive" data-toggle="color1" data-title="3d3d3d">Light Dark</a>
								<a class="btn btn-orange btn-sm noActive" data-toggle="color1" data-title="eba804">Orange</a>
								<a class="btn btn-emarld btn-sm noActive" data-toggle="color1" data-title="2ecc71">Emerald</a>
								<a class="btn btn-flatteal btn-sm noActive" data-toggle="color1" data-title="5bc0de">Teal</a>
								<a class="btn btn-pixgrass btn-sm noActive" data-toggle="color1" data-title="009432">Pixelrated Grass</a>
							</div>
							</div>
							<?php $query = mysqli_query($con, "SELECT * FROM konfigurasi");
							$row1= mysqli_fetch_array($query)?>
							<input type="hidden" name="color1" id="color1" value="<?php echo $datamain[3];?>">
						</div>
					</div>
				</div>			
<br>	<br/>			
				<div class="form-group">
					<label for="color2" class="col-sm-1 col-md-1 control-label text-right">Menu Color: </label>
					<div class="col-sm-10 col-md-10">
						<div class="input-group">
							<div id="gender_radio" class="btn-group">
								<a class="btn btn-default btn-sm noActive" data-toggle="color2" data-title="ffffff">White</a>
								<a class="btn btn-flatblue btn-sm noActive" data-toggle="color2" data-title="337ab7">Flat-Blue</a>
								<a class="btn btn-flatgreen btn-sm noActive" data-toggle="color2" data-title="5cb85c">Green</a>
								<a class="btn btn-flatyellow btn-sm noActive" data-toggle="color2" data-title="f0ad4e">Yellow</a>
								<a class="btn btn-dark btn-sm noActive" data-toggle="color2" data-title="1f1f1f">Dark</a>
								<a class="btn btn-flatred btn-sm noActive" data-toggle="color2" data-title="d9534f">Red</a>
								<a class="btn btn-lightdark btn-sm noActive" data-toggle="color2" data-title="3d3d3d">Light Dark</a>
								<a class="btn btn-orange btn-sm noActive" data-toggle="color2" data-title="eba804">Orange</a>
								<a class="btn btn-emarld btn-sm noActive" data-toggle="color2" data-title="2ecc71">Emerald</a>
								<a class="btn btn-flatteal btn-sm noActive" data-toggle="color2" data-title="5bc0de">Teal</a>
								<a class="btn btn-pixgrass btn-sm noActive" data-toggle="color2" data-title="009432">Pixelrated Grass</a>
							</div>
							<?php $query = mysqli_query($con, "SELECT * FROM konfigurasi");
							$row1= mysqli_fetch_array($query)?>
							<input type="hidden" name="color2" id="color2" value="<?php echo $datamain[4];?>">
						</div>
					</div>
				</div>
				<br></br>
				<div class="form-group">
					<label for="clockcolor" class="col-sm-1 col-md-1 control-label text-right">Clock Color: </label>
					<div class="col-sm-10 col-md-10">
						<div class="input-group">
							<div id="gender_radio" class="btn-group">
								<div id="gender_radio" class="btn-group">
								<a class="btn btn-default btn-sm noActive" data-toggle="clockcolor" data-title="ffffff">White</a>
								<a class="btn btn-flatblue btn-sm noActive" data-toggle="clockcolor" data-title="337ab7">Flat-Blue</a>
								<a class="btn btn-flatgreen btn-sm noActive" data-toggle="clockcolor" data-title="5cb85c">Green</a>
								<a class="btn btn-flatyellow btn-sm noActive" data-toggle="clockcolor" data-title="f0ad4e">Yellow</a>
								<a class="btn btn-dark btn-sm noActive" data-toggle="clockcolor" data-title="1f1f1f">Dark</a>
								<a class="btn btn-flatred btn-sm noActive" data-toggle="clockcolor" data-title="d9534f">Red</a>
								<a class="btn btn-lightdark btn-sm noActive" data-toggle="clockcolor" data-title="3d3d3d">Light Dark</a>
								<a class="btn btn-orange btn-sm noActive" data-toggle="clockcolor" data-title="eba804">Orange</a>
								<a class="btn btn-emarld btn-sm noActive" data-toggle="clockcolor" data-title="2ecc71">Emerald</a>
								<a class="btn btn-flatteal btn-sm noActive" data-toggle="clockcolor" data-title="5bc0de">Teal</a>
								<a class="btn btn-pixgrass btn-sm noActive" data-toggle="clockcolor" data-title="009432">Pixelrated Grass</a>
							</div>
							</div>
							<?php $query = mysqli_query($con, "SELECT * FROM konfigurasi");
							$row1= mysqli_fetch_array($query)?>
							<input type="hidden" name="clockcolor" id="clockcolor" value="<?php echo $datamain[5];?>">
						</div>
					</div>
				</div>	
				<br></br>
				<div class="form-group">
					<label for="textcolor" class="col-sm-1 col-md-1 control-label text-right">Text Color: </label>
					<div class="col-sm-10 col-md-10">
						<div class="input-group">
							<div id="gender_radio" class="btn-group">
								<div id="gender_radio" class="btn-group">
								<a class="btn btn-default btn-sm noActive" data-toggle="textcolor" data-title="ffffff">White</a>
								<a class="btn btn-flatblue btn-sm noActive" data-toggle="textcolor" data-title="337ab7">Flat-Blue</a>
								<a class="btn btn-flatgreen btn-sm noActive" data-toggle="textcolor" data-title="5cb85c">Green</a>
								<a class="btn btn-flatyellow btn-sm noActive" data-toggle="textcolor" data-title="f0ad4e">Yellow</a>
								<a class="btn btn-dark btn-sm noActive" data-toggle="textcolor" data-title="1f1f1f">Dark</a>
								<a class="btn btn-flatred btn-sm noActive" data-toggle="textcolor" data-title="5">Red</a>
								<a class="btn btn-lightdark btn-sm noActive" data-toggle="textcolor" data-title="3d3d3d">Light Dark</a>
								<a class="btn btn-orange btn-sm noActive" data-toggle="textcolor" data-title="eba804">Orange</a>
								<a class="btn btn-emarld btn-sm noActive" data-toggle="textcolor" data-title="2ecc71">Emerald</a>
								<a class="btn btn-flatteal btn-sm noActive" data-toggle="textcolor" data-title="5bc0de">Teal</a>
								<a class="btn btn-pixgrass btn-sm noActive" data-toggle="textcolor" data-title="009432">Pixelrated Grass</a>
							</div>
							</div>
							<?php $query = mysqli_query($con, "SELECT * FROM konfigurasi");
							$row1= mysqli_fetch_array($query)?>
							<input type="hidden" name="textcolor" id="textcolor" value="<?php echo $datamain[6];?>">
						</div>
					</div>
				</div>	
				<br><button type="submit" class="btn btn-default float-none" name="btn-save"  id="btn-save">
							 Submit
						</button> 			
			</form>
				
		</div>
	  </div>
 	  		<!-- INFORMATION BLOCK -->     
			<div class="col-sm-12 col-lg-12">
				<div class="footdash-unit" style="width:99%;height:auto;margin:10px;">
	      		<dtitle>Informasi</dtitle>
	      		<hr>
	      		<div class="runningtext"> <!--for running text space -->
					<?php
						$bodytext = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `beritagabung`ORDER BY ID DESC LIMIT 1"));
						$jeda = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `konfigurasi`"));
					?>
					<marquee scrollamount="<?php echo $jeda['speedtexts']; ?>"><h2><?php echo $bodytext[1]; ?><h2></marquee>
				</div>
				<br>
				
				</div>
			</div>

     
      
      
	</div>

     
      
      
	</div> <!-- /container -->
	

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
	
	<!-- NOTY JAVASCRIPT -->
	<script type="text/javascript" src="assets/js/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/top.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topLeft.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topRight.js"></script>
	<script type="text/javascript" src="assets/js/noty/layouts/topCenter.js"></script>
	
	<!-- You can add more layouts if you want -->
	<script type="text/javascript" src="assets/js/noty/themes/default.js"></script>
    <!-- <script type="text/javascript" src="assets/js/dash-noty.js"></script> This is a Noty bubble when you init the theme-->


	
  
  
  <!--Carousel Wrapper-->
                        
    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
	<script>	 
		$(function() {
			$('#modal-konfirmasiberita').on('show.bs.modal', function(event) {
				var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

				// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
				var id = div.data('id')

				var modal = $(this)

				// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
				//modal.find('#hapus-true').attr("href", "konfigurasi.php?hapus=hapus&id=" + id);
				modal.find('#id').attr("value", id);
			});
			$('#edit-databerita').on('show.bs.modal', function(event) {
				var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

				var id = div.data('id');
				var info = div.data('info');
				var modal = $(this);
				
				// Isi nilai pada field
				modal.find('#id').attr("value", id);
				modal.find('#info').attr("value", info);
			});
		});
	</script>
		<script>	 
		$(function() {
			$('#modal-konfirmasiagenda').on('show.bs.modal', function(event) {
				var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

				// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
				var id = div.data('id')

				var modal = $(this)

				// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
				//modal.find('#hapus-true').attr("href", "konfigurasi.php?hapus=hapus&id=" + id);
				modal.find('#id').attr("value", id);
			});
			$('#edit-dataagenda').on('show.bs.modal', function(event) {
				var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

				var id = div.data('id');
				var agenda = div.data('agenda');
				var status = div.data('status');
				var modal = $(this);
				
				// Isi nilai pada field
				modal.find('#id').attr("value", id);
				modal.find('#agenda').attr("value", agenda);
				modal.find('#status').attr("value", status);
			});
		});
	</script>
		<script>	 
		$(function() {
			$('#modal-konfirmasipegawai').on('show.bs.modal', function(event) {
				var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

				// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
				var id = div.data('id')

				var modal = $(this)

				// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
				//modal.find('#hapus-true').attr("href", "konfigurasi.php?hapus=hapus&id=" + id);
				modal.find('#id').attr("value", id);
			});
			$('#edit-datapegawai').on('show.bs.modal', function(event) {
				var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

				var id = div.data('id');
				var info = div.data('info');
				var modal = $(this);
				
				// Isi nilai pada field
				modal.find('#id').attr("value", id);
				modal.find('#info').attr("value", info);
			});
		});
	</script>
	<!--- UNTUK SLIDER -->
	<script>

                        $(function() {
                            $('#modal-konfirmasi').on('show.bs.modal', function(event) {
                                var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

                                // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus_slider
                                var id = div.data('id')

                                var modal = $(this)

                                // Mengisi atribut href pada tombol ya yang kita berikan id hapus_slider-true pada modal.
                                // modal.find('#hapus_slider-true').attr("href", "slider.php?hapus_slider=hapus_slider&id=" + id);
                                modal.find('#id').attr("value", id);
                            });
                            $('#modal-konfirmasi-text').on('show.bs.modal', function(event) {
                                var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

                                // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus_slider
                                var id = div.data('id')

                                var modal = $(this)

                                // Mengisi atribut href pada tombol ya yang kita berikan id hapus_slider-true pada modal.
                                // modal.find('#hapust-true').attr("href", "slider.php?hapust=hapust&id=" + id);
                                modal.find('#id').attr("value", id);
                            });
                            $('#edit-data').on('show.bs.modal', function(event) {
                                var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

                                var id = div.data('id');
                                var keterangan = div.data('keterangan');
                                var gambar = div.data('gambar');
                                var modal = $(this);
                                var durasi = div.data('durasi');
                                // Isi nilai pada field
                                modal.find('#id').attr("value", id);
                                modal.find('#keterangan').attr("value", keterangan);
                                modal.find('#gambar').attr("value", gambar);
								modal.find('#durasi').attr("value", durasi);
                            });
							$('#edit-data-video').on('show.bs.modal', function(event) {
                                var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
								var durasi = div.data('durasi');
                                var id = div.data('id');
                                var keterangan = div.data('keterangan');
                                var video = div.data('video');
                                var modal = $(this);
                                
                                // Isi nilai pada field
                                modal.find('#id').attr("value", id);
                                modal.find('#keterangan').attr("value", keterangan);
                                modal.find('#video').attr("value", video);
								modal.find('#durasi').attr("value", durasi);
                            });
                            $('#edit-data-text').on('show.bs.modal', function(event) {
                                var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
								 var durasi = div.data('durasi');
                                var id = div.data('id');
                                var keterangan = div.data('keterangan');
                                var judul = div.data('judul');
                                var tipe = div.data('tipe');
                                var modal = $(this);
                                
                                // Isi nilai pada field
                                modal.find('#id').attr("value", id);
                                modal.find('#keterangan').html(keterangan);
                                modal.find('#judul').attr("value", judul);
								modal.find('#durasi').attr("value", durasi);
                                modal.find('#tipe').attr("value", tipe);
                            });
                        });
                    </script>
</body></html>
