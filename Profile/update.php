<?php
	$mail = $_POST['mail'];
	$uname = $_POST['uname'];
	$mob = $_POST['mob'];
	$pwd = $_POST['pwd'];
	$rpwd = $_POST['rpwd'];
	
	if(isset($_POST['mail']) or isset($_POST['uname']) or isset(['mob']) or isset(['pwd'])){
		echo "Button is pressed";
		require $dbConnector_php; 
		if(!$db_connection){
			echo "ËRROR";
		}
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
			$query = "UPDATE users SET pass = md5($pwd) where uid = $ID;";
			if(!$query){
				echo "ERROR";
			}
			$result = pg_query($db_connection,$query);
		}
		
		if($mail != null){
			$query = "UPDATE users SET (email) = ('$mail') WHERE uid = '$ID';";
			$result = pg_query($db_connection,$query);
			if(!$result){
				echo "Error";
			}
		}
		
		if($uname != null){
			
		}
		
		if($mob !=null){
			
		}

?>