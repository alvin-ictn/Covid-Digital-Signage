<?php
class koneksi { 
private static $localhost;
private static $username;
private static $password;
private static $database;

private static $localhost1;
private static $username1;
private static $password1;
private static $database1;

public static $db;
public static $db1;

public function __construct(){ 
	self::setDatabase();
    self::setDatabase1();
} 

private function setDatabase(){ 
	self::$localhost = 'localhost';
    self::$username = 'root';
	self::$password = '';
    self::$database = 'peternakan';
}

private function setDatabase1(){ 
	self::$localhost1 = 'localhost';
    self::$username1 = 'root';
	self::$password1 = '';
    self::$database1 = 'rab_simak';
}

public static function koneksi_db()
{
    self::$db = new mysqli(self::$localhost, self::$username, self::$password,self::$database);
    if (self::$db->connect_error) {
    	
        die("Connection failed: " . self::$db->connect_error);
    	 
    }
    return self::$db; 
}

public static function koneksi_db2()
{
    self::$db1 = new mysqli(self::$localhost1, self::$username1, self::$password1,self::$database1);
    if (self::$db1->connect_error) {
        die("Connection failed: " . self::$db1->connect_error);
       
    }
    return self::$db1; 
}   

public static function hitungJumlahData($field,$namatabel){ 
	$cek = 0;$query = "select count($field) as jumlah from $namatabel";
	$hasil = mysql_query($query);

	if($hasil){
		if(mysql_num_rows($hasil) > 0 ){ 
			$data = mysql_fetch_array($hasil);$jumlah = $data["jumlah"];
		}
	} 
	return $jumlah;
} 

public function GetSingleData($field,$ambil,$namatabel,$value){ 
	$cek = 0;$query = "select $ambil from $namatabel where $field = '$value'";
	$hasil = mysql_query($query);
	if($hasil){ 
		if(mysql_num_rows($hasil) > 0 ){ 
			if(isset($data)){ 
				unset($data);
			} 
			$data = mysql_fetch_array($hasil);
			$jumlah = $data[$ambil];
		}
	} 
	return $jumlah;
}



} 
?>