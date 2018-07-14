<?php

require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
require $dbConnector_php;
	

?>
<html>
<head>
<title>Team</title>
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
<div id="sidebar" style="padding-left:20px;" class="col-lg-2"><?php include $sidebar_php; ?></div>
	
<div class="fluid-container" style="padding-left:10px;margin:20px;">	
<div class="w3-row"><br>

<div class="w3-quarter w3-round w3-circle">
  <img src="<?php echo $images."sahil.jpg";?>" alt="Boss" style="width:45%" class="w3-circle w3-hover-opacity">
  <h3>Sahil Ayank</h3>
  <p>Full Stack Developer</p>
</div>

<div class="w3-quarter w3-round w3-circle">
  <img src="<?php echo $images."nikhil.jpeg";?>" alt="nikhil" style="width:45%" class="w3-circle w3-hover-opacity">
  <h3>Nikhil Arya</h3>
  <p>Full Stack Developer</p>
</div>
<br>
<div class="w3-quarter">
  <img src="<?php echo $images."nilesh.jpeg";?>" alt="Nilesh" style="width:45%" class="w3-circle w3-hover-opacity">
  <h3>Nilesh Agarwal</h3>
  <p>Fullstack Developer</p>
</div>

<div class="w3-quarter">
  <img src="<?php echo $images."harish.jpeg";?>" alt="Boss" style="width:45%" class="w3-circle w3-hover-opacity">
  <h3>Harish Iyer</h3>
  <p>Fullstack Developer</p>
</div>
</div>

</div>


</div>	
</body>

</html>