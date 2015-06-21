<?php
require_once './db.php';
require_once './admin_privilege.php';

$lecture_number = $_POST['lecture_number'];
$lecture_number = explode(',',$lecture_number);

$db1 = new DBC;
$db1->DBI();
$db2 = new DBC;
$db2->DBI();
$db3 = new DBC;
$db3->DBI();
$db4 = new DBC;
$db4->DBI();
$db5 = new DBC;
$db5->DBI();
foreach ($lecture_number as $value){
	$db5->query = "delete from lecture_time where lecture in (select title from lecture where lecture_number = '".$value."')";
	$db5->DBQ();
	$db1->query = "delete from lecture where lecture_number = '".$value."'";
	$db1->DBQ();
	$db2->query = "delete from lecture_check where lecture_number = '".$value."'";
	$db2->DBQ();
	$db3->query = "delete from lecture_day where lecture_number = '".$value."'";
	$db3->DBQ();
	$db4->query = "delete from lecture_user where lecture_number = '".$value."'";
	$db4->DBQ();
}
$db1->DBO();
$db2->DBO();
$db3->DBO();
$db4->DBO();
$db5->DBO();
echo "0";
?>
