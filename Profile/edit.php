<!doctype html>
<?php
	require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	require $dbConnector_php; 
	session_start();
	$ID = -1;
	if(isset($_GET['q']))
	{
		if(isset($_SESSION['uid'])) $ID = $_SESSION['uid'];
		$usernameGET = $_GET['q'];
		if(!pg_fetch_row(pg_query($db_connection,"select username from users where username='$usernameGET'")))
		{
			header("Location: $index_php");
			exit;
		}
	}
	
	$ID = $_SESSION['uid'];
	$err = ""; 
	$e_success = "";
	$u_success = "";
	$m_success = "";
	$p_success = "";
	if(isset($_POST['mail']) or isset($_POST['uname']) or isset($_POST['mob']) or isset($_POST['pwd'])){
		$ID = $_SESSION['uid'];
		$mail = $_POST['mail'];
		$uname = $_POST['uname'];
		$mob = $_POST['mob'];
		$pwd = $_POST['pwd'];
		$rpwd = $_POST['rpwd'];
		$err = "";
	
		if($pwd != $rpwd){
			$err = $err."*Both the passwords should be same";
		}
		else if($pwd != null && $pwd == $rpwd ){
			$pwd = md5($pwd);
			$query = "UPDATE users SET pass = '$pwd' where uid = $ID;";
			$res = pg_query($db_connection,$query);
		
			if ($res) {
				  $p_success = $p_success."Your Password has been updated";
			} 
			else{
				$p_success = $p_success."Error";
			}
		}
		
		if($mail != null and strlen(trim($_REQUEST['mail'])) != 0){
			$query = "UPDATE users SET email = '$mail' WHERE uid = '$ID';";
			$res = pg_query($db_connection,$query);
		
			if ($res) {
				  $e_success = $e_success."Your Email has been updated";
			} 
			else{
				$e_success = $e_success."Error";
			}
		}
		
		// This field has been now removed 
		if($uname != null and strlen(trim($_REQUEST['uname'])) != 0){
			$query = "UPDATE users SET username = '$uname' WHERE uid = '$ID';";
			$res = pg_query($db_connection,$query);
		
			if ($res) {
				  $u_success = $u_success."Your Username has been updated";
			} 
			else{
				$u_success = $u_success."Error";
			}
		}
		
		if($mob != null and strlen(trim($_REQUEST['mob'])) != 0){
			$query = "UPDATE users SET mobile = '$mob' WHERE uid = '$ID';";
			$res = pg_query($db_connection,$query);
		
			if ($res) {
				  $m_success = $m_success."Your Mobile number has been updated";
			} 
			else{
				$m_success = $m_success."Error";
			}
		}
	
		
	}
	

?>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Update Profile</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<link rel="stylesheet" type="text/css" href=<?php echo $navbar_css;?>>
	<link rel="stylesheet" type="text/css" href=<?php echo $profile_css;?>>
	<link rel="stylesheet" type="text/css" href=<?php echo $footer_css;?>>
	<link rel="stylesheet" type="text/css" href=<?php echo $w3_css;?>>
	<link rel="stylesheet" type="text/css" href=<?php echo $loggedInProfile_css;?>>
	<link rel="stylesheet" href=<?php echo $bootstrap."css/bootstrap.min.css";?>>
	<script src=<?php echo $bootstrap."js/bootstrap.min.js";?>></script>
	<script src=<?php echo $jQuery_js?>></script>
	
		
</head>

<body>
	<div id="NavBar"><?php include $navbar_php; ?></div>
	<div id="sidebar" style="padding-left:20px; position:fixed; height:100%" class="col-lg-2"><?php include $sidebar_php; ?></div>
	
	<div class="col-md-8 col-md-offset-2">
		<div class="card">
			<div class="header">
				<h4 class="title">Edit Profile</h4>
			</div>
			<div class="content">
				<form action = "edit.php" method = "post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Email address</label>
								<input type="email" class="form-control" name = "mail">
							</div>
							<div><?php echo "<p style= 'color:green;'>$e_success</p>"?></div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Mobile Number</label>
								<input type="text" class="form-control" name = "mob">
							</div>
							<div><?php echo "<p style= 'color:green;'>$m_success</p>"?></div>
						</div>
					</div>
					<div class="row">
							
						<div class="col-md-6">
							<div class="form-group">
								<label>Password</label>
								<input type="password"  class="form-control" name = "pwd">
							</div>
							<div><?php echo "<p style= 'color:green;'>$p_success</p>"?></div>
						</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Repeat Password</label>
									<input type="password"  class="form-control" name = "rpwd" >
								</div>
							</div>
					</div>
					<?php
						echo "<p style = 'color:red;'>$err</p>";
					?>
					<button type="submit" class="btn btn-info btn-fill pull-right" name = "submit">Update Profile</button>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
	
	