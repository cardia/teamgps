<?php
require_once './layout.inc';
require_once './db.php';

$base = new Layout;
$base->link = './style.css';
$base->title = '출석 현황 확인';
$db = new DBC;
$db->DBI();

$lecture_id = $_GET['lecture_id'];
$get_date = $_GET['date'];
$month = date('m', strtotime($get_date));
$year = date('Y', strtotime($get_date));
$first_day = $year.'/'.$month.'/01';
$last_day = $year.'/'.$month.'/'.date('t', mktime(0,0,1,$month,1,$year));
$today = date('Y/m');
$week = date('w',strtotime($get_date));

echo "<script type='text/javascript'>\n";
echo "function logout(){ \n\tlocation.replace('./logout.php');\n}\n";
echo "</script>";

echo "<script type='text/javascript'>\n";
echo "function lastyear(){ \n\tlocation.replace('./admin_month.php?lecture_id=".$lecture_id."&date=".date("Y/m/d", strtotime($get_date."-1 year"))."');\n}\n";
echo "</script>";
echo "<script type='text/javascript'>\n";
echo "function nextyear(){ \n\tvar d1 = new Date(".strtotime($get_date."+1 month").");\nvar d2 = new Date(".strtotime($today).");\nif(d1 <= d2)location.replace('./admin_month.php?lecture_id=".$lecture_id."&date=".date("Y/m/d", strtotime($get_date."+1 year"))."');\n}\n";
echo "</script>";
echo "<script type='text/javascript'>\n";
echo "function lastmonth(){ \n\tlocation.replace('./admin_month.php?lecture_id=".$lecture_id."&date=".date("Y/m/d", strtotime($get_date."-1 month"))."');\n}\n";
echo "</script>";
echo "<script type='text/javascript'>\n";
echo "function aftermonth(){ \n\tif(".$get_date."!=".$today.")location.replace('./admin_month.php?lecture_id=".$lecture_id."&date=".date("Y/m/d", strtotime($get_date."+1 day"))."');\n}\n";
echo "</script>";

$db->query = "select chk.date, user.user_name, chk.check1, chk.check2, chk.check3 
from user as user, lecture_check as chk
where (chk.date >='".$first_day."'and chk.date <= '".$last_day."') and lecture_number='".$lecture_id."' and chk.user_number = user.user_number;";
$db->DBQ();
$db->DBO();

$attendance = "";
$status_array = array("부재", "재실");
$result_num = $db->result->num_rows;
echo $result_num;
if($result_num != 0) {
  $i = 0;
  while($i++ < $result_num) {
    $data = $db->result->fetch_row();
    $date = $data[0];
    $student = $data[1];
    $chk1 = $data[2];
    $chk2 = $data[3];
    $chk3 = $data[4];
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
    $attendance = $attendance."<tr><td>".$date."</td><td>".$student."</td><td>".$status_array[$chk1]."</td><td>".$status_array[$chk2]."</td><td>".$status_array[$chk3]."</td><td>".$final_chk."</tr>";
  }
}
else {
  $attendance = "<tr><th colspan=6>수업이 없는 날입니다.</th></tr>";
}

$base->AdminSide();
$base->content="
<table class='admin_month' style='margin:1 auto; margin-top:5%; width='90%' cellpadding='6' cellspacing='0' border='1' align='center' style='border-collapse:collapse; border:1px gray solid;'>
<caption>
  <input type='button' class='btn' name='lastyear' id='lastyear' value='<<' onclick='lastyear()'/>
  <input type='button' class='btn' name='lastmonth' id='lastmonth' value='<' onclick='lastmonth()'/>
  &nbsp; &nbsp; ".$year."년 ".$month."월&nbsp; &nbsp; 
  <input type='button' class='btn' name='aftermonth' id='aftermonth' value='>' onclick='aftermonth()'/>
  <input type='button' class='btn' name='nextyear' id='nextyear' value='>>' onclick='nextyear()'/>
  <br /><p></p>
</caption>
<thead>
  <tr>
    <th id='date'>날짜</th>
    <th id='student'>학생</th>
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