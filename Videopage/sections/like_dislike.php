<?php
	require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	require $dbConnector_php;
	session_start();
	if(isset($_GET['vid']))
	{
		$vid = $_GET['vid'];
		if(isset($_SESSION['uid']))
		{
			$ID = $_SESSION['uid'];
			$queryUpdate = "select * from videos where vid=$vid";
			$result = pg_fetch_row(pg_query($db_connection,$queryUpdate));
			$query3 = "select $ID = ANY('$result[7]'::int[])";
			$rQuery3 = pg_query($db_connection,$query3);
			$arr = explode(",",trim($result[7],"{}"));
			if(pg_fetch_row($rQuery3)[0] == 't')
			{
				$queryRemove = "UPDATE videos SET likes = array_remove(likes,$ID) WHERE vid=$vid";
				pg_query($db_connection,$queryRemove);
				$query = "UPDATE users SET likedvid = array_remove(likedvid,$vid) WHERE uid=$ID";
				pg_query($db_connection,$query);
?>
			<button style="color:black;" onclick="like()" id="like">
							<span class="glyphicon glyphicon-thumbs-up"></span>  Like</button>   <code><?php echo count($arr)-1; ?></code></li>
<?php
			}
			else
			{
				$queryRemove = "UPDATE videos SET likes = array_append(likes,$ID) WHERE vid=$vid";
				pg_query($db_connection,$queryRemove);
				$query = "UPDATE users SET likedvid = array_append(likedvid,$vid) WHERE uid=$ID";
				pg_query($db_connection,$query);
?>
			<button style="color:red;" onclick="like()" id="like">
							<span class="glyphicon glyphicon-thumbs-up"></span>  Liked</button>   <code><?php if($arr[0] == "") echo 1; else echo count($arr)+1; ?></code></li>
<?php 
			}
		}
		else
		{
			header("Location: $videopage_php?q=$vid");
		}
	}
	else
	{
		header("Location: $index_php");
	}
?>