<?php
$halaman="";
if(isset($_GET['page'])){
	$page=htmlentities($_GET['page']);
	$halaman="$page.php";
}


if(!file_exists($halaman) || empty($page)){
	include "page_dashboard.php";
}else{
	//utk menjalankan session
	include "$halaman";
}
?>
