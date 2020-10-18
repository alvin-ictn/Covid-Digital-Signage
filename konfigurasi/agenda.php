<?php include './conn.php';
function set_progress($val = 0) {
    $data = "<div class='progress-container' style='display:none'>
                <div class='progress'>
                      <div class='progress-bar progress-bar-agenda progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: " . $val . "%'>
                      </div>
                </div>
            </div>";
    return $data;
}
if (isset($_POST['tambahslide'])) {
    $agenda=$_POST['agenda'];
    $jadwal_mulai=$_POST['start'];
	$jadwal_selesai=$_POST['end'];
	$yow1=explode("/",$jadwal_mulai);
	$hari_mulai = $yow1[0];
	$tanggal_mulai = $yow1[1];
	$bulan_mulai = $yow1[2];
	$tahun_mulai = $yow1[3];
	$jam_mulai = $yow1[4];
	$menit_mulai = $yow1[5];
	$jadwal_mulai1= "".$tahun_mulai."-".$bulan_mulai."-".$tanggal_mulai."";
	
	$yow2=explode("/",$jadwal_selesai);
	$hari_selesai = $yow2[0];
	$tanggal_selesai = $yow2[1];
	$bulan_selesai = $yow2[2];
	$tahun_selesai = $yow2[3];
	$jam_selesai = $yow2[4];
	$menit_selesai = $yow2[5];
	$jadwal_selesai1= $tahun_selesai."-".$bulan_selesai."-".$tanggal_selesai;
	mysqli_query($con,"INSERT INTO `agenda`(`agenda`,`jadwal_mulai`,`jadwal_selesai`,`hari_mulai`,`hari_selesai`,`tanggal_mulai`,`tanggal_selesai`,`bulan_mulai`,`bulan_selesai`,`tahun_mulai`,`tahun_selesai`,`jam_mulai`,`jam_selesai`,`menit_mulai`,`menit_selesai`) VALUES ('$agenda','$jadwal_mulai1','$jadwal_selesai1','$hari_mulai','$hari_selesai','$tanggal_mulai','$tanggal_selesai','$bulan_mulai','$bulan_selesai','$tahun_mulai','$tahun_selesai','$jam_mulai','$jam_selesai','$menit_mulai','$menit_selesai')") or die(mysqli_error($con));
}
elseif (isset($_POST['hapusagenda'])) {
    $id=$_POST['id'];
mysqli_query($con,"delete FROM `agenda` WHERE id=$id");
}elseif (isset($_POST['editagenda'])) {
    $id=$_POST['id'];
    $agenda = $_POST['agenda'];
    mysqli_query($con, "UPDATE `agenda` SET `agenda`='$agenda' WHERE id=$id");
}
?>
<html>
<head>
<?php include 'head.php'; ?>
</head>
</head>
<style>
.modal-open, body, .navbar-fixed-top, .navbar-fixed-bottom{
    padding-right: 0px !important;
	margin-right: 0px !important
}
</style>
<body>
<?php 
include 'asides2.php'; ?>
<?php include 'control.php';?>
<link rel="stylesheet" href="assets/css/close.css" />
<link rel="stylesheet" href="conditional/bootstrap-iso.css">
<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.css" />

<script src="assets/js/moment-with-locales.js"></script>
<script src="assets/js/bootstrap-datetimepicker.js"></script>

<div id="tambah-databerita" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="top:5%;">
	<div class="modal-dialog" style="">
		<div class="bootstrap-iso">
			<form id="live_form" enctype="multipart/form-data" method="post">
				<div class="modal-header">	
					<center><h4 class="control-label">Agenda</h4></center>
					<div class="circCont">
						<button class="circle closemodale" data-dismiss="modal" data-animation="xMarks" data-remove="3000"></button>
					</div>
				</div>
				<div class="modal-body" style="">
					<input type="hidden" name="id" id="id" class="form-control">
					<div class="form-group">
						<label class="label-control">Agenda</label>
						<input type="text" name="agenda" id="agenda" class="form-control" style="width: 100%" size="1000">
					</div>
					
						<div class="form-group">
						<label class="label-control">Start Agenda</label>
							<div class='input-group date' id='datetimepicker6' >
								<input type="hidden" name="start" class="form-control" />
								<span style="display:none" class="input-group-addon datepickerbutton">
									<span style="display:none" class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						
					<hr>
						<div class="form-group">
						<label class="label-control">End Agenda</label>
							<div class='input-group date' id='datetimepicker7'>
								
								<input type="hidden" name="end" class="form-control" />
								<span style="display:none" class="input-group-addon datepickerbutton">
									<span style="display:none" class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
				
					
					<?php echo set_progress(); ?>				
					<button class="btn btn-primary" name="tambahslide" type="submit">
						Submit
					</button>					
				</div>
				
						
			</form>	
		</div>
	</div>
</div>

