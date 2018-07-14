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
		$check = pg_query($db_connection,"select * from users where username='$usernameGET'");
		$val = pg_fetch_array($check);
		if(!$val)
		{
			header("Location: $index_php");
			exit;
		}
	
?>


<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Profile</title>
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />

		<!--  Light Bootstrap Table core CSS   
		<link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
		 -->
		<style>
			h4{
				font-family: Segoe UI;
			}
			
			h2{
				font-family:  Papyrus;
			}

		</style>
		
		
		<link rel="stylesheet" type="text/css" href=<?php echo $footer_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $profile_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $navbar_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $videosLayout_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $videosCategory_css;?>> 
		<link rel="stylesheet" type="text/css" href=<?php echo $w3_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $loggedInProfile_css;?>>
		<script src=<?php echo $jQuery_js;?>></script>
		<link rel="stylesheet" href=<?php echo $bootstrap."css/bootstrap.min.css";?>>
		<script src=<?php echo $bootstrap."js/bootstrap.min.js";?>></script>
	<script>
		
	</script>
	
	</head>
	 
	<body>
		 <div id="NavBar"><?php include $navbar_php; ?></div>
		<div id="sidebar" style="padding-left:20px; position:fixed; height:100%" class="col-lg-2"><?php include $sidebar_php; ?></div>
		
		<div class = "col-md-10 col-lg-offset-2">
			<?php
				$usernameGET = $_GET['q'];
				$query = "select * from users where username='$usernameGET'";
				$result = pg_fetch_row(pg_query($db_connection,$query));
				$uid = $result[0];
				$img = $images."cover1.png";
			?>
			<div class="card card-user">
				<div class="image" style = "height:200px;">
					<img src="<?php echo $img?>" alt="..." style = "height:200px;width:100%"/>
				</div>
				<div class="content" style = "background-color:	#EDEDED;">
					<div class="author" >
						<?php
							$usernameGET = $_GET['q'];
							$query = "select * from users where username='$usernameGET'";
							$result = pg_fetch_row(pg_query($db_connection,$query));
							$uid = $result[0];
							if($result[9] == null)
							{
								$img = $images."user.png";
							}
							else
							{
								$img = $usershost.$uid."/".$result[9];
							}					
						?>
						<img class="avatar border-gray" src="<?php echo $img; ?> " alt="..."/>
						<h4 class="title">Name : <?php echo $result[1]; ?><br />
							Email : <?php echo $result[2]; ?><br />
							Birthday : <?php 
												$b = explode('-',$result[5]);
												switch($b[1])
												{
													case "01": $c = "January"; break;
													case "02": $c = "February"; break;
													case "03": $c = "March"; break;
													case "04": $c = "April"; break;
													case "05": $c = "May"; break;
													case "06": $c = "June"; break;
													case "07": $c = "July"; break;
													case "08": $c = "August"; break;
													case "09": $c = "September"; break;
													case "10": $c = "October"; break;
													case "11": $c = "November"; break;
													case "12": $c = "Decemeber"; break;
												}
												echo $b[2]." ".$c." ".$b[0]; 
											?>
									<br />
									Username : <?php echo $result[6];?>
								</h4>
					</div>
					<?php 
					if( isset($_SESSION['uid']) and $_SESSION['uname'] == $usernameGET) 
						{ 
							
					?>
						<div align = "center" style = "margin-top:5px;"><a href = "edit.php"><button type="button" class="btn btn-primary">EDIT</button></a></div>
					<?php
						}
						else
						{
							$val = $val['uid'];
							$checkquery = "select * from users where uid=$val AND '{".$ID."}' <@ subby";
							$flag = pg_fetch_row(pg_query($db_connection,$checkquery));
					?>
						<div align = "center" style = "margin-top:5px;"><button type="button"  class="btn btn-primary" id="SButton"><?php if($flag) echo "Unsubscribe"; else echo "Subscribe"; ?></button></div>
						<script>
							$(document).ready(function(){
								$('#SButton').click(function(){	
									Subscribe();
								});	
							});
						</script>
					<?php
						}
					?>
				</div>
			</div>
			<div class="container">
				<div class="row col-md-12">
					<div id="Title" style = "border-left:40px solid #008B8B"><h3 id="heading">My Videos</h3></div>
					<div class="col-lg-12" style="padding:0px;">
						<div class="col-lg-12" style="padding:0px;">
							<div class="col-lg-12" style="margin-left:10px;">
								<?php
									$username = $_GET['q'];
									$query="Select * from videos where uid = (select uid from users where username='$username')";
									$result=pg_query($db_connection,$query);
									$r = pg_fetch_row($result);
									if($r)
									{
										while($r)
										{ 
											$targetURL = $videopage_php."?q=".$r[0];
								?>
								<div id="videoLayout" style="width:25%;">
									<div id="videoImage"><img class="image" src=<?php echo $usershost.$r[4].'/videos/'.rawurlencode($r[5]);?>></div>
									<div id="videoName" title="<?php echo $r[1] ?>"><?php if(strlen($r[1])>15)echo substr($r[1],0,14)."...";else echo $r[1]?></div>
									<a class="WatchAnchor" href="<?php echo $targetURL; ?>"><div id="watch">Watch Now</div></a>
								</div>
								<?php
										$r = pg_fetch_row($result);
										}
									}
									else
									{
								?>
								<h4>No video to display...</h4>
								<?php 
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container col-md-6">
				<div id="Title" style = "border-left:40px solid #008B8B"><h3 id="heading">Subscribers</h3></div><br>
				<div id="Subscribers">
				<?php 
					$result = pg_query($db_connection,"select subby from users where username='$usernameGET'");
					$row = pg_fetch_array($result);
					$row = explode(",",trim($row[0],"{}"));
					if($row[0] != '')
					{
						$cnt = count($row);
						while($cnt)
						{
							$uid = (int)$row[$cnt-1];
							$cnt = $cnt-1;
							$query = "select name,username,photo from users where uid=$uid";
							$result = pg_fetch_row(pg_query($db_connection,$query));
							$url = $profile_php."?q=".$result[1];
							if($result[2] == null)
							{
								$photo = $images."user.png";
							}
							else
							{
								$photo = $usershost.$uid."/".$result[2];
							}
							
				?>
			<div class="col-lg-8 col-lg-offset-2 hover" style="float:left;background-color:#008B8B; padding:5px;<?php if($cnt != 0) echo 'border-bottom:1px solid white;';?>">
					<a  style="text-decoration:none;color:white;font-size:12px;" href="<?php echo $url; ?>">
						<div class="col-lg-2" >
							<img style="width:50px;height:44px;" src="<?php echo $photo; ?>" style = "padding:10px;"/>
						</div>
						<div class="col-lg-10" style="padding:3px;">
							<p align="center" style="font-size:20px"><?php  echo $result[0] ?></p>
						</div>
					</a>
				</div> 
			
				<?php
						}
					}
					else
					{
				?>
				<h4>No Subscribers...</h4> 	
				<?php
					}
				?>	
			</div>
			</div>
			<div class = "col-md-6 ">
					<div id="Title" style = "border-left:40px solid #008B8B"><h3 id="heading">Subscriptions</h3></div><br>
					<?php 
						$result = pg_query($db_connection,"select subto from users where username='$usernameGET'");
						$row = pg_fetch_array($result);
						$row = explode(",",trim($row[0],"{}"));
						if($row[0] != '')
						{
							$cnt = count($row);
							while($cnt)
							{
								$uid = (int)$row[$cnt-1];
								$cnt = $cnt-1;
								$query = "select name,username,photo from users where uid=$uid";
								$result = pg_fetch_row(pg_query($db_connection,$query));
								$url = $profile_php."?q=".$result[1];
								if($result[2] == '')
								{
									$photo = $images."user.png";
								}
								else
								{
									$photo = $usershost.$uid."/".$result[2];
								}
					?>
						<div class="col-md-8 col-md-offset-2 hover" style="padding:5px;float:left;background-color:#008B8B;<?php if($cnt != 0) echo 'border-bottom:1px solid white;';?>">
							<a  style="text-decoration:none;color:white;" href="<?php echo $url; ?>">
								<div class="col-lg-2">
									<img style="width:50px;height:44px;" src="<?php echo $photo; ?>"/>
								</div>
								<div class="col-lg-10" style="padding:3px;">
									<p align="center" style="font-size:20px;"><?php  echo $result[0] ?></p>
								</div>
							</a>
						</div>
					<?php
							}
						}
						else
						{
					?>
					<h4>No Subscriptions...</h4>
					<?php
						}
					?>			
			</div>
			<div class="col-lg-12">
				<div id="Footer" style="margin-top:75px;"><?php include $footer_php; ?></div>
			</div>
		</div>
		<script type="text/javascript">
			function Subscribe() {
			  var xhttp = new XMLHttpRequest();
			  console.log('Inside Subscribe');
			  var x = document.getElementById("SButton");
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
					console.log('inside function');
					
					document.getElementById("Subscribers").innerHTML=this.responseText;
					var z = x.innerHTML;
					
					if(z == 'Subscribe')
					{
						x.innerHTML = "Unsubscribe";
						console.log('unsubscribe');	
					}
					else
					{
						x.innerHTML = "Subscribe";
						console.log('subscribe');	
						
					}
			
				}
			  };

			  xhttp.open("GET", "subscribe.php?fID="+"<?php echo $ID."&"."tUN=".$usernameGET."&"."state=";?>"+x.innerHTML, true);
			  xhttp.send();
			}
			
		</script>
	</body>
</html>
<?php 
	}
	else
	{
		header("Location: $index_php");
	}
?>
