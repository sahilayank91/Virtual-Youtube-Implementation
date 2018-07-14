<?php
require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
require $dbConnector_php;
?>
<div class="col-lg-4">
	<a href="index.php"><img src=<?php echo $images.'brand.png'?> id="footerlogo"/></a>
</div>
<div class="col-lg-8">
	<table id="footerTable">
		<thead>
			<th class="tableheader">Project Details</th>
			<th class="tableheader">Contact Us</th>
			<th class="tableheader">About Us</th>
		</thead>
		<tbody>
			<tr>
				<td class="tabledata"><a href="#">Idea</a></td>
				<td class="tabledata"><a href="#">Email</a></td>
				<td class="tabledata"><a href="<?php echo $team_php;?>">Team</a></td>
			</tr>
			<tr>
				<td class="tabledata"><a href="#">Resources</a></td>
				<td class="tabledata"><a href="#">Mobile</a></td>
				<td class="tabledata"><a href="#">Target</a></td>
			</tr>
			<tr>
				<td class="tabledata"><a href="#">Developers</a></td>
				<td class="tabledata"><a href="#">Address</a></td>
				<td class="tabledata"><a href="#">Journey</a></td>
			</tr>
		</tbody>
</div>