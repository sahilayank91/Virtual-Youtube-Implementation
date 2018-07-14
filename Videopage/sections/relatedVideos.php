<div id="sideTitle" class="col-lg-12" style="width:123%;"><h3 id="sideheading">Related Videos</h3></div><br/><br/><br/>
<div id="sideVideos" style="width:150%;margin-left:-25px;">
	<?php
		$query = "select * from videos order by array_length(seen,1) desc,uploaddate desc,array_length(likes,1) desc";
		$result = pg_query($db_connection,$query);
		$count = 0;
		while($row = pg_fetch_array($result))
		{
			if($count == 7) break;
			else $count++;
	?>
	<div id="sideVideoLayout" title="<?php echo $row['title']; ?>">
		<div id="sideVideoImage"><img class="image" src="<?php echo $usershost.$row['uid']."/videos/".$row['pic'];?>"></div>
		<div id="sideVideoName"><?php echo substr($row['title'],0,35); ?></div>
		<a class="sideWatchAnchor" href="<?php echo $videopage_php."?q=".$row['vid']; ?>"><div id="watch">Watch Now</div></a>
	</div>
	<?php
		}
	?>
</div>