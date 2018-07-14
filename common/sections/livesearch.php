<?php
require $_SERVER['DOCUMENT_ROOT'].'/Youtube/web/path.php';
require $dbConnector_php;

//get the q parameter from URL

$q=$_GET['q'];
$q =strtolower($q);

$myfile = fopen("links.xml", "w") or die("Unable to open file!");
$query = "select * from users where username like '%$q%' or username like '$q%' or username like '%$q'";

$result= pg_query($db_connection,$query);
$search="";
if(pg_num_rows($result)){
	echo "<a tabindex='-1'><li><span style='color:red;'>Users</span></li><hr style='padding: 0px; margin: 0px;'></a>";
	while($row = pg_fetch_array($result)){	
		$search = $search."<a tabindex='-1' href='".$row['plink']."' target='_blank'><li class='innerLi'>".$row['name']."</li></a>";
	}
	echo $search;
	
	
	
}else{
	echo "<a tabindex='-1' href='' target='_blank'><li class='innerLi'>No Suggestion Available</li></a>";
}

?> 
