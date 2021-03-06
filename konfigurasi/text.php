<?php include './conn.php';

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

if (isset($_POST["textspeedpost"])) {
	$postData = $_POST["textspeed"];
	mysqli_query($con, "UPDATE `konfigurasi` SET `timeslide`='$postData' WHERE id=1");
}
$dataspeed = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `konfigurasi` WHERE id=1"));
if (isset($_POST['addberita'])) {
	$info = $_POST['info'];
	mysqli_query($con, "INSERT INTO `berita`(`info`) VALUES ('$info')");
} elseif (isset($_POST['hapusberita'])) {
	$id = $_POST['id'];
	mysqli_query($con, "delete FROM `berita` WHERE id=$id");
} elseif (isset($_POST['editberita'])) {
	$id = $_POST['id'];
	$info = $_POST['info'];
	mysqli_query($con, "UPDATE `berita` SET `info`='$info' WHERE id=$id");
} ?>
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
	<?php include 'asides.php'; ?>
	<link rel="stylesheet" href="assets/css/close.css" />
	<link rel="stylesheet" href="conditional/bootstrap-iso.css">
	<div id="tambah-databerita" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="top:5%;">
		<div class="modal-dialog">
			<div class="bootstrap-iso">
				<form id="form-data" method="post">
					<div class="modal-header">
						<center>
							<h4 class="control-label">Berita</h4>
						</center>
						<div class="circCont">
							<button class="circle closemodale" data-dismiss="modal" data-animation="xMarks" data-remove="3000"></button>
						</div>
					</div>
					<div class="modal-body">
						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label class="control-label">Berita:</label>
								<input type="text" name="info" id="info" class="form-control" style="width:100%">
							</div>
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

	<div id="edit-databerita" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="top:5%;">
		<div class="modal-dialog">
			<div class="bootstrap-iso">
				<form id="form-data" method="post">
					<div class="modal-header">
						<center>
							<h4 class="control-label">Berita</h4>
						</center>
						<div class="circCont">
							<button class="circle closemodale" data-dismiss="modal" data-animation="xMarks" data-remove="3000"></button>
						</div>
					</div>
					<div class="modal-body">
						<fieldset>
							<input type="hidden" name="id" id="id" class="form-control">
							<div class="form-group">
								<label class="control-label">Berita:</label>
								<input type="text" name="info" id="info" class="form-control" style="width: 100%">
							</div>
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

	<div id="modal-konfirmasiberita" class="modal fade" role="dialog" aria-hidden="true" style="top:5%;">
		<div class="modal-dialog">
			<div class="bootstrap-iso">
				<div class="modal-header">
					<center>
						<h4 class="control-label" style="padding:15px 0 15px 0">Hapus Data</h4>
					</center>
				</div>
				<div class="modal-body" style="">
					&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
				</div>
				<?php echo set_progress();
				//$datagabung[]=$row1['info'];
				//	$comb2=implode("&nbsp&nbsp| &nbsp&nbsp",$datagabung);
				//mysqli_query($con,"INSERT INTO `beritagabung`(`info`) VALUES ('$comb2')")
				?>
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
	<h1>Running Text</h1>
	<div class="float-right justify-content-end mx-4 align-items-center">
		<form class="label-control row vertical-align-center" method="post">
			<label class="mx-3 p-0 m-2 col-sm-3">Text Speed</label>
			<div class="input-group col-sm-4">
				<input class="form-control " type="text" name="textspeed" value="<?php echo $dataspeed["timeslide"] ?>" />
				<div class="input-group-append">
					<span class="input-group-text" id="basic-addon2">ms</span>
				</div>
			</div>
			<button class="btn btn-primary mx-3 col-sm-3" name="textspeedpost" type="submit">Submit</button>
		</form>
	</div>
	<button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#tambah-databerita"><i class="glyphicon glyphicon-plus"></i> Berita</button>

	<div class="main-content">
		<div class="table-responsive">
			<table class="table" id="datatable-editable">
				<thead>
					<tr>
						<th>Id</th>
						<th>Informasi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$x = 0;
					$query = mysqli_query($con, "SELECT * FROM berita");

					while ($row1 = mysqli_fetch_array($query)) {
						$datagabung[] = $row1['info'];
						$comb2 = implode("&nbsp&nbsp| &nbsp&nbsp", $datagabung);
						$x = $x + 1;
					?>
						<tr class="gradeX">
							<td style="vertical-align: middle;"><?php echo $x ?></td>
							<td style="vertical-align: middle;"><?php echo $row1[1]; ?></td>
							<td style="vertical-align: middle;"><a class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>" data-toggle="modal" data-target="#modal-konfirmasiberita"><i class="glyphicon glyphicon-trash"></i></a>
								<a class="btn btn-xs btn-warning" href="javascript:;" data-id="<?php echo $row1[0]; ?>" data-info="<?php echo $row1[1]; ?>" data-toggle="modal" data-target="#edit-databerita">
									<i class="glyphicon glyphicon-edit"></i>

								</a></td>
						</tr>
					<?php  }
					mysqli_query($con, "INSERT INTO `beritagabung`(`info`) VALUES ('$comb2')"); ?>

				</tbody>
			</table>
		</div>
	</div>


	<?php include 'foot.php'; ?>
</body>
<script>
	$(function() {
		$('#modal-konfirmasiberita').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget)
			var id = div.data('id')
			var modal = $(this)
			modal.find('#id').attr("value", id);
		});
		$('#edit-databerita').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget)
			var id = div.data('id');
			var info = div.data('info');
			var modal = $(this);
			modal.find('#id').attr("value", id);
			modal.find('#info').attr("value", info);
		});
	});
</script>

</html>