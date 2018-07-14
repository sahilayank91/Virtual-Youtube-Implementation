<?php
	require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	require $dbConnector_php;
	session_start();
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href=<?php echo $footer_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $navbar_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $loggedInProfile_css;?>>
		<link rel="stylesheet" href=<?php echo $w3_css;?>>
		
		<link rel="stylesheet" href=<?php echo $bootstrap."css/bootstrap.min.css";?>>
		
		<style type="text/css">
			.hover:hover {
				border-left : 5px solid black;
			}
		</style>
		
		<script src=<?php echo $bootstrap."js/bootstrap.min.js";?>></script>
		<script src=<?php echo $jQuery_js?>></script>
		
	</head>
	<body>	
		<div id="NavBar"><?php include $navbar_php; ?></div>
		<div id="sidebar" style="padding-left:20px;" class="col-lg-2"><?php include $sidebar_php; ?></div>
		<div class="col-lg-10">
			<div class="col-lg-12" style="background-color:#ededed;padding-top:0px;padding-left:50px;padding-bottom:20px;margin-bottom:10px;margin-top:10px;min-height:100px;">
				<div><h3>Upload a video</h3></div>
				<?php 
					if(isset($_GET['error'])) echo "Sorry wrong file type selected. Upload a valid type";
				?>
				<div style="padding:20px;">
					<form action=<?php echo $uploadVideoDetails_php; ?> method="POST" enctype="multipart/form-data">
						<input type="file"  class="file" name="uploadedvideo" style="visibility:hidden;"/>
						<div class="input-group col-xs-5">
							<input type="text" class="form-control input-lg" disabled placeholder="Upload Video">
							<span class="input-group-btn">
								<button class="browse btn btn-primary input-lg" type="button">
									<i class="glyphicon glyphicon-search"></i>
									Browse 
								</button>
							</span>
						</div>
						<script>
							$(document).on('click', '.browse', function(){
								var file = $(this).parent().parent().parent().find('.file');
								file.trigger('click');
							});
							$(document).on('change', '.file', function(){
								$(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
							});
						</script>
						<input type="submit" name="submit" value="Select File" class="btn btn-primary" style="margin-top:10px;"/>
					</form>
				</div>
			</div>
		</div>
		<div id="Footer" class="col-lg-12"><?php include $footer_php; ?></div>
	</body>
</html>