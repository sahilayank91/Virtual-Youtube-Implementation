<h3 style="font-size:20px;min-height:60px;"><?php echo $result[1]; ?></h3>
<div class="col-lg-12" id="videoDescription">Description : 
	<?php echo $result[2]; ?>
</div>
<?php
	$query2 = "SELECT * FROM users where uid=".$result[4];
	$result2 = pg_query($db_connection, $query2);
	$result2 = pg_fetch_row($result2);
?>
<div class="col-lg-12" id="uploaderName"><a href="<?php echo $result2[8]; ?>"><img src=<?php echo $usershost.$result2[0]."/".$result2[9];?> alt="" style="background-color:white;border-radius:20px;width:25px;height:25px;margin-top:-3px;"/>&nbsp;&nbsp;<?php echo $result2[1]?></a></div>
<div class="col-lg-12" id="uploadingTime"><?php echo $result[9]; ?></div>
<div class="col-lg-12">
	<ul class="col-lg-12">
		<li class="detailsList likeButton col-lg-4">
			<?php 
				$arr = explode(",",trim($result[7],"{}"));
				if(isset($_SESSION['uid']))
				{
					$ID = $_SESSION['uid'];
					$query3 = "select $ID = ANY('$result[7]'::int[])";
					$rQuery3 = pg_query($db_connection,$query3);
					if(pg_fetch_row($rQuery3)[0] == 't')
					{
			?>
						<button style="color:red;" onclick="like()" id="like">
							<span class="glyphicon glyphicon-thumbs-up"></span>
							<span>Liked<span>
						</button>
						<code><?php echo count($arr); ?></code></li>
			<?php
					}
					else
					{
			?>
						<button style="color:black;" onclick="like()" id="like">
							<span class="glyphicon glyphicon-thumbs-up"></span>
							<span>Like</span>
						</button>   
						<code><?php if($arr[0] == "")echo 0; else echo count($arr); ?></code></li>
			<?php				
					}
				}
				else
				{
			?>
			<code><?php if($arr[0] == "")echo 0; else echo count($arr); ?></code>     Likes</li>
			<?php 
				}
			?>
		<li class="detailsList col-lg-4"><code><?php if($views[0] == "")echo 0; else echo sizeof($views); ?></code>     Views</li>
	</ul>
</div>

<script type="text/javascript">
	function like()
	{
		var likeButton = document.getElementById('like');
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			var x = document.getElementsByClassName('likeButton');
			var y = x[0];
			y.innerHTML = this.responseText;
		};
		xhttp.open("GET", "<?php echo "$like_dislike_php?vid=$vid"; ?>", true);
		xhttp.send();
	}
</script>