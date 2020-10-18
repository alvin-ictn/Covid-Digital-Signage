<div class="sidedash-unit" style="background-color: #<?php echo $datamain[4]?>;<?php if($datamain[2]==1){	?>margin-top:0px;margin-left:0px;margin-right:0px;margin-bottom:0px;height:290px<?php }else{}?>">
	<dtitle style="color:#<?php echo $datamain[6];?>">Agenda</dtitle>
	<hr>
	<div class="agenda">
		<div class="table-responsive">
			<table class="table table-condensed table-bordered">
				<tbody>
				<?php $now = date("d");
				$day5=$now + 11;
				$no=0;
				$query = mysqli_query($con, "SELECT * FROM agenda ORDER by jadwal_mulai");
				while ($row = mysqli_fetch_array($query)) {
					if($row['bulan_mulai']==1){
						$bulan = "Januari";
					}else if($row['bulan_mulai']==2){
						$bulan = "Februari";
					}else if($row['bulan_mulai']==3){
						$bulan = "Maret";
					}else if($row['bulan_mulai']==4){
						$bulan = "April";
					}else if($row['bulan_mulai']==5){
						$bulan = "Mai";
					}else if($row['bulan_mulai']==6){
						$bulan = "Juni";
					}else if($row['bulan_mulai']==7){
						$bulan = "Juli";
					}else if($row['bulan_mulai']==8){
						$bulan = "Agustus";
					}else if($row['bulan_mulai']==9){
						$bulan = "September";
					}else if($row['bulan_mulai']==10){
						$bulan = "Oktober";
					}else if($row['bulan_mulai']==11){
						$bulan = "September";
					}else if($row['bulan_mulai']==12){
						$bulan = "Desember";
						}
						
					$data[$no]['tanggal_mulai'] = $row['tanggal_mulai'];
					$data[$no]['jadwal_mulai'] = $row['jadwal_mulai'];
					$data[$no]['hari_mulai'] = $row['hari_mulai'];
					$data[$no]['tahun_mulai'] = $row['tahun_mulai'];
					$data[$no]['jam_mulai'] = $row['jam_mulai'];
					$data[$no]['menit_mulai'] = $row['menit_mulai'];			
					$data[$no]['jam_selesai'] = $row['jam_selesai'];
					$data[$no]['menit_selesai'] = $row['menit_selesai'];
					$data[$no]['agenda'] = $row['agenda'];
					$data[$no]['bulan'] = $bulan;
					
					$no = $no + 1;
					?>
					<tr>
						<td class=""  class="active" rowspan="<?php echo $cn[$row['jadwal_mulai']];?>">
							<div style="font-size:14px" class="dayofmonth"><?php echo "".$row['hari_mulai'].", ".$row['tanggal_mulai']." ".$bulan." ".$row['tahun_mulai']."";?>
								&nbsp&nbsp&nbsp<?php echo "".$row['jam_mulai'].":".$row['menit_mulai']." - ".$row['jam_selesai'].":".$row['menit_selesai']."";?>
							</div>
							<script type="text/javascript" src="agenda/jquery/js/jquery-2.2.3.min.js"></script>
							<script  type="text/javascript" src="agenda/jquery/js/jquery-ui.min.js"></script>
							<script  type="text/javascript" src="agenda/tes.js"></script>
							<div class="tabel_data" id="tabel_data">
							<div style="font-size:18px"><b><?php echo $row['agenda'];?></b></div>
						</td>
					</tr><?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>