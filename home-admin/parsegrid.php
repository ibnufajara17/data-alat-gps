<?php 
error_reporting(0);
 $page = $_GET['page']; // get the requested page
 $limit = $_GET['rows']; // get how many rows we want to have into the grid
 $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
 $sord = $_GET['sord']; // get the direction
 if(!$sidx) $sidx =1; // connect to the database
 $koneksi = pg_connect("host=localhost dbname=db_gps user=postgres password=123456")or die("Connection Error: " . pg_result_error());
 pg_select($koneksi, dbname) or die ("Error connecting to db.");
 $query = "SELECT COUNT(*) AS count FROM master_asset.asset_gps WHERE (gps_id='$gps_id')";
 $result = pg_query($koneksi,$query);
 $row = pg_fetch_array($result);
 $count = $row['count'];

 if( $count >0 ) { 
 $total_pages = ceil($count/$limit);
 //$total_pages = ceil($count/1);
 } else {
 $total_pages = 0; 
 } if ($page > $total_pages) 
 $page=$total_pages; 
 $start = $limit*$page - $limit; // do not put $limit*($page - 1) 
 $SQL = "SELECT * from master_asset.asset_gps WHERE (gps_id='$gps_id') ORDER BY $sidx $sord LIMIT $limit OFFSET $start"; 
 $result = pg_query( $SQL ) or die("Couldn t execute query.".pg_result_error());

 $responce->page = $page;
 $responce->total = $total_pages;
 $responce->records = $count; 
 $i=0;
 while($row = pg_fetch_array($result,pg_fetch_assoc)) { 
$responce->rows[$i]['id']=$row['id_gps'];
$responce->rows[$i]['cell']=array($row['gps_id'], $row['id_gps'],$row['name_gps'],$row['merk_gps'],$row['type_gps'],$row['waranty'],$row['buy_date'],$row['sold_date'],$row['sold_to'],$row['description'],""); $i++;
 } 
 echo json_decode($responce);
?>