<?php
require_once './layout.inc';
require_once './db.php';

$base = new Layout;
$base->link = './style.css';
$base->title = '월별 출석 관리';

$db = new DBC;
$db->DBI();
$db->query = "select lecture_number, title from lecture;";
$db->DBQ();
$db->DBO();

$result_num = $db->result->num_rows;

$subjects = array();
$subject_present = "";
if ($_GET['type'] == "month")
  $link = "./admin_month.php";
else if($_GET['type'] == "day")
  $link = "./admin_day.php";
else
  echo "<script>alert('정상적이지 않은 접근');location.replace('/')</script>";
  
if($result_num != 0) {
  $i = 0;
  while($i++ < $result_num) {
    $data = $db->result->fetch_row();
    $subjects[$data[1]] = $data[0];
    
    $subject_present = $subject_present."<tr><td><a href='".$link."?lecture_id=".$data[0]."&date=".date("Y/m/d")."'>".$data[1]."</a></td></tr>";
  }
}
else {
  $subject_present = "<tr><th>문제가 발생하였습니다. 새로고침 해주세요.</th></tr>";
}

$base->AdminSide();
$base->content="
<table class='admin_subject' style='margin:1 auto; margin-top:5%; width='90%' cellpadding='5' cellspacing='0' border='1' align='center' style='border-collapse:collapse; border:1px gray solid;'>
<caption><p><b>출석을 확인할 과목을 선택해 주세요.</b></p></caption>
<tbody>
".$subject_present."
</tbody>
</table>
<center><br /><br /><input type='button' class='btn' name='logout' id='logout' value='logout' onclick='logout()'/></center>";

$base->LayoutMain();
?>