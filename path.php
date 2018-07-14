<?php
$root = $_SERVER['DOCUMENT_ROOT']."/Youtube/";
	$web = $root."web/";
$roothost = "http://localhost/Youtube/";
	$webhost = $roothost."web/";
		$bootstrap = $webhost."bootstrap/";
		$index_php = $webhost."index.php";
		//common
			//css
				$footer_css = $webhost."common/css/footer.css";
				$loggedInProfile_css = $webhost."common/css/loggedInProfile.css";
				$navbar_css = $webhost."common/css/navbar.css";
				$videosCategory_css = $webhost."common/css/videosCategory.css";
				$videosLayout_css = $webhost."common/css/videosLayout.css";
				$w3_css = $webhost."common/css/w3.css";
			//js
				$jQuery_js = $webhost."common/js/jQuery.js";
			//sections
				$footer_php = $web."common/sections/footer.php";
				$navbar_php = $web."common/sections/navbar.php";
				$sidebar_php = $web."common/sections/sideBar.php";
			//images
				$images = $webhost."common/images/";
				
		//Database_Connection
			$dbConnector_php = $web."Database_Connection/dbConnector.php";
		
		//Login
			$login_php = $webhost."Login/login.php";
			
		//Logout
			$logout_php = $webhost."Logout/logout.php";
			
		//Profile
			$profile_php = $webhost."Profile/profile.php";
			$subscribe_php = $webhost."Profile/subscribe.php";
			$uploadVideo_php = $webhost."Profile/uploadVideo.php";
				//css
					$profile_css = $webhost."Profile/css/profile.css";
		//Recommended
			$recommended_php = $web."Recommended/recommended.php";
			
		//Register
			$register_php = $webhost."Register/register.php";
		
		//Search
			$liveSearch_php = $webhost."Search/liveSearch.php";
			$search_php = $webhost."Search/search.php";
			
		//Trending
			$trending_php = $web."Trending/trending.php";
			
		//UploadVideo
			$uploadVideo_php = $webhost."UploadVideo/uploadVideo.php";
			$uploadVideoDetails_php = $webhost."UploadVideo/uploadThumbnail/bin/uploadVideoDetails.php";
			$uploadInDatabase_php = $webhost."UploadVideo/uploadInDatabase.php";
		
		//Videopage
			$videopage_php = $webhost."Videopage/videopage.php";
			//css
				$commentSection_css = $webhost."Videopage/css/commentSection.css";
				$relatedVideos_css = $webhost."Videopage/css/relatedVideos.css";
			//sections
				$comment_php = $webhost."Videopage/sections/comment.php";
				$like_dislike_php = $webhost."Videopage/sections/like_dislike.php";
				$reply_php = $webhost."Videopage/sections/reply.php";
				$relatedVideos_php = $web."Videopage/sections/relatedVideos.php";
				$videoComments_php = $web."Videopage/sections/videoComments.php";
				$videoDetails_php = $web."Videopage/sections/videoDetails.php";
				$videoPlayer_php = $web."Videopage/sections/videoPlayer.php";
		//Validation
			$validation_php = $webhost."Validation/validation.php";
			$forgot_php = $webhost."Validation/forgot.php";
			$changePassword_php =  $webhost."Validation/changePassword.php"; 
		//Team
			$team_php= $webhost."Team/team.php";
	
	$users = $root."users/";
	$usershost = $roothost."users/";
?>