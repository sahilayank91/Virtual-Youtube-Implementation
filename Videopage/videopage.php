<?php
	require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	require $dbConnector_php;
	session_start();
	if(!isset($_GET['q']))
	{
		header("Location: $index_php");
	}
	$vid = $_GET['q'];
?>

<!doctype html>

<html lang="en">
	
	<head>
	
		<title>Video Title</title>
		
		<link rel="stylesheet" type="text/css" href=<?php echo $navbar_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $relatedVideos_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $videosLayout_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $footer_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $commentSection_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $w3_css;?>>
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
	
		<nav id="NavBar"><?php include $navbar_php;?></nav>
		<div id="middleContent" class="col-lg-12">
			<div id="sidebar" class="col-lg-2"><?php include $sidebar_php;?></div>
			<div id="VideoSection" class="col-lg-10">
				<div id="VideoParts" class="col-lg-9">
					<div id="VideoPlayer" class="col-lg-12"><?php include $videoPlayer_php;?></div>
					<div id="VideoDetails" class="col-lg-12"><?php include $videoDetails_php;?></div>
					<div id="VideoComments" class="col-lg-12"><?php include $videoComments_php;?></div>
				</div>
				<div id="RelatedVideos" class="col-lg-3"><?php include $relatedVideos_php;?></div>
			</div>
		</div>
		<div id="Footer" class="col-lg-12"><?php include $footer_php;?></div>
	</body>
	
</html>							