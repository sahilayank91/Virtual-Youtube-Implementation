<?php
	if(isset($_GET['q']))
	{
		$q = $_GET['q'];
		if(isset($_SESSION['uid']))
		{	
			$id = $_SESSION['uid'];
			$query0 = "UPDATE videos SET seen = array_append(seen,$id) WHERE vid=$q AND NOT(seen @> ARRAY[$id])";
			pg_query($db_connection,$query0);
		}
		$query = "select * from videos where vid=$q";
		$result = pg_fetch_row(pg_query($db_connection,$query));
		$url = $usershost.$result[4].'/videos/'.pg_escape_string($result[1]).".".$result[3];
		$views = explode(",",trim($result[6],"{}"));
?>

<video id="videoTag" onClick="playPause();" ondblclick="fullScreen();" class="col-lg-12" controls autoplay>
	<source src="<?php echo $url; ?>" type="video/mp4">
</video>

<?php 
	}
?>
<script>
	var myVideo = document.getElementById("videoTag"); 
	function playPause()
	{ 
		if (myVideo.paused) 
		  myVideo.play(); 
		else 
		  myVideo.pause(); 
	}
	function fullScreen() {
		var elem = myVideo;
		if (elem.requestFullscreen) {
		  elem.requestFullscreen();
		  elem.exitFullscreen();
		} else if (elem.msRequestFullscreen) {
		  elem.msRequestFullscreen();
		  elem.msExitFullscreen();
		} else if (elem.mozRequestFullScreen) {
		  elem.mozRequestFullScreen();
		  elem.mozExitFullScreen();
		} else if (elem.webkitRequestFullscreen) {
		  elem.webkitRequestFullscreen();
		  elem.webkitExitFullscreen();
		}
		playPause();
	}
</script>