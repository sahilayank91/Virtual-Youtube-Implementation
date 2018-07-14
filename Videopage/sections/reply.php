<?php
	require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	require $dbConnector_php;
	session_start();
	if(isset($_SESSION['uid']) && isset($_GET['vid']) && isset($_GET['text']) && isset($_GET['cid']))
	{
		$ID = $_SESSION['uid'];
		$vid = $_GET['vid'];
		$commentNumber = $_GET['cid'];
		$text = pg_escape_string($_GET['text']);
		$date = date('Y-m-d H:i:s');
		$query = "INSERT INTO comments (info,vid,uid,comdate) VALUES ('$text',$vid,$ID,'$date')";
		$flag = pg_query($db_connection,$query);
		$query = "select * from comments where uid=$ID order by cid desc";
		$result = pg_fetch_array(pg_query($db_connection,$query));
		$cid =  $result['cid'];
		$updateQuery = "UPDATE comments SET replies = array_append(replies,$cid) where cid=$commentNumber";
		$flag = pg_query($db_connection,$updateQuery);
		if($flag)
		{	
			$query1 = "select * from users where uid=$ID";
			$result1 = pg_fetch_array(pg_query($db_connection,$query1));
?>
			<div id="oldreply" class="col-lg-12">
				<div class="col-lg-12" id="Replier"><a href="<?php echo $result1['plink']; ?>"><img src=<?php echo $usershost.$result1['uid']."/".$result1['photo']; ?> alt="*_*" style="background-color:white;border-radius:20px;width:25px;height:25px;margin-top:2px;"/>&nbsp;&nbsp;<?php echo $result1['name']; ?></a></div>
				<div class="col-lg-4" id="ReplyingTime"><?php echo $result['comdate']; ?></div>
				<div id="replyContent" class="col-lg-12"><?php echo $result['info']; ?></div>
			</div>
<?php
		}
	}
	else
	{
		header("Location: $index_php");
	}
?>