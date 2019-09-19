<?php
include '../config.php';
//Data GPS
if($_GET['act']== 'tambahdata'){
    $id_gps = $_POST['id_gps'];
    $name_gps = $_POST['name_gps'];
    $merk_gps = $_POST['merk_gps'];
    $type_gps = $_POST['type_gps'];
    $waranty = $_POST['waranty'];
    $buy_date = $_POST['buy_date'];
    $sold_date = $_POST['sold_date'];
    $sold_to = $_POST['sold_to'];
    $description = $_POST['description'];
    $photo = $_POST['photo'];
    //query
    $querytambah =  pg_query($koneksi, "INSERT INTO master_asset.asset_gps VALUES('$id_gps' , '$name_gps' , '$merk_gps' , '$type_gps', '$waranty', '$buy_date', '$sold_date', '$description', '$photo' )");

    if ($querytambah) {
        # code redicet setelah insert ke table
        header("location:../home-admin/table.php");
    }
    else{
        echo "ERROR, tidak berhasil". pg_result_error($koneksi);
    }
}
elseif($_GET['act']=='updatedata'){
    $id_gps = $_POST['id_gps'];
    $name_gps = $_POST['name_gps'];
    $merk_gps = $_POST['merk_gps'];
    $type_gps = $_POST['type_gps'];
    $waranty = $_POST['waranty'];
    $buy_date = $_POST['buy_date'];
    $sold_date = $_POST['sold_date'];
    $sold_to = $_POST['sold_to'];
    $description = $_POST['description'];
    $photo = $_POST['photo'];

    //query update
    $queryupdate = pg_query($koneksi, "UPDATE master_asset.asset_gps SET id_gps='id_gps', name_gps='$name_gps' , merk_gps='$merk_gps', type_gps='$type_gps', waranty='$waranty', buy_date='$buy_date', sold_date='$sold_date', sold_to='$sold_to', description='$description', photo='$photo' WHERE gps_id='$gps_id' ");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../home-admin/table.php");    
    }
    else{
        echo "ERROR, 0000000000000000data gagal diupdate". pg_result_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deletedata'){
    $id_gps = $_GET['id'];

    //query hapus
    $querydelete = pg_query($koneksi, "DELETE FROM master_asset.asset_gps WHERE id_gps = '$id_gps'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../home-admin/table.php");
    }
    else{
        echo "ERROR, data gagal dihapus". pg_result_error($koneksi);
    }

    pg_close($koneksi);
}
//Multi User Admin or User
if($_GET['act']== 'tambahuser'){
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stereotype = $_POST['stereotype'];
    //query
    $querytambah =  pg_query($koneksi, "INSERT INTO member.user_member VALUES('$user_id' , '$username' , '$password' , '$stereotype')");

    if ($querytambah) {
        # code redicet setelah insert ke table
        header("location:../home-admin/user.php");
    }
    else{
        echo "ERROR, tidak berhasil". pg_result_error($koneksi);
    }
}
elseif($_GET['act']=='updateuser'){
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stereotype = $_POST['stereotype'];

    //query update
    $queryupdate = pg_query($koneksi, "UPDATE member.user_member SET user_id='$user_id', username='$username' , password='$password', stereotype='$stereotype' WHERE user_id='$user_id' ");

    if ($queryupdate) {
        # credirect ke page index
        header("location:../home-admin/user.php");    
    }
    else{
        echo "ERROR, 0000000000000000data gagal diupdate". pg_result_error($koneksi);
    }
}
elseif ($_GET['act'] == 'deleteuser'){
    $id_gps = $_GET['id'];

    //query hapus
    $querydelete = pg_query($koneksi, "DELETE FROM member.user_member WHERE user_id = '$user_id'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../home-admin/user.php");
    }
    else{
        echo "ERROR, data gagal dihapus". pg_result_error($koneksi);
    }

    pg_close($koneksi);
}
?>