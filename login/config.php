<?php
// konfigurasi koneksi
/*$host       =  "localhost";
$dbuser     =  "postgres";
$dbpass     =  "123456";
$port       =  "5432";
$dbname     =  "db_gps";*/
 
// script koneksi php postgree
$koneksi = pg_connect("host=localhost dbname=db_gps user=postgres password=123456");
pg_dbname($koneksi);

if ($koneksi)
{
 echo "masuk";
}
else
{
	 echo "gagal";
}
//pg_select_db($dbname, $koneksi)or die ("Koneksi ke server error");
/*if($koneksi){
	echo "Anda telah masuk server localhost";
} else {
	echo "anda gagal masuk server";
}*/
?>