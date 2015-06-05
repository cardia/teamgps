<?php
$s_id = $_SESSION['id'];
$s_lv = $_SESSION['level'];
$s_name = $_SESSION['name'];

if($s_id != 0 && $s_lv != 1){
	session_destroy();
	echo "<script type='text/javascript'>";
	echo "location.replace('./welcome.php');";
	echo "</script>";
}
?>