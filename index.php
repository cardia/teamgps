<?php
include_once "./layout.inc";

$base = new Layout;
$base->link='./style.css';

$isadmin = $_SESSION['isadmin'];
echo $isadmin;
echo $_SESSION['isadmin'];
if(!isset($_SESSION['isadmin'])) {
}
elseif($isadmin == 1) {
	echo "<script type='text/javascript'>location.replace('./admin.html');</script>";
}
elseif($isadmin == 0) {
	echo "<script type='text/javascript'>location.replace('./view.php?date=".date("Y/m/d")."');</script>";
}

$base->content="
<form method='post'>
	<table style='margin:0 auto; margin-top:5%;'>
    <tr>
      <td><img src='./chonbuk.jpg'></td>
    </tr>
		<tr>
			<td>출석 체크 사이트</th>
		</tr>
		<tr>
			<td>로그인 해주세요.</td>
		</tr>
	</table>
</form>";

$base->LayoutMain();
?>