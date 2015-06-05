<?php
header("Content-Type: text/html; charset=UTF-8");
include('./db.php');

$id = $_POST["id"];

$db = new DBC;
$db->DBI();

$db->query = "select count(user_number) from user where user_number = '".$id."'";

$db->DBQ();

$db->DBO();

$num = $db->result->num_rows;
if($num == 0)
  echo "0";
else
  echo "1";
?>