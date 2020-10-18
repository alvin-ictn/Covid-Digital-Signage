
<link rel="stylesheet" href="../assets/css/close.css" />
<script src="../conditional/conditional.js"></script>		


<div id="tambah-data-gambar" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="top:5%">
	<div class="modal-dialog">
		<div class="bootstrap-iso">
			<form id="live_form" enctype="multipart/form-data" method="post">
				<div class="modal-header">	
					<center><h4 class="control-label">Slider</h4></center>
					<div class="circCont">
						<button class="circle closemodale" data-dismiss="modal" data-animation="xMarks" data-remove="3000"></button>
					</div>
				</div>				
				<div class="form-group" style="padding-top:8px">
					<label class="control-label">
						Tipe Slide
					</label>
					<div class="form-row" style="margin:0px;">
						<div class="radio" style="width:50%;max-width:50%;">
							<label class="radio">
								<input name="rating" type="radio" value="gambar"/>Gambar
							</label>
						</div>
						<div class="radio" style="width:47%;max-width:47%;">
							<label class="radio">
								<input name="rating" type="radio" value="video"/>Video
							</label>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" id="id" class="form-control">
					<div class="form-group">
						<label for="inputEmail3" >Keterangan</label>
						<input type="text" name="keterangan" id="keterangan" class="form-control" style="width: 100%" size="1000">
					</div>
					<div class="form-group hidden">
						<label class="control-label" for="durgamslidut" >Durasi(ms)</label>
						<input type="text" name="durasi" id="durgamslidut" class="form-control" style="width: 100%" size="1000" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
					</div>
					<div class="form-group hidden">
						<label class="control-label" for="gamslidut">Gambar</label>
							<input type="file" name="gambar" id="gamslidut" class="form-control" style="width: 100%;height:auto" accept="image/*">
														<small style="margin-left:5px;margin-top:5px;">Maximum resolution 2560×1440</small>	
					</div>          
					<div class="form-group hidden">
						<label class="control-label" for="vidslidut">Video</label>
						<input type="file" name="video" id="vidslidut" class="form-control" style="width: 100%;height:auto" accept="video/*">
						<small style="margin-left:5px;margin-top:5px;">Maximum resolution 1280x720</small>	
					</div>          					
				</div>
				<?php echo set_progress(); ?>	
				<small style="margin-left:5px;margin-top:5px;">Type File Widescreen 16:9</small>	
				<div class="modal-footer">
					<button class="btn btn-primary " name="tambahslide" type="submit">
						Submit
					</button>
				</div>
			</form>								
		</div> 
	</div>
</div>