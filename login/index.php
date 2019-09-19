<?php
	session_start();
	require_once("config.php");

	if (isset($_POST['submit'])){
		$ambil = pg_query("SELECT * FROM member.user_member WHERE username='$_POST[username]' AND password='$_POST[password]'");
		if (pg_num_rows($ambil) == 1){
			//Jika Berhasil
			$qry = pg_fetch_array($ambil);
			$_SESSION['username'] = $qry['username'];
			$_SESSION['password'] = $qry['password'];
			$_SESSION['stereotype'] = $qry['stereotype'];
			if ($qry['stereotype'] == "ADMIN"){
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../home-admin/dashboard.php">';
			} else if($qry['stereotype'] == "USER"){
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../home-user/dashboard.php">';
			}
		} else { ?>
			
				<script languange="JavaScript">
				alert('Username atau Password tidak sesuai. Silahkan di ulang kembali');
				document.location='index.php';
				</script>
			<?php
		}
	} 
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sistem Informasi Data Alat GPS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!---Icon Header--->
		<link rel="icon" type="image/png" href="../images/map-location.png" />
		<!---CSS Design---->
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<section>
			<div class="container-login">
				<div class="form_content">
					<h2>Sistem Informasi Data Alat GPS</h2>
				</div>
				<div class="login_form">
					<img src="../images/icon-user.png" style="width:20%; display: inline-block; margin-left: 120px; margin-right: 120px; align-items:center;">
					<h1 style="font-family: Comic sans Ms;">Sign In</h1>
					<form method="post">
						<input type="text" name="username" placeholder="Username">
						<input type="password" name="password" placeholder="Password">
						<input type="submit" name="submit" value="Login">
					</form>
				</div>
			</div>
		</section>
	</body>
</html>