<?php
	session_start();					//starting session
	unset($_SESSION['uid']);		//unsetting session parameters
	session_destroy();					//killing session
	header("Location: ../index.php");
?>