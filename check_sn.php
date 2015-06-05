<?php
require_once './db.php';
$id = $_POST["id"];

$db = new DBC;
$db->DBI();

$db->query = "select user_number from user where user_number = '".$id."'";
$db->DBQ();
$db->DBO();
$result = $db->result->num_rows;
if($result > 0){
	echo "1";
}
else{
	echo "0";
}
?>
