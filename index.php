<?php
include_once "./layout.inc";

$base = new Layout;

$base->link='./style.css';
$base->content="
<form method='post'>
	<table style='margin:0 auto; margin-top:5%;'>
		<tr>
			<td>창의적 공학 설계 출석 체크 사이트</th>
		</tr>
		<tr>
			<td>로그인 해주세요.</td>
		</tr>
	</table>
</form>";

$base->LayoutMain();
?>