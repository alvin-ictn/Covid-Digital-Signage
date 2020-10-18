<div class="sidedash-unit" style="background-color: #<?php echo $datamain[4]?>;<?php if($datamain[2]==1){	?>margin-top:0px;margin-left:0px;margin-right:0px;margin-bottom:0px;height:290px<?php }else{}?>">
	<dtitle style="color:#<?php echo $datamain[6];?>">Agenda</dtitle>
	<hr>
	<div class="agenda">
		<div class="table-responsive">
			<table class="table table-condensed table-bordered">
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
				
				}
				?>
				<tbody>
					<!-- Single event in a single day -->
				<?php
					function getCount($val){
						$CN = null;
						foreach($val as $d1){
							
							if(!isset($CN[$d1['jadwal_mulai']]))
							{
								foreach($val as $d2){
									if($d1['jadwal_mulai'] == $d2['jadwal_mulai']){
										if(!isset($CN[$d1['jadwal_mulai']])){
											$CN[$d1['jadwal_mulai']] = 1;
										}else{
											$CN[$d1['jadwal_mulai']] = $CN[$d1['jadwal_mulai']] + 1;
										}
									}
								}
							}
						}
						return $CN;
					}
					
					$cn = getCount($data);
					$cn1 = null;
					
					foreach($data as $value){
						if(isset($cn[$value['jadwal_mulai']])){
							if(!isset($cn1[$value['jadwal_mulai']])){
							?>
								<tr>
									<td class="agenda-date" class="active" rowspan="<?php echo $cn[$value['jadwal_mulai']];?>">
										<div class="dayofmonth"><?php echo $value['tanggal_mulai'];?></div>
											<div class="dayofweek"><?php echo $value['hari_mulai'];?></div>
										<div class="shortdate text-muted"><?php echo "".$value['bulan'].",".$value['tahun_mulai']."";?></div>
									</td>
									<td class="agenda-time" style="vertical-align: middle;">
										  <?php echo "".$value['jam_mulai'].":".$value['menit_mulai']." s/d ".$value['jam_selesai'].":".$value['menit_selesai']."";?>
									</td>
									
									<td class="agenda-events" style="vertical-align: middle;">
										<div class="agenda-event">
										
												<?php echo $value['agenda'];?>
										</div>
									</td>
								</tr>
							<?php
								if($cn[$value['jadwal_mulai']] > 1){
									$cn1[$value['jadwal_mulai']] = 1;
								}
							}else{
								if($cn[$value['jadwal_mulai']] > 1){
								?>
									<tr>
										<td class="agenda-time" style="vertical-align: middle;">
											 <?php echo "".$value['jam_mulai'].":".$value['menit_mulai']." - ".$value['jam_selesai'].":".$value['menit_selesai']."";?>
										</td>
										<td class="agenda-events" style="vertical-align: middle;">
											<div class="agenda-event">
												<?php echo $value['agenda'];?>
											</div>
										</td>
									</tr>
								<?php
								}else{
									?>
										<tr>
											<td class="agenda-date" class="active" rowspan="<?php echo $cn[$value['jadwal_mulai']];?>">
												<div class="dayofmonth"><?php echo $value['tanggal_mulai'];?></div>
													<div class="dayofweek"><?php echo $value['hari_mulai'];?></div>
												<div class="shortdate text-muted"><?php echo "".$value['bulan'].",".$value['tahun_mulai']."";?></div>
											</td>
											<td class="agenda-time" style="vertical-align: middle;">
												  <?php echo "".$value['jam_mulai']."-".$value['jam_selesai']."";?>
											</td>
											
											<td class="agenda-events" style="vertical-align: middle;">
												<div class="agenda-event">
													<i class="glyphicon glyphicon-repeat text-muted" title="Repeating event"></i> 
														<?php echo $value['agenda'];?>
												</div>
											</td>
										</tr>
									<?php
								}
							}
						}
					}
					
				?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>