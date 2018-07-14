<?php
	require 'path.php';
	require $dbConnector_php;
	session_start();
?>

<!doctype html>

<html lang="en">
	
	<head>
	
		<title>Youtube</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href=<?php echo $w3_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $navbar_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $videosCategory_css; ?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $videosLayout_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $footer_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $loggedInProfile_css;?>>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		
		<link rel="stylesheet" href=<?php echo $bootstrap."css/bootstrap.min.css";?>>
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		
		<script src=<?php echo $bootstrap."js/bootstrap.min.js";?>></script>
		<script src=<?php echo $jQuery_js;?>></script>
		
	</head>
	
	<body>
	
		<div id="NavBar"><?php include $navbar_php; ?></div>
		<div id="sidebar" style="padding-left:20px; position:fixed; height:100%" class="col-lg-2"><?php include $sidebar_php; ?></div>
		<div class="col-lg-10 col-lg-offset-2">
			<div id="Trending" class="col-lg-12"><?php include $trending_php; ?></div>
			<div id="Recommended" class="col-lg-12"><?php include $recommended_php; ?></div>
		</div>
		<div id="Footer" class="col-lg-10 col-lg-offset-2"><?php include $footer_php; ?></div>
	</body>
	
</html>