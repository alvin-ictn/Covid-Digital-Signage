<?php

$dir = __DIR__;
$dir = str_replace('jsFile','',$dir);
date_default_timezone_set('Asia/Jakarta');
session_start();
require_once 'koneksi.php';
$koneksi = new koneksi();
$db= $koneksi::koneksi_db();


//cari berdasarkan tanggal
if(isset($_GET['coloraktif']))
{
	$sql = "SELECT * FROM main";
	$qy = $db->query($sql);
	$dt ="";
	if($qy->num_rows > 0){
		while($data = $qy->fetch_assoc()){
			$dt = $dt."<b>Clock Background Color</b><div class='square' style='background-color:".$data['flip_clock_1']."'></div>".$data['flip_clock_1']."";
		}
	}
	$dt=$dt;
  die(json_encode(array('color'=>$dt)));
}

if(isset($_GET['coloraktif2']))
{
	$sql = "SELECT * FROM main";
	$qy = $db->query($sql);
	$dt ="";
	if($qy->num_rows > 0){
		while($data = $qy->fetch_assoc()){
			$dt = $dt."<b>Number Color</b><div class='square' style='background-color:".$data['flip_clock_2']."'></div>".$data['flip_clock_2']."";
		}
	}
	$dt=$dt;
  die(json_encode(array('color2'=>$dt)));
} 

if(isset($_GET['coloraktif3']))
{
	$sql = "SELECT * FROM konfigurasi";
	$qy = $db->query($sql);
	$dt ="";
	if($qy->num_rows > 0){
		while($data = $qy->fetch_assoc()){
			$dt = $dt."<b>Background Login Color</b><div class='square' style='background-color:".$data['clockcolor']."'></div>".$data['clockcolor']."";
		}
	}
	$dt=$dt;
  die(json_encode(array('color3'=>$dt)));
} 
	
?>