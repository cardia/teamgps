<?php
require_once './db.php';

$title = $_POST['title'];
$student_number = $_POST['student_number'];
$student_number = explode(',',$student_number);
foreach ($student_number as $value){
	$db = new DBC;
	$db->DBI();
	$db->query = "insert into lecture_user values(".$value.",".$title.")";
	$db->DBQ();
	$db->DBO();
}
echo "0";
?>
