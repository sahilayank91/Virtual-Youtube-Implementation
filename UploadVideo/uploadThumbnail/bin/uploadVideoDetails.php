<?php
	require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	require $dbConnector_php;
	session_start();
	if(isset($_POST['submit']))
	{
		$name = $_FILES['uploadedvideo']['name'];
		$tmpName = $_FILES['uploadedvideo']['tmp_name'];
		$ext = explode('.',$name);
		$title='';
		for($y=0;$y<count($ext)-1;$y++) 
		{
			if($y==0) $title = $ext[0];
			else $title = $title.".".$ext[$y];
		}
		$title = pg_escape_string($title);
		$ext = strtolower($ext[count($ext)-1]);
		if($ext === 'mp4' or $ext === "mov"  or $ext === "3gp")
		{
			$targetFinal = $users.$_SESSION['uid'].'/videos/'.$name;
			$target = "tempThumb/";
			$tempName = "tempVid".$ext;
			$flag = move_uploaded_file($tmpName,$target.$tempName);
			if($flag)
			{
				$video = $target.escapeshellcmd($tempName);
				$cmd = "ffmpeg -i \"$video\" 2>&1";
				$second = array();
				if (preg_match('/Duration: ((\d+):(\d+):(\d+))/s', `$cmd`, $time)) {
					$total = ($time[2] * 3600) + ($time[3] * 60) + $time[4];
					$i=0;
					set_time_limit(600); 
					for($i=0;$i<4;$i++){
						$second[$i]=rand($i,($total - 1));
					}
				}
				for($i=0;$i<4;$i++){
					$image  = "tempThumb/temp[".$i."].jpg";
					$cmd = "ffmpeg -ss $second[$i] -i \"$video\" -deinterlace -an -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $image 2>&1";
					$do = `$cmd`;
				}
				$flag = rename($target.$tempName,$targetFinal);
				$_SESSION['vidTitle'] = $title;
				$_SESSION['ext'] = $ext;
				?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href=<?php echo $footer_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $navbar_css;?>>
		<link rel="stylesheet" type="text/css" href=<?php echo $loggedInProfile_css;?>>
		<link rel="stylesheet" href=<?php echo $w3_css;?>>
		
		<link rel="stylesheet" href=<?php echo $bootstrap."css/bootstrap.min.css";?>>
		
		<style type="text/css">
			.hover: hover {
				border-left : 5px solid black;
			}
			label > input{ /* HIDE RADIO */
				visibility: hidden; /* Makes input not-clickable */
				position: absolute; /* Remove input from document flow */
			}
			label > input + img{ /* IMAGE STYLES */
				cursor:pointer;
				border:2px solid transparent;
			}
			label > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
				border:2px solid #f00;
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
				<div><h3>Give Necessary Details - <?php echo $name;?></h3></div>
				<p>Choose a thumbnail for your video : </p>
				
					<form action=<?php echo $uploadInDatabase_php;?> method="POST" enctype="multipart/form-data">
					<?php
					$dirname = "tempThumb/";
					$imagesThumb = glob($dirname."*.jpg");

					foreach($imagesThumb as $imageT){
						?>
						<div class="col-lg-3">
							<label>
								<input type="radio" name="thumb" value=<?php echo $imageT?>  />
								<img src=<?php echo $imageT;?> style="width:240px;height:135px;">
							</label>
						</div>
						<?php
					}
				?>
						<p style="margin-left:10px;"><strong><br>Description :</strong></p>
						<textarea style="margin-left:10px;width:485px;resize:none;font-size:12px;padding:10px;" name="desc" maxlength="500" spellcheck="false" onkeyup="textAreaAdjust(this);"></textarea>
						<script>
							function textAreaAdjust(o) {
							o.style.height = "1px";
							o.style.height = (25+o.scrollHeight)+"px";
							}
						</script>
						<br/>
						&nbsp;&nbsp;&nbsp;Choose a main tag for your video :
						<select name="choice" style="padding:4px;margin:10px;width:250px;">
							<option>News</option>
							<option>Health</option>
							<option>Sports</option>
							<option>Education</option>
							<option>Entertainment</option>
							<option>Politics</option>
							<option>International</option>
						</select>
						<br/>
						&nbsp;&nbsp;&nbsp;Optional tags (limited to 3 words, separated by commas) : <input style="padding-left:0px;margin:9px;margin-left:43px;width:250px;" name="option" spellcheck="false"/>
						<br/>
						<?php
							}
						?>
						<input type="submit" class="btn btn-primary" name="submit" value="UPLOAD"/>
					</form>
			</div>
		</div>
		<?php
			}
		}else{
			$error = "?error=true";
			//header("Location: $uploadVideo_php$error ");
		}
?>
		<div id="Footer" class="col-lg-12"><?php include $footer_php; ?></div>
	</body>
</html>