<?php
require_once './db.php';

$id = $_POST['id'];
$passwd = $_POST['passwd'];
$name = $_POST['name'];
$mac = $_POST['mac'];
$major = $_POST['major'];

$db = new DBC;
$db->DBI();

$db->query = "insert into user VALUES (".$id.",'".$name."',PASSWORD(".$passwd."),'".$mac."','0','".$major."')";
$db->DBQ();
$db->DBO();
$result = $db->result;

if($result == 1){
	//$query = "insert into chul_check(student_number,student_name,mac_address) values(".$id.",'".$name."','".$mac."')";
	//mysql_query($query);
	echo "0";
}
else{echo "1";}
?>
