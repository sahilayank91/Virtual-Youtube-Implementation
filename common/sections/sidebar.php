<?php
	if(!isset($_SESSION['uid']))
	{	
?>
		<ul class="nav nav-pills nav-stacked" style="padding:10px;padding-top:30px;background-color:HoneyDew ;margin-top:-22px; height:100%;">
			<li role="presentation"><a href="#trending">Trending</a></li>
			<li role="presentation"><a href="#news">News</a></li>
			<li role="presentation"><a href="#sports">Sports</a></li>
			<li role="presentation"><a href="#health">Health</a></li>
			<li role="presentation"><a href="#politics">Politics</a></li>
			<li role="presentation"><a href="#education">Education</a></li>
			<li role="presentation"><a href="#entertainment">Entertainment</a></li>
			<li role="presentation"><a href="#international">International</a></li>
		</ul>
<?php	
	}
	else
	{
?>
		<ul class="nav nav-pills nav-stacked" style="padding:10px;padding-top:30px;background-color:HoneyDew  ;margin-top:-22px;">
			<li role="presentation"><a href=<?php echo $index_php;?>>Home</a></li>
			<li role="presentation"><a href=<?php echo $profile_php."?q=".$_SESSION['uname'];?>>Profile</a></li>
			<li role="presentation"><a href=<?php echo $profile_php."?q=".$_SESSION['uname'];?>>My Videos</a></li>
			<li class="nav-divider"></li>
			<li role="presentation"><a href="index.php/#trending">Trending</a></li>
			<li role="presentation"><a href="index.php/#sports">Sports</a></li>
			<li role="presentation"><a href="index.php/#health">Health</a></li>
			<li role="presentation"><a href="index.php/#politics">Politics</a></li>
			<li role="presentation"><a href="index.php/#education">Education</a></li>
			<li role="presentation"><a href="index.php/#entertainment">Entertainment</a></li>
			<li role="presentation"><a href="index.php/#international">International</a></li>
			<li class="nav-divider"></li>
			<li role="presentation"><a href=<?php echo $logout_php;?>>Logout</a></li>
		</ul>
<?php
	}
?>