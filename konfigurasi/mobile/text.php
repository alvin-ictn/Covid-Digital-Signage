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
} ?>
<html>
<head>
<?php include 'head.php'; ?>
<?php include "control.php";?>
</head>


<style>
.modal-open, body, .navbar-fixed-top, .navbar-fixed-bottom{
    padding-right: 0px !important;
	margin-right: 0px !important
}
</style>
<body>
<link rel="stylesheet" href="../assets/css/close.css" />
<div id="tambah-databerita" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="top:5%;">
	<div class="modal-dialog">
		<div class="bootstrap-iso">
			<form id="form-data" method="post">
				<div class="modal-header">
					<center><h4 class="control-label">Berita</h4></center>
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
					<center><h4 class="control-label">Berita</h4></center>
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
				<center><h4 class="control-label" style="padding:15px 0 15px 0">Hapus Data</h4></center>
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

<div class="wrapper">
        <!-- Sidebar  -->
		<?php include "side.php";?>

        <!-- Page Content  -->
        <div id="content">
		<button type="button" id="sidebarCollapse" class="btn btn-info">
				<i class="fas fa-align-left"></i>
				<span>Menu</span>
			</button><b>&nbsp&nbsp&nbsp&nbsp&nbspRunning Text</b>
			<br><br><button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#tambah-databerita"><i class="glyphicon glyphicon-plus"></i> Berita</button>

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
				$x=0;
				$query = mysqli_query($con, "SELECT * FROM berita");

				while ($row1 = mysqli_fetch_array($query)) {
					$datagabung[]=$row1['info'];
					$comb2=implode("&nbsp&nbsp| &nbsp&nbsp",$datagabung);
					$x=$x+1;
					?>
					<tr class="gradeX">
						<td style="vertical-align: middle;"><?php echo $x ?></td>
						<td style="vertical-align: middle;"><?php echo $row1[1]; ?></td>																	
						<td style="vertical-align: middle;"><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>"
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
<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
	<script src="../assets/js/bootstrap.js"></script>
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