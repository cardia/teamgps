<?php
require_once './db.php';
require_once './admin_privilege.php';

$lecture_number = $_POST['lecture_number'];
$lecture_number = explode(',',$lecture_number);

$db = new DBC;
$db->DBI();

foreach ($lecture_number as $value){
	$db->query = "delete from lecture where lecture_number = '".$value."'";
	$db->DBQ();
	$db->query = "delete from lecture_check where lecture_number = '".$value."'";
	$db->DBQ();
	$db->query = "delete from lecture_day where lecture_number = '".$value."'";
	$db->DBQ();
	$db->query = "delete from lecture_user where lecture_number = '".$value."'";
	$db->DBQ();
	$db->DBO();
}
echo "0";
?>
