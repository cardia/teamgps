<?php
require_once './layout.inc';
require_once './db.php';

$base = new Layout;
$base->link = './style.css';

if(isset($id) && isset($pass1) && isset($pass2) && isset($mail))
{
  header("Content-Type: text/html; charset=UTF-8");
  echo "<script>alert('빈 칸이 존재합니다.');history.back();</script>";
  exit;
}

$db = new DBC;
$db->DBI();

$id = $_POST['logid'];
$pass = $_POST['logpass'];

$isfirst = $_GET['login'];
$db->query = "select user_number, user_name, isadmin from user where user_number='".$id."' and password=password('".$pass."')";
$db->DBQ();

$num = $db->result->num_rows;
if($num==1) {
  $data = $db->result->fetch_row();
	$_SESSION['user_number'] = $data[0];
	$_SESSION['user_name'] = $data[1];
	$_SESSION['isadmin'] = $data[2];
	echo "<script>location.replace('view.php?date=".date("Y/m/d")."');</script>";
} else if (($id == "" || $pass == "") && !isset($isfirst)) {
  echo "<script>alert('아이디와 비밀번호를 입력해주세요.');</script>";
} else if(($id != "" && $pass != "") && $num == 0)
{
	echo "<script>alert('아이디와 비밀번호가 맞지 않습니다.');</script>";
}

$db->DBO();

$base->content = "
<form action='".$_SERVER['PHP_SELF']."' method='post'>
	<table style='margin:0 auto; margin-top:5%;'>
		<tr>
			<th colspan='2'>로그인</th>
		</tr>
		<tr>
			<td><input type='text' name='logid'size='16' placeholder='아이디'/></td>
			<td rowspan='2'><input type='submit' value='로그인' style='height:50px;'/></td>
		</tr>
		<tr>
			<td><input type='password' name='logpass' size='16' placeholder='비밀번호'/></td>
		</tr>
		<tr>
      <td></td>
			<td align=right><a href='./join.php'>등록</a></td>
		</tr>
	</table>
</form>";

$base->LayoutMain();

?>

