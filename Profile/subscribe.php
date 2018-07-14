<?php
	require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	require $dbConnector_php;
	$SubscribedByID = $_GET['fID'];
	$SubscribedToUsername = $_GET['tUN'];
	if($_GET['state']=="Subscribe")
	{
		$query = "Update users SET subby = array_append(subby,$SubscribedByID) where username='$SubscribedToUsername'";
		pg_query($db_connection,$query);
		$query = "select uid from users where username='$SubscribedToUsername'";
		$result = pg_fetch_row(pg_query($db_connection,$query));
		$query = "UPDATE users SET subto = array_append(subto,$result[0]) where uid=$SubscribedByID";
		if(pg_query($db_connection,$query)) echo "<script>alert('Getting Subscribed');</script>";
	}
	else 
	{
		$query = "Update users SET subby = array_remove(subby,$SubscribedByID) where username='$SubscribedToUsername'";
		pg_query($db_connection,$query);
		$query = "select uid from users where username='$SubscribedToUsername'";
		$result = pg_fetch_row(pg_query($db_connection,$query));
		$query = "UPDATE users SET subto = array_remove(subto,$result[0]) where uid=$SubscribedByID";
		if(pg_query($db_connection,$query)) echo "<script>alert('Getting Unsubscribed');</script>";
	}
	
	$result = pg_query($db_connection,"select subby from users where username='$SubscribedToUsername'");
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
			$url = "http://localhost:8080/files/web/profile.php?q=".$result[1];
			if($result[2] == null)
			{
				$photo = $images."user.png";
			}
			else
			{
				$photo = $usershost.$uid."/".$result[2];
			}
?>
<div class="col-lg-10 col-lg-offset-1 hover" style="padding:5px;float:left;background-color:#008B8B; padding:7px;<?php if($cnt != 0) echo 'border-bottom:1px solid white;';?>">
	<a  style="text-decoration:none;color:white;font-size:12px;" href="<?php echo $url; ?>">
		<div class="col-lg-4" style="padding-left:7px;padding-right:7px;">
			<img style="width:50px;height:44px;" src="<?php echo $photo; ?>"/>
		</div>
		<div class="col-lg-8" style="padding:0px;padding-top:10px;">
			<p style="margin-left:15px; font-size:20px;"><?php  echo $result[0] ?></p>
		</div>
	</a>
</div>
<?php
		}
	}
	else
	{
?>
<h4>No Subscribers..</h4>
<?php
	}
?>