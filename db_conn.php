<?php
$db_host="localhost";
$db_user="root";
$db_passwd = "apmsetup";
$db_name="attendance";
$link = mysql_connect($db_host,$db_user,$db_passwd);
$db_selected = mysql_select_db($db_name,$link);
mysql_query("SET CHARACTER SET utf8");
?>