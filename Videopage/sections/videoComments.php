<?php
	if(isset($_GET['q']))
	{	
?>
		<div class="col-lg-12" style="padding-bottom:10px;">
				<h3 style="color:black;">Comments</h3>
<?php
		if(isset($_SESSION['uid']))
		{
?>	
				<textarea class="col-lg-11" id="commentTextArea" spellcheck="false" onkeyup="textAreaAdjust(this)"></textarea>
				<button class="btn btn-primary col-lg-2 col-lg-offset-9" onclick="comment()" id="commentSubmit" type="submit" name="submit">Comment</button>
				<script>
					function textAreaAdjust(o) {
					  o.style.height = "1px";
					  o.style.height = (25+o.scrollHeight)+"px";
					}
				</script>
<?php
		}
?>
		</div>
<?php
		$vid = $_GET['q'];
		$commentQuery = "select cid from videos where vid=$vid";
		$commentResult = pg_fetch_array(pg_query($db_connection,$commentQuery));
		$comments = $commentResult['cid'];
		$cid = explode(",",trim($comments,"{}"));
		$cid = array_reverse($cid);
		$count = count($cid);
		$c = 0;
?>
<div id="oldCommentSection" class="col-lg-12">
<?php
	if($cid[0] != "")
	{
		while($c != $count)
		{
			$replyQuery = "select * from comments where cid=$cid[$c]";
			$replyResult = pg_fetch_array(pg_query($db_connection,$replyQuery));
			$replies = $replyResult['replies'];
			$c = $c + 1;
			$x = $replyResult['uid'];
			$userQuery = "select * from users where uid=$x";
			$userResult = pg_fetch_array(pg_query($db_connection,$userQuery));
			$replies = explode(",",trim($replies,"{}"));
			$replies = array_reverse($replies);
			$rCount = count($replies);
			if($replies[0] == "") $rCount = 0;
			$r = 0;
?>
		<div class="col-lg-12 oldComment" id="<?php echo $replyResult['cid']; ?>">
			<div class="col-lg-12" id="Commenter"><a href="<?php echo $userResult['plink'] ?>"><img src=<?php echo $usershost.$userResult['uid']."/".$userResult['photo']; ?> alt="*_*" style="background-color:white;border-radius:20px;width:25px;height:25px;margin-top:2px;"/>&nbsp;&nbsp;<?php echo $userResult['name']; ?></a></div>
			<div class="col-lg-4" id="CommentingTime"><?php echo $replyResult['comdate']; ?></div>
			<div id="commentContent" class="col-lg-12"><?php echo $replyResult['info']; ?></div>
			<div class="col-lg-12">
				<ul class="col-lg-8">
					<li class="commentList r col-lg-3">
							<span class="glyphicon glyphicon-share"></span>
							<span>&nbsp;Reply &nbsp; <?php echo $rCount; ?></span>
					</li>
				</ul>
			</div>
			<div id="mainReply" class="REPLY col-lg-offset-2 col-lg-10">
<?php
				if(isset($_SESSION['uid']))
				{
?>
					<div class="col-lg-12" style="padding-bottom:10px;">
						<textarea class="col-lg-9" id="replyTextArea" spellcheck="false" onkeyup="textAreaAdjust(this)"></textarea>
						<button class="col-lg-2" id="replySubmit" onclick="reply(<?php echo $replyResult['cid']; ?>)" type="submit" name="submit">Reply</button>
					</div>
<?php
				}
			if($replies[0] != "")
			{
				while($r != $rCount)
				{
					$onlyReplyQuery = "select * from comments where cid=$replies[$r]";
					$onlyReplyResult = pg_fetch_array(pg_query($db_connection,$onlyReplyQuery));
					
					$xR = $onlyReplyResult['uid'];
					$userQ = "select * from users where uid=$xR";
					$userR = pg_fetch_array(pg_query($db_connection,$userQ));
					
					$r = $r + 1;
?>
				<div id="oldreply" class="col-lg-12">
					<div class="col-lg-12" id="Replier"><a href="<?php echo $userR['plink']; ?>"><img src=<?php echo $usershost.$userR['uid']."/".$userR['photo']; ?> alt="*_*" style="background-color:white;border-radius:20px;width:25px;height:25px;margin-top:2px;"/>&nbsp;&nbsp;<?php echo $userR['name']; ?></a></div>
					<div class="col-lg-4" id="ReplyingTime"><?php echo $onlyReplyResult['comdate']; ?></div>
					<div id="replyContent" class="col-lg-12"><?php echo $onlyReplyResult['info']; ?></div>
				</div>
<?php
				}
			}
				echo "</div></div>";
		}
	}
	echo "</div>";
?>
<script>
	var commentTextArea = document.getElementById('commentTextArea');
	function comment()
	{
		var text = commentTextArea.value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if(xhttp.readyState == 4)
			{
				$('#oldCommentSection').prepend(this.responseText);
				commentTextArea.value = "";
				$(".r").click(function(){
					$( this ).parents('.oldComment').children('.REPLY').toggle(250);
				});
			}
		};
		xhttp.open("GET", "<?php echo "$comment_php?vid=$vid&text="; ?>"+text, true);
		xhttp.send();
	}
	
	$(".r").click(function(){
		$( this ).parents('.oldComment').children('.REPLY').toggle(250);
	});
	
	function reply(cid)
	{
		var replyTextArea = document.getElementById(""+cid).children[4].children[0].children[0];
		var countElement = document.getElementById(""+cid).children[3].children[0].children[0].children[1];
		var text = replyTextArea.value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if(xhttp.readyState == 4)
			{
				replyTextArea.value = "";
				var x = $("#"+cid).children("#mainReply").children("div:first-child").after(this.responseText);
				var data = countElement.innerHTML;
				data = data.split('&nbsp;Reply &nbsp;');
				data = parseInt(data[1]) + 1;
				outputString = "&nbsp;Reply &nbsp;"+data;
				countElement.innerHTML = outputString;
			}
		};
		xhttp.open("GET", "<?php echo "$reply_php?vid=$vid&cid="; ?>"+cid+"&text="+text, true);
		xhttp.send();
	}
</script>

<?php
	}
	else header("Location: $index_php");
?>