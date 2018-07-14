<?php
	require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	require $dbConnector_php;
	session_start();
	if(isset($_POST['submit'])){
		$ID = $_SESSION['uid'];
		$title = $_SESSION['vidTitle'];
		$date = date('Y-m-d H:i:s');
		$desc = $_POST['desc'];
		$choice = $_POST['choice'];
		$option = $_POST['option'];
		$thumb = $_POST['thumb'];
		$ext = $_SESSION['ext'];
		rename("uploadThumbnail/bin/$thumb","$users/$ID/videos/$title.jpg");
		array_map('unlink', glob("uploadThumbnail/bin/tempThumb/*.jpg"));
		$option = explode(',',$option);
		$newOption = $choice;
		$cnt = 1;
		$val = 3;
		for($i=0;$i<count($option);$i=$i+1)
		{
			if(strlen($option[$i])<3)continue;
			if($cnt>$val)break;
			$newOption = $newOption.",".trim($option[$i]);
			$cnt=$cnt+1;
		}
		$newOption = "'{".$newOption."}'";
		$InsertQuery = "INSERT INTO videos (title,pic,summary, uid, seen,likes,cid, uploaddate,tags,ext) VALUES ('$title','$title.jpg','$desc',$ID,'{}','{}','{}','$date',$newOption,'$ext')";
		$flag = pg_query($db_connection,$InsertQuery);
		$query = "select vid from videos where uid=$ID ORDER BY vid desc";
		$result = pg_fetch_row(pg_query($db_connection,$query));
		$userUpdate = "UPDATE users SET uploadvid = array_append(uploadvid,$result[0]) where uid=$ID";
		$flag = pg_query($db_connection,$userUpdate);
	}
	header("Location: ".$profile_php."?q=".$_SESSION['uname']);
?>