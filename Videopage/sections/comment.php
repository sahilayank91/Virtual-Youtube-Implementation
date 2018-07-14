<?php
	require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
	require $dbConnector_php;
	session_start();
	if(isset($_SESSION['uid']) and isset($_GET['vid']) and isset($_GET['text']))
	{
		$ID = $_SESSION['uid'];
		$vid = $_GET['vid'];
		$text = pg_escape_string($_GET['text']);
		$date = date('Y-m-d H:i:s');
		$query = "INSERT INTO comments (info,vid,uid,comdate) VALUES ('$text',$vid,$ID,'$date')";
		$flag = pg_query($db_connection,$query);
		if($flag)
		{
			$query1= "select * from comments where uid=$ID Order By cid desc";
			$result1 = pg_query($db_connection,$query1);
			$result1 = pg_fetch_array($result1);
			$cid = $result1['cid'];
			$query2 = "UPDATE videos SET cid = array_append(cid,$cid) where vid=$vid";
			$flag = pg_query($db_connection,$query2);
			$query3 = "select * from users where uid=$ID";
			$result3 = pg_fetch_array(pg_query($db_connection,$query3));
			if($flag)
			{
?>
				<div class="col-lg-12 oldComment" id="<?php echo $cid; ?>">
						<div class="col-lg-12" id="Commenter"><a href="<?php echo $result3['plink']; ?>"><img src=<?php echo $usershost.$ID."/".$result3['photo']; ?> alt="*_*" style="background-color:white;border-radius:20px;width:25px;height:25px;margin-top:2px;"/>&nbsp;&nbsp;<?php echo $result3['name']; ?></a></div>
						<div class="col-lg-4" id="CommentingTime"><?php echo $date; ?></div>
						<div id="commentContent" class="col-lg-12"><?php echo $text; ?></div>
						<div class="col-lg-12">
							<ul class="col-lg-8">
								<li class="commentList r col-lg-3">
									<span class="glyphicon glyphicon-share"></span>
									<span>&nbsp;Reply &nbsp; 0</span>
								</li>
							</ul>
						</div>
						<div id="mainReply" class="REPLY col-lg-offset-2 col-lg-10" id="<?php echo $cid; ?>">
							<div class="col-lg-12" style="padding-bottom:10px;">
								<textarea class="col-lg-9" id="replyTextArea" spellcheck="false" onkeyup="textAreaAdjust(this)"></textarea>
								<button class="col-lg-2" id="replySubmit" onclick="reply(<?php echo $cid; ?>)" type="submit" name="submit">Reply</button>
							</div>
						</div>
				</div>
<?php
			}
		}
	}
	else
	{
		header("Location: $index_php");
	}
?>