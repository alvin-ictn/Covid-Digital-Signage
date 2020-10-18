<div id="edit-slider" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="top:5%;">
	<div class="modal-dialog">
		<div class="bootstrap-iso">
			<form id="live_form" enctype="multipart/form-data" method="post">
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
					</div> 
				<fieldset>		
						<?php echo set_progress(); ?>	
				</div>			 
				<div class="modal-footer">
					<button class="btn btn-warning " name="edit" type="submit">
					<input type="hidden" name="MAX_FILE_SIZE" value="200000000" />Edit
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
	
<script>
$(function() {
	$('#edit-slider').on('show.bs.modal', function(event) {
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