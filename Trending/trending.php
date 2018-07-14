<div id="Title"><h3 id="heading">Trending</h3></div>
<div id="videos">
	<?php
		$query = "select * from videos order by array_length(seen,1) desc,uploaddate desc,array_length(likes,1) desc";
		$result = pg_query($db_connection,$query);
		$count = 0;
		while($row = pg_fetch_array($result))
		{
			if($count == 7) break;
			else $count++;
	?>
			<div id="videoLayout" title="<?php echo $row['title']; ?>">
				<div id="videoImage"><img class="image" src="<?php echo $usershost.$row['uid']."/videos/".$row['pic'];?>"></div>
				<div id="videoName"><?php echo substr($row['title'],0,15); ?></div>
				<a class="WatchAnchor" href="<?php echo $videopage_php."?q=".$row['vid']; ?>"><div id="watch">Watch Now</div></a>
			</div>
	<?php
		}
	?>
</div>