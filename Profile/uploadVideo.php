<?php
	require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	require $dbConnector_php;
	session_start();
	if(isset($_POST['submit']) and isset($_SESSION['uid']))
	{
		$name = $_FILES['uploadedvideo']['name'];
		$tmpName = $_FILES['uploadedvideo']['tmp_name'];
		$desc = $_POST['desc'];
		$ext = explode('.',$name);
		$title='';
		for($y=0;$y<count($ext)-1;$y++) 
		{
			if($y==0) $title = $ext[0];
			else $title = $title.".".$ext[$y];
		}
		$title = pg_escape_string($title);
		$choice = $_POST['choice'];
		$option = $_POST['option'];
		if($choice != '')
		{
			$ext = strtolower($ext[count($ext)-1]);
			if($ext === 'mp4' or $ext === "mov"  or $ext === "3gp")
			{
				$target = $users.$_SESSION['uid'].'/videos/'.$name;
				$flag = move_uploaded_file($tmpName,$target);
				if($flag)
				{
					$ID = $_SESSION['uid'];
					$date = date('Y-m-d H:i:s');
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
					$InsertQuery = "INSERT INTO videos (title, summary, uid, seen,likes,cid, uploaddate,tags,ext) VALUES ('$title','$desc',$ID,'{}','{}','{}','$date',$newOption,'$ext')";
					$flag = pg_query($db_connection,$InsertQuery);
					$query = "select vid from videos where uid=$ID ORDER BY vid desc";
					$result = pg_fetch_row(pg_query($db_connection,$query));
					$userUpdate = "UPDATE users SET uploadvid = array_append(uploadvid,$result[0]) where uid=$ID";
					$flag = pg_query($db_connection,$userUpdate);
				}
			}
		}
	}
	$ID=$_SESSION['uid'];
	$query = "select username from users where uid='$ID'";
	$result = pg_fetch_row(pg_query($db_connection,$query));
	header("Location: profile.php?q=$result[0]");
?>