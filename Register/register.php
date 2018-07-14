<?php
require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	if(isset($_POST['submit']))
	{
		require $dbConnector_php;
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = md5($_POST['pass']);
		$cpassword = md5($_POST['cpass']);
		if($password===$cpassword)
		{
			$username = $_POST['uname'];
			$gender = $_POST['gender'];
			$dob = $_POST['dob'];
			$mobile = $_POST['phone'];	
			$query = "select * from users where email='$email' or username='$username'";
			$result = pg_query($db_connection,$query);
			$result = pg_fetch_row($result);
			if(count($result)>1);
			else 
			{
				$photo = $_FILES['profilePicture']['name'];
				$ext = explode('.',$photo);
				$ext = strtolower($ext[count($ext)-1]);
				$p = $username.'.'.$ext;
				if($gender === 'Female') $gender = 'F';
				else $gender = 'M';
				if($ext === 'png' or $ext === 'jpg' or $ext === 'jpeg') $photo=$p;
				else $photo='';
				
				$InsertQuery = "INSERT INTO users (name, email, mobile, sex, dob, username, pass, plink, photo) 
								VALUES ('$name', '$email', '$mobile', '$gender', '$dob', '$username', '$password', '$profile_php?q=$username', '$photo')";
				$flag = pg_query($db_connection,$InsertQuery);
				$r = pg_query($db_connection,"select uid from users where username='$username'");
				$r = pg_fetch_row($r);
				
				if($flag) {
					mkdir($users.$r[0]);
					mkdir($users.$r[0].'/videos');
				}
				
				if($flag && $photo != '')
				{
					move_uploaded_file($_FILES['profilePicture']['tmp_name'],$users.$r[0].'/'.$p);
				}
			}
		}
	}
	header("Location: $index_php");
	exit;
?>