<?php
require_once './db.php';
header("Content-Type: text/html; charset=UTF-8");

$id = $_POST['id'];
$passwd = $_POST['passwd'];
$name = $_POST['name'];
$mac = $_POST['mac'];

$db = new DBC;
$db->DBI();

$db->query = "insert into user VALUES (".$id.",'".$name."',PASSWORD(".$passwd."),'".$mac."',  0)";
$db->DBQ();

$db->DBO();
?>