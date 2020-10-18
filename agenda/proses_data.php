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
			$dt = $dt."<tr><td>".$data['agenda']."</td></tr>";
		}
	}
	$dt="<table>".$dt."</table>";
  die(json_encode(array('status'=>$dt)));
}

 
	
?>