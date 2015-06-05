<?php
include('./admin_privilege.php');
include('./db_conn.php');
header("Content-Type: text/html; charset=UTF-8");

$title = $_POST['title'];
$title = explode(',',$title);
foreach ($title as $value){
	mysql_query("delete from lecture where title='".$value."'");
	mysql_query("update student_info set lecture_1 = NULL where lecture_1 = '".$value."'");
	mysql_query("update student_info set lecture_2 = NULL where lecture_2 = '".$value."'");
	mysql_query("update student_info set lecture_3 = NULL where lecture_3 = '".$value."'");
	mysql_query("update student_info set lecture_4 = NULL where lecture_4 = '".$value."'");
	mysql_query("update student_info set lecture_5 = NULL where lecture_5 = '".$value."'");
	mysql_query("update student_info set lecture_6 = NULL where lecture_6 = '".$value."'");
}

echo "0";
mysql_close();
?>