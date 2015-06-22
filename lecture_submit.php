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
$db0 = new DBC;
$db0->DBI();
$db0->query = "select * from lecture where lecture_number = ".$lecture_number;
$db0->DBQ();
$num_row = $db0->result->num_rows;
$db0->DBO();
if(is_null($lecture_number) || is_null($lecture_title) || is_null($e_time) || $lecture_number=="" || $lecture_title=="" || $e_time==""){
	echo "1";
	return false;
}
elseif($num_row > 0){
	echo "1";
	return false;
}
else{
	$s_time = substr($s_time,0,2);
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
	$db->DBO();
	$db2 = new DBC;
	$db2->DBI();
	$db2->query = "insert into lecture values(".$lecture_number.",'".$lecture_title."',".$e_time.")";
	$db2->DBQ();
	if($lecture_day[1]-$lecture_day[0]>=6){
		$db3 = new DBC;
		$db3->DBI();
		$took_time = 1;
		$day=date("D",mktime(0,0,0,$month,$lecture_day[0],2015));
		$db3->query = "insert into lecture_time values('".$lecture_title."','".$day."',".$s_time.",".$took_time.")";
		echo "insert into lecture_time values('".$lecture_title."','".$day."',".$s_time.",".$took_time.")";
		$db3->DBQ();
		$db3->DBO();
	}
	else{
		$db3 = new DBC;
		$db3->DBI();
		$took_time = 2;
		$day1=date("D",mktime(0,0,0,$month,$lecture_day[0],2015));
		$day2=date("D",mktime(0,0,0,$month,$lecture_day[1],2015));
		$db3->query = "insert into lecture_time values('".$lecture_title."','".$day1."',".$s_time.",".$took_time.")";
		$db3->DBQ();
		$db3->query = "insert into lecture_time values('".$lecture_title."','".$day2."',".$s_time.",".$took_time.")";
		$db3->DBQ();
		$db3->DBO();
	}
	echo "0";
}
?>