<div id="edit-dataagenda" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="top:5%;">
	<div class="modal-dialog">
		<div class="bootstrap-iso">
			<form id="live_form" enctype="multipart/form-data" method="post">
				<div class="modal-header">	
					<center><h4 class="control-label">Agenda</h4></center>
					<div class="circCont">
						<button class="circle closemodale" data-dismiss="modal" data-animation="xMarks" data-remove="3000"></button>
					</div>
				</div>
				<div class="modal-body" style="">
					<input type="hidden" name="id" id="id" class="form-control">
					<div class="form-group">
						<label class="label-control">Agenda</label>
						<input type="text"  name="agenda" id="agenda" class="form-control" style="width: 100%" size="1000">
					</div>
					<?php echo set_progress(); ?>				
					<button class="btn btn-primary" name="editagenda" type="submit">
						Submit
					</button>					
				</div>				
			</form>	
		</div>
	</div>
</div>


<div id="modal-konfirmasiagenda" class="modal fade" role="dialog" aria-hidden="true" style="top:5%;">
	<div class="modal-dialog">
		<div class="bootstrap-iso">
			<div class="modal-header">	
				<center><h4 class="control-label" style="padding:15px 0 15px 0">Hapus Data</h4></center>
			</div> 
			<div class="modal-body" style="">
				&nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
			</div>
			<?php echo set_progress();?>
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
	</div>
</div>
<h1>Agenda</h1>
<button class="btn btn-success waves-effect waves-light" data-id='0' data-toggle="modal" data-target="#tambah-databerita"><i class="glyphicon glyphicon-plus"></i> Agenda</button>

<div class="main-content">
	<div class="table-responsive">
		<table class="table" id="datatable-editable">
			<thead>
				<tr>
					<th>Id</th>
					<th>Agenda</th>
					<th>Tanggal</th>
					<th>Jadwal</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$x=0;
				$query = mysqli_query($con, "SELECT * FROM agenda ORDER by jadwal_mulai");

				while ($row1 = mysqli_fetch_array($query)) {
					if($row1['bulan_mulai']==1){
						$bulan = "Januari";
					}else if($row1['bulan_mulai']==2){
						$bulan = "Februari";
					}else if($row1['bulan_mulai']==3){
						$bulan = "Maret";
					}else if($row1['bulan_mulai']==4){
						$bulan = "April";
					}else if($row1['bulan_mulai']==5){
						$bulan = "Mai";
					}else if($row1['bulan_mulai']==6){
						$bulan = "Juni";
					}else if($row1['bulan_mulai']==7){
						$bulan = "Juli";
					}else if($row1['bulan_mulai']==8){
						$bulan = "Agustus";
					}else if($row1['bulan_mulai']==9){
						$bulan = "September";
					}else if($row1['bulan_mulai']==10){
						$bulan = "Oktober";
					}else if($row1['bulan_mulai']==11){
						$bulan = "September";
					}else if($row1['bulan_mulai']==12){
						$bulan = "Desember";
						}
					$datagabung[]=$row1['agenda'];
					$comb2=implode("&nbsp&nbsp| &nbsp&nbsp",$datagabung);
					$x=$x+1;
					?>
					<tr class="gradeX">
						<td style="vertical-align: middle;"><?php echo $x ?></td>
						<td style="vertical-align: middle;"><?php echo $row1['agenda']; ?></td>
						<td style="vertical-align: middle;"><?php echo "".$row1['hari_mulai'].", ".$row1['tanggal_mulai']." ".$bulan." ".$row1['tahun_mulai'].""; ?></td>	
						<td style="vertical-align: middle;"><?php echo "".$row1['jam_mulai'].":".$row1['menit_mulai']." - ".$row1['jam_selesai'].":".$row1['menit_selesai'].""; ?></td>							
						<td style="vertical-align: middle;"><a  class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>"
								data-toggle="modal" data-target="#modal-konfirmasiagenda"><i class="glyphicon glyphicon-trash"></i></a> 
							<a  class="btn btn-xs btn-warning" href="javascript:;"
								data-id="<?php echo $row1[0]; ?>"
								data-agenda="<?php echo $row1[1]; ?>"
								data-toggle="modal" data-target="#edit-dataagenda">
								<i class="glyphicon glyphicon-edit"></i>

							</a></td>
					</tr>
				<?php  }  ?>
	
			</tbody>
		</table>
	</div>
</div>  
<?php include 'foot.php';?>
</body>
<script>	 
	$(function() {
		$('#modal-konfirmasiagenda').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget)
			var id = div.data('id')
			var modal = $(this)
			modal.find('#id').attr("value", id);
		});
		$('#edit-dataagenda').on('show.bs.modal', function(event) {
			var div = $(event.relatedTarget)
			var id = div.data('id');
			var agenda = div.data('agenda');
			var modal = $(this);
			modal.find('#id').attr("value", id);
			modal.find('#agenda').attr("value", agenda);
		});
	});
</script>
	<script type="text/javascript">
		$(function () {
			$('#datetimepicker6').datetimepicker({
				format : 'dddd/DD/MM/YYYY/HH/mm',
				locale: 'id',inline: true,sideBySide: true
				
			});
			$('#datetimepicker7').datetimepicker({
				useCurrent: false,
				format : 'dddd/DD/MM/YYYY/HH/mm',
				locale: 'id',inline: true,sideBySide: true
			}); 
			$("#datetimepicker6").on("dp.change", function (e) {
				$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
			});
			$("#datetimepicker7").on("dp.change", function (e) {
				$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
			});
		});
	</script>
</body>

</html>