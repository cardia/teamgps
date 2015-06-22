<?php
require_once './layout.inc';
require_once './db.php';

$base = new Layout;
$base->link = './style.css';
$base->title = '출석 현황 확인';

$yoil = array("일","월","화","수","목","금","토");
$lecture_id = $_GET['lecture_id'];
$get_date = $_GET['date'];
$today = date('Y/m/d');
$week = date('w',strtotime($get_date));

$db1 = new DBC;
$db1->DBI();
$db1->query = "select start_time from lecture_time where lecture in (select title from lecture where lecture_number=".$lecture_id.")";
$db1->DBQ();
while($row = $db1->result->fetch_assoc()){
$hour = $row[start_time];
}
$db1->DBO();
$db = new DBC;
$db->DBI();
echo "<script type='text/javascript'>\n";
echo "function logout(){ \n\tlocation.replace('./logout.php');\n}\n";
echo "</script>";

echo "<script type='text/javascript'>\n";
echo "function monthago(){ \n\tlocation.replace('./admin_day.php?lecture_id=".$lecture_id."&date=".date("Y/m/d", strtotime($get_date."-1 month"))."');\n}\n";
echo "</script>";
echo "<script type='text/javascript'>\n";
echo "function aftermonth(){ \n\tvar d1 = new Date(".strtotime($get_date."+1 month").");\nvar d2 = new Date(".strtotime($today).");\nif(d1 <= d2)location.replace('./admin_day.php?lecture_id=".$lecture_id."&date=".date("Y/m/d", strtotime($get_date."+1 month"))."');\n}\n";
echo "</script>";
echo "<script type='text/javascript'>\n";
echo "function yesterday(){ \n\tlocation.replace('./admin_day.php?lecture_id=".$lecture_id."&date=".date("Y/m/d", strtotime($get_date."-1 day"))."');\n}\n";
echo "</script>";
echo "<script type='text/javascript'>\n";
echo "function tomorrow(){ \n\tif(".$get_date."!=".$today.")location.replace('./admin_day.php?lecture_id=".$lecture_id."&date=".date("Y/m/d", strtotime($get_date."+1 day"))."');\n}\n";
echo "</script>";

$db->query = "select user.user_name, chk.check1, chk.check2, chk.check3 
from user as user, lecture_check as chk
where chk.date ='".$get_date."' and lecture_number='".$lecture_id."' and chk.user_number = user.user_number;";

$db->DBQ();

$db->DBO();

$attendance = "";
$status_array = array("부재", "재실");
$result_num = $db->result->num_rows;
if($result_num != 0) {
  $i = 0;
  while($i++ < $result_num) {
    $data = $db->result->fetch_row();
    $name = $data[0];
    $chk1 = $data[1];
    $chk2 = $data[2];
    $chk3 = $data[3];
    $status = ($chk1 * 4) + ($chk2 * 2) + $chk3;
    switch ($status) {
      case 0 : $final_chk = "결석";break;
      case 1 : $final_chk = "지각";break;
      case 2 : $final_chk = "도주";break;
      case 3 : $final_chk = "지각";break;
      case 4 : $final_chk = "도주";break;
      case 5 : $final_chk = "외출";break;
      case 6 : $final_chk = "도주";break;
      case 7 : $final_chk = "출석";break;
    }
    if(date("G",time()) < $hour+2){
		  $final_chk = "수업중";
	  }
    $attendance = $attendance."<tr><td>".$name."</td><td>".$status_array[$chk1]."</td><td>".$status_array[$chk2]."</td><td>".$status_array[$chk3]."</td><td>".$final_chk."</tr>";
  }
}
else {
  $attendance = "<tr><th colspan=5>수업이 없는 날입니다.</th></tr>";
}

$base->AdminSide();
$base->content="
<table class='admin_day' style='margin:1 auto; margin-top:5%; width='90%' cellpadding='5' cellspacing='0' border='1' align='center' style='border-collapse:collapse; border:1px gray solid;'>
<caption>
  <input type='button' class='btn' name='monthago' id='monthago' value='<<' onclick='monthago()'/>
  <input type='button' class='btn' name='yesterday' id='yesterday' value='<' onclick='yesterday()'/>
  &nbsp; &nbsp; ".$get_date."일 (".$yoil[$week].")&nbsp; &nbsp; 
  <input type='button' class='btn' name='tomorrow' id='tomorrow' value='>' onclick='tomorrow()'/>
  <input type='button' class='btn' name='aftermonth' id='aftermonth' value='>>' onclick='aftermonth()'/>
</caption>
<thead>
  <tr>  
    <th id='name'>학생 이름</th>
    <th id='semi1'>수업 시작</th>
    <th id='semi2'>중간 결과</th>
    <th id='semi3'>중간 결과</th>
    <th id='final'>출석 결과</th>
  </tr>
</thead>
<tfoot>
</tfoot>
<tbody>
".$attendance."
</tbody>
</table>
<center><br /><br /><input type='button' class='btn' name='logout' id='logout' value='logout' onclick='logout()'/></center>";

$base->LayoutMain();
?>
