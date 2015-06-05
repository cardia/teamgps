<?php
require_once './layout.inc';

$base = new Layout;
$base->link = './style.css';

$base->LayoutMain();

unset($_SESSION['user_number']);
unset($_SESSION['user_name']);
unset($_SESSION['isadmin']);
session_destroy();

echo "<script>alert('로그아웃 되었습니다.');location.replace('/')</script>";
?>