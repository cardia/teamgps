<?php
include('./db_conn.php');
header("Content-Type: text/html; charset=UTF-8");

$title = $_POST['title'];
$student_number = $_POST['student_number'];
$student_number = explode(',',$student_number);
foreach ($student_number as $value){
	$result_1 = mysql_result(mysql_query("select count(lecture_1) from student_info where student_number = '".$value."'"),0);
	$result_2 = mysql_result(mysql_query("select count(lecture_2) from student_info where student_number = '".$value."'"),0);
	$result_3 = mysql_result(mysql_query("select count(lecture_3) from student_info where student_number = '".$value."'"),0);
	$result_4 = mysql_result(mysql_query("select count(lecture_4) from student_info where student_number = '".$value."'"),0);
	$result_5 = mysql_result(mysql_query("select count(lecture_5) from student_info where student_number = '".$value."'"),0);
	$result_6 = mysql_result(mysql_query("select count(lecture_6) from student_info where student_number = '".$value."'"),0);
	if($result_1 == 0){
		$query = "update student_info set lecture_1='".$title."' where student_number = '".$value."'";
		mysql_query($query);
	}
	elseif($result_2 == 0){
		$query = "update student_info set lecture_2='".$title."' where student_number = '".$value."'";
		mysql_query($query);
	}
	elseif($result_3 == 0){
		$query = "update student_info set lecture_3='".$title."' where student_number = '".$value."'";
		mysql_query($query);
	}
	elseif($result_4 == 0){
		$query = "update student_info set lecture_4='".$title."' where student_number = '".$value."'";
		mysql_query($query);
	}
	elseif($result_5 == 0){
		$query = "update student_info set lecture_5='".$title."' where student_number = '".$value."'";
		mysql_query($query);
	}
	elseif($result_6 == 0){
		$query = "update student_info set lecture_6='".$title."' where student_number = '".$value."'";
		mysql_query($query);
	}
}
echo "0";
mysql_close();
?>