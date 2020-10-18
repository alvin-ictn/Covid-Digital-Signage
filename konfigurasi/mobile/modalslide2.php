<link rel="stylesheet" href="../assets/css/close.css" />
<link rel="stylesheet" href="conditional/bootstrap-iso.css">

<div id="tambah-data-gambar" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="top:5%">
	<div class="modal-dialog">
		<div class="bootstrap-iso">
			<form id="form-data" enctype="multipart/form-data" method="post">
				<div class="modal-header">	
					<center><h4 class="control-label">Slider</h4></center>
					<div class="circCont">
						<button class="circle closemodale" data-dismiss="modal" data-animation="xMarks" data-remove="3000"></button>
					</div>
				</div>
				<div class="modal-body">
				<fieldset>
					<input type="hidden" name="id" id="id" class="form-control">
					<div class="form-group">
						<label class="control-label">Keterangan</label>
						<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%" size="1000">
					</div>
					<div class="form-group">
						<label class="control-label" for="gamslidut">Gambar</label>
								<input type="file" name="gambar" id="gambar" class="form-control" style="width: 100%;height:auto" accept="image/*">
								<small style="margin-left:5px;margin-top:5px;">Best Resolution 1280x1440</small>	
					</div> 
				<fieldset>		
						<?php echo set_progress(); ?>	
				</div>				 
				<div class="modal-footer">
					<button class="btn btn-primary " name="tambahslide" type="submit"><i class="glyphicon glyphicon-ok"></i>Upload</button>
					<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
				</div>
			</form>								
		</div> 
	</div>
</div>