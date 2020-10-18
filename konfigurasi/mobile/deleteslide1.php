<div id="delete-slider" class="modal fade" role="dialog" aria-hidden="true" style="top:5%;">
	<div class="modal-dialog">
		<div class="bootstrap-iso">
			<div class="modal-header">	
				<center><h4 class="control-label" style="padding:15px 0 15px 0">Hapus Gambar</h4></center>
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
					<button class="btn btn-danger" type="submit" name="hapusslider"><i class="glyphicon glyphicon-ok"></i> ya</button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
					<br><br>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
$(function() {
	$('#delete-slider').on('show.bs.modal', function(event) {
		var div = $(event.relatedTarget)
		var id = div.data('id')
		var modal = $(this)
		modal.find('#id').attr("value", id);
	});
});
</script>
