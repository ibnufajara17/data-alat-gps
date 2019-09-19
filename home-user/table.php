<?php
  session_start();
  /*echo $_SESSION['level'];
  echo $_SESSION['nama'];*/
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8" />
  <link rel="icon" type="image/png" href="../images/map-location.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Dashboard Data Alat GPS</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../plugins/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../plugins/dist/css/skins/_all-skins.min.css">
    <!-- jQuery 2.1.4 -->
    <!--<script src="../plugins/plugins/jQuery/jQuery-2.1.4.min.js"></script>-->

    <!-- Bootstrap core CSS     
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />-->

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project    
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Database Alat GPS
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="table.php">
                        <i class="pe-7s-note2"></i>
                        <p>Table List</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Table List</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">5</span>
									<p class="hidden-lg hidden-md">
										5 Notifications
										<b class="caret"></b>
									</p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <p>Welcome <b><?php echo $_SESSION['username']?></b></p>
                        </a>
                        <!--Menu Foot-->
                        <ul class="dropdown-menu">
                              <!-- Menu Footer-->
                              <li><a href="#" class="btn btn-info" data-target="#updateuser<?php echo $no; ?>">Edit Profile</a></li>
                              <li><a href="../logout.php" class="btn btn-danger">Logout</a></li>
                              <!-- modal update user -->
                              <div class="example-modal">
                                <div id="updateuser<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h3 class="modal-title">Edit Data User</h3>
                                      </div>
                                      <div class="modal-body">
                                        <form action="function_user.php?act=updateuser" method="post" role="form">
                                          <?php
                                          $user_id = $row['user_id'];
                                          $query = "SELECT * FROM member.user_member WHERE user_id='$user_id'";
                                          $result = pg_query($koneksi, $query);
                                          while ($row = pg_fetch_assoc($result)) {
                                          ?>
                                          <div class="form-group">
                                            <div class="row">
                                              <label class="col-sm-3 control-label text-right">USER ID <span class="text-red">*</span></label>         
                                              <div class="col-sm-8"><input type="text" class="form-control" name="user_id" placeholder="Id User" value="<?php echo $row['user_id']; ?>"></div>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <div class="row">
                                              <label class="col-sm-3 control-label text-right">Username <span class="text-red">*</span></label>
                                              <div class="col-sm-8"><input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $row['username']; ?>"></div>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <div class="row">
                                              <label class="col-sm-3 control-label text-right">Password <span class="text-red">*</span></label>
                                              <div class="col-sm-8"><input type="password" class="form-control" name="password" placeholder="Password" id="myPassword" value="<?php echo $row['password']; ?>">
                                                <input type="checkbox" onclick="myFunction()"> Lihat Password
                                                  <script>
                                                  function myFunction() {
                                                    var x = document.getElementById("myPassword");
                                                    if (x.type === "password") {
                                                      x.type = "text";
                                                    } else {
                                                      x.type = "password";
                                                    }
                                                  }
                                                  </script>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <div class="row">
                                              <label class="col-sm-3 control-label text-right">User Role <span class="text-red">*</span></label>
                                                <div class="col-sm-8"><select name="stereotype" class="form-control select2" value="" style="width: 100%;">
                                                  <option value="-" selected="selected">-- Pilih Satu --</option>
                                                  <option value="ADMIN">ADMIN</option>
                                                  <option value="USER">USER</option>
                                                </select>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button id="noedit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                                            <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                          </div>
                                          <?php
                                          }
                                          ?>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div><!-- modal update user -->
                          </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p>
									Dropdown
									<b class="caret"></b>
								</p>

                            </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="#">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="content">
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">List Data GPS</h3> 
                  <div class="box-tools pull-left">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahdata"><i class="fa fa-plus-square"></i> Tambah Data </a>
                  </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                               <!--<th style="visibility: hidden;">GPS ID</th>-->
                              <th style="text-align: center;">ID GPS</th>
                              <th style="text-align: center;">Nama GPS</th>
                              <th style="text-align: center;">Merk GPS</th>
                              <th style="text-align: center;">Type GPS</th>
                              <th style="text-align: center;">Garansi</th>
                              <th style="text-align: center;">Tanggal Pembelian</th>
                              <th style="text-align: center;">Tanggal Penjualan</th>
                              <th style="text-align: center;">Pihak Pembeli</th>
                              <th style="text-align: center;">Deskripsi</th>
                              <th style="text-align: center;">Foto</th>
                              <th style="text-align: center;">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            include "../config.php";
                            $gps_id = 1;
                            $queryview = pg_query($koneksi, "SELECT * FROM master_asset.asset_gps");
                            while ($row = pg_fetch_assoc($queryview)) {
                          ?>
                          <tr>
                            <!--<td style="visibility: hidden;"><?php echo $gps_id++;?></td>-->
                            <td><?php echo $row['id_gps'];?></td>
                            <td><?php echo $row['name_gps'];?></td>
                            <td><?php echo $row['merk_gps'];?></td>
                            <td><?php echo $row['type_gps'];?></td>
                            <td><?php echo $row['waranty'];?></td>
                            <td style="text-align: center;"><?php echo $row['buy_date'];?></td>
                            <td style="text-align: center;"><?php echo $row['sold_date'];?></td>
                            <td><?php echo $row['sold_to'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td><?php echo $row['photo'];?></td>
                            <td style="text-align: center;"> <!--<a href="../user/form_edituser.php?id=<?php echo $row['id_user']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                                <a href="javascript:bukaEditData()" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updatedata<?php echo $gps_id; ?>"><i class="fa fa-pencil"></i> Edit</a>
                                <a href="javascript:bukaDeleteData()" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletedata<?php echo $gps_id; ?>"><i class="fa fa-trash"></i> Delete</a>

                                    <!-- modal delete -->
                                  <div class="example-modal">
                                    <div class="modal fade" id="deletedata <?php echo $gps_id; ?>" tabindex="-1" role="dialog" aria-label="close" aria-hidden="true" style="display:none;">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h3 class="modal-title">Konfirmasi Delete Data GPS</h3>
                                          </div>
                                          <div class="modal-body">
                                            <h4 align="center" >Apakah anda yakin ingin menghapus data gps <?php echo $row['id_gps'];?><strong><span class="grt"></span></strong> ?</h4>
                                          </div>
                                          <div class="modal-footer">
                                            <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                                            <a href="function_admin.php?act=deletedata&id=<?php echo $row['id_gps']; ?>" class="btn btn-primary">Delete</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div><!-- modal delete -->
                                  <!-- modal update user -->
                                  <div class="example-modal">
                                    <div id="updatedata<?php echo $gps_id; ?>" class="modal fade" role="dialog" style="display:none;">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h3 class="modal-title">Edit Data GPS</h3>
                                          </div>
                                          <div class="modal-body">
                                            <form action="function_admin.php?act=updatedata" method="post" role="form">
                                              <?php
                                              $id_gps = $row['id_gps'];
                                              $query = "SELECT * FROM master_asset.asset_gps WHERE id_gps='$id_gps'";
                                              $result = pg_query($koneksi, $query);
                                              while ($row = pg_fetch_assoc($result)) {
                                              ?>
                                             <div class="form-group">
                                              <div class="row">
                                                  <label class="col-sm-3 control-label text-right">Nama GPS <span class="text-red">*</span></label>
                                                  <div class="col-sm-8"><input type="text" class="form-control" name="name_gps" placeholder="Nama GPS" value=""></div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <div class="row">
                                                  <label class="col-sm-3 control-label text-right">Merk GPS <span class="text-red">*</span></label>
                                                  <div class="col-sm-8"><input type="text" class="form-control" name="merk_gps" placeholder="Merk GPS" value=""></div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                  <label class="col-sm-3 control-label text-right">Type GPS <span class="text-red">*</span></label>
                                                  <div class="col-sm-8"><input type="text" class="form-control" name="type_gps" placeholder="Type GPS" value=""></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Garansi<span class="text-red">*</span></label>
                                                      <div class="col-sm-8"><select name="waranty" class="form-control select2" value="" style="width: 100%;">
                                                          <option value="-" selected="selected">-- Pilih Satu --</option>
                                                          <option value="3month">3 Month</option>
                                                          <option value="6month">6 Month</option>
                                                          <option value="10month">10 Month</option>
                                                          <option value="1year">1 Year</option>
                                                        </select>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                              <div class="row">
                                                  <label class="col-sm-3 control-label text-right">Tanggal Pembelian<span class="text-red">*</span></label>
                                                  <div class="col-sm-8"><input type="date" class="form-control" name="buy_date" value=""></div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                  <label class="col-sm-3 control-label text-right">Tanggal Penjualan<span class="text-red">*</span></label>
                                                  <div class="col-sm-8"><input type="date" class="form-control" name="sold_date" value=""></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                  <label class="col-sm-3 control-label text-right">Deskripsi <span class="text-red">*</span></label>
                                                  <div class="col-sm-8"><input type="text" class="form-control" name="description" placeholder="Tulis Deskripsi" value=""></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                              <div class="row">
                                              <label class="col-sm-3 control-label text-right">Foto <span class="text-red">*</span></label>
                                                     <form action="upload-files.php" method="post" name="photo" enctype="multipart/form-data">
                                                        Select image to upload:
                                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                                    </form>
                                                </div>
                                            </div>
                                              <div class="modal-footer">
                                                <button id="noedit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                                                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                              </div>
                                              <?php
                                              }
                                              ?>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div><!-- modal update user -->
                                </td>
                            </tr>
                          <?php
                            }
                          ?>
                      </tbody>
                    </table>
                  </div> 
                </section> 
                 <!-- modal insert -->
                <div class="example-modal">
                  <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" style="display:none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close"><span aria-hidden="false">&times;</span></button>
                          <h3 class="modal-title">Tambah Aset GPS</h3>
                        </div>
                        <div class="modal-body">
                          <form action="function_admin.php?act=tambahdata" method="post" role="form">
                            <div class="form-group">
                              <div class="row">
                              <label class="col-sm-3 control-label text-right">ID GPS <span class="text-red">*</span></label>      
                              <div class="col-sm-8">
                                <input type="text" class="form-control" name="id_gps" placeholder="ID GPS" value="" /></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                              <label class="col-sm-3 control-label text-right">Nama GPS <span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="text" class="form-control" name="name_gps" placeholder="Nama GPS" value=""></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                              <label class="col-sm-3 control-label text-right">Merk GPS <span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="text" class="form-control" name="merk_gps" placeholder="Merk GPS" value=""></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                              <label class="col-sm-3 control-label text-right">Type GPS <span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="text" class="form-control" name="type_gps" placeholder="Type GPS" value=""></div>
                              </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label text-right">Garansi<span class="text-red">*</span></label>
                                      <div class="col-sm-8"><select name="waranty" class="form-control select2" value="" style="width: 100%;">
                                          <option value="-" selected="selected">-- Pilih Satu --</option>
                                          <option value="3month">3 Month</option>
                                          <option value="6month">6 Month</option>
                                          <option value="10month">10 Month</option>
                                          <option value="1year">1 Year</option>
                                        </select>
                                      </div>
                                  </div>
                              </div>
                            <div class="form-group">
                              <div class="row">
                              <label class="col-sm-3 control-label text-right">Tanggal Pembelian<span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="date" class="form-control" name="buy_date" value=""></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                              <label class="col-sm-3 control-label text-right">Tanggal Penjualan<span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="date" class="form-control" name="sold_date" value=""></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                              <label class="col-sm-3 control-label text-right">Deskripsi <span class="text-red">*</span></label>
                              <div class="col-sm-8"><input type="text" class="form-control" name="description" placeholder="Tulis Deskripsi" value=""></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                              <label class="col-sm-3 control-label text-right">Foto <span class="text-red">*</span></label>
                                    <form action="upload-files.php" method="post" name="photo" enctype="multipart/form-data">
                                        Select image to upload:
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                    </form>
                              </div>
                            </div>
                          </form>
                          <div class="modal-footer">
                              <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- modal insert close -->
              </div>
            </div>
          </div>
        </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>


    </div>
</div>


</body>

   
    <!--   Core JS Files   -->
  <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

  <!--  Charts Plugin -->
  <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
  <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

  <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->

  <!-- Bootstrap 3.3.5 -->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../plugins/dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../plugins/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../plugins/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../plugins/plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for demo purposes -->
    <script src="../plugins/dist/js/demo.js"></script>


</html>
