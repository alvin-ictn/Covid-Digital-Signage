<?php

$dir = __DIR__;
$dir = str_replace('jsFile','',$dir);
date_default_timezone_set('Asia/Jakarta');
session_start();
require_once 'koneksi.php';
$koneksi = new koneksi();
$db= $koneksi::koneksi_db();


						
//cari berdasarkan tanggal
if(isset($_GET['statusaktif']))
{
	$sql = "SELECT * FROM agenda";
	$qy = $db->query($sql);
	$dt ="";
	if($qy->num_rows > 0){
		while($data = $qy->fetch_assoc()){
			if($data['bulan_mulai']==1){
						$bulan = "Jan";
					}else if($data['bulan_mulai']==2){
						$bulan = "Feb";
					}else if($data['bulan_mulai']==3){
						$bulan = "Mar";
					}else if($data['bulan_mulai']==4){
						$bulan = "Apr";
					}else if($data['bulan_mulai']==5){
						$bulan = "Mai";
					}else if($data['bulan_mulai']==6){
						$bulan = "Juni";
					}else if($data['bulan_mulai']==7){
						$bulan = "Juli";
					}else if($data['bulan_mulai']==8){
						$bulan = "Agus";
					}else if($data['bulan_mulai']==9){
						$bulan = "Sept";
					}else if($data['bulan_mulai']==10){
						$bulan = "Okt";
					}else if($data['bulan_mulai']==11){
						$bulan = "Sept";
					}else if($data['bulan_mulai']==12){
						$bulan = "Des";
						}
			$dt = $dt."<tr><td class=''  class='active'><div style='font-size:14px' class='dayofmonth'>".$data['hari_mulai'].", ".$data['tanggal_mulai']." ".$bulan." ".$data['tahun_mulai']." | ".$data['jam_mulai'].":".$data['menit_mulai']." - ".$data['jam_selesai'].":".$data['menit_selesai']."</div><div style='font-size:18px'><b>".$data['agenda']."</b></div></td></tr>";
		}
	}
	$dt="<table class='table table-condensed table-bordered'>".$dt."</table>";
  die(json_encode(array('status'=>$dt)));
}


	
?>