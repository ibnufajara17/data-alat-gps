<?php
// konfigurasi koneksi
/*$host       =  "localhost";
$dbuser     =  "postgres";
$dbpass     =  "123456";
$port       =  "5432";
$dbname     =  "db_gps";*/
 
// script koneksi php postgree
$koneksi = pg_connect("host=localhost dbname=db_gps user=postgres password=123456");
//pg_select_db($dbname, $koneksi)or die ("Koneksi ke server error");
?>