<?php
include('./db_conn.php');
header("Content-Type: text/html; charset=UTF-8");

$lecture_title = $_POST['lecture_title'];
$s_time = $_POST['s_time'];
$e_time = $_POST['e_time'];

$query = "insert into lecture VALUES ('".$lecture_title."','".$s_time."','".$e_time."')";
$re = mysql_query($query);

if($re){
	echo "0";
}
else{echo "1";}
mysql_close();
?>