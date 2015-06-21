<?php
require_once './db.php';
require_once './admin_privilege.php';

$month = date("m",time());
$lecture_number = $_POST['lecture_number'];
$lecture_title = $_POST['lecture_title'];
$s_time = $_POST['s_time'];
$e_time = $_POST['e_time'];
$lecture_day = $_POST['lecture_day'];
$lecture_day = explode(',',$lecture_day);

$db = new DBC;
$db->DBI();

$query1 = "insert into lecture_day(";
$query2 = "values (";
for($i=1;$i<=count($lecture_day);$i++){
	$query1.="day".$i.",";
	$query2.="'".date("Y-m-d",mktime(0,0,0,$month,$lecture_day[$i-1],2015))."',";
}
$query1.="lecture_number)";
$query2.="'".$lecture_number."')";
$query = $query1.$query2;
$db->query = $query;
$db->DBQ();
$db->query = "insert into lecture values(".$lecture_number.",'".$lecture_title."',".$e_time.")";
$db->DBQ();
if($lecture_day[1]-$lecture_day[0]>=6){
	$took_time = 1;
	$day=date("D",mktime(0,0,0,$month,$lecture_day[0],2015));
	$db->query = "insert into lecture_time values('".$lecture_title."','".$day."',".$s_time.",".$took_time.")";
	$db->DBQ();
	$db->DBO();
}
else{
	$took_time = 2;
	$day1=date("D",mktime(0,0,0,$month,$lecture_day[0],2015));
	$day2=date("D",mktime(0,0,0,$month,$lecture_day[1],2015));
	$db->query = "insert into lecture_time values('".$lecture_title."','".$day1."',".$s_time.",".$took_time.")";
	$db->DBQ();
	$db->query = "insert into lecture_time values('".$lecture_title."','".$day2."',".$s_time.",".$took_time.")";
	$db->DBQ();
	$db->DBO();
}
echo "0";
?>
