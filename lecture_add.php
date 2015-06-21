<?php
require_once './layout.inc';
require_once './db.php';
require_once './admin_privilege.php';

$base = new Layout;
$base->link = './style.css';
$base->title = '과목 추가';

$db = new DBC;
$db->DBI();
$db->query = "select title,lecture_number from lecture";
$db->DBQ();
$lecture_list = "<select id='title' name='title'>\n";
while($row = $db->result->fetch_assoc()){
  $lecture_list = $lecture_list."\t<option value='".$row[lecture_number]."'>".$row[title]."(".$row[lecture_number].")</option>\n";
}
$lecture_list = $lecture_list."</select>\n<p/>\n";


$db->query = "select user_number,user_name from user";
$db->DBQ();
$db->DBO();
$student_list = "<table class='admin_view' style='margin:1 auto; margin-top:5%; width='90%' cellpadding='5' cellspacing='0' align='center' style='border-collapse:collapse; border:1px gray solid;'>\n";
$student_list = $student_list."\t<tr>\n\t\t<td></td>\n\t\t<td>학번</td>\n\t\t<td>이름</td>\n\t</tr>\n";
while($row = $db->result->fetch_assoc()){
  $student_list = $student_list."\t<tr>\n\t\t<td><input type='checkbox' name='checkbox[]' id='checkbox[]' value='".$row[user_number]."'></td>\n";
  $student_list = $student_list."\t\t<td>".$row[user_number]."</td>\n";
  $student_list = $student_list."\t\t<td>".$row[user_name]."</td>\n\t</tr>\n";
}
$student_list = $student_list."</table>\n";


$last_day = date("t", mktime(0,0,0,6,1,2015));
$start_week = date("w", strtotime(date("Y-m")."-01"));
$total_week = ceil(($last_day + $start_week) / 7);
$last_week = date('w', strtotime(date("Y-m")."-".$last_day));

$day=1;
$day_list = '';
for($i=1; $i <= $total_week; $i++){
  $day_list = $day_list."<tr>";
  for ($j=0; $j<7; $j++){
    $day_list = $day_list."<td height='30' align='center' bgcolor='#FFFFFF'>";
    if (!(($i == 1 && $j < $start_week) || ($i == $total_week && $j > $last_week))){
      if($j == 0){
      $day_list = $day_list."<font color='#FF0000'>";
      }
      else if($j == 6){
        $day_list = $day_list."<font color='#0000FF'>";
      }
      else{
        $day_list = $day_list."<font color='#000000'>";
      }

      if($day == date("j")){
        $day_list = $day_list."<b>";
      }

      $day_list = $day_list."<input type='checkbox' name='day_list[]' id='day_list[]' value='".$day."'>$day";

      if($day == date("j")){
        $day_list = $day_list."</b>";
      }

      $day_list = $day_list."</font>";

      $day++;
    }
    $day_list = $day_list."</td>";
  }
  $day_list = $day_list."</tr>";
}
$day_list = $day_list."</table>";

echo '<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>';
echo '<script type="text/javascript" src="../js/lecture.js"></script>';

$base->AdminSide();
$base->content = '<center>
과목 현황 : '.$lecture_list.'
과목 번호 : <input type="text" name="lecture_number" id="lecture_number" required />
과목 명 : <input type="text" name="lecture_title" id="lecture_title" required /><p/></center>
<table width="500" cellpadding="0" cellspacing="1" bgcolor="#999999" align="center">
	<caption>강의 요일</caption>
	<tr>
		<td height="50" align="center" bgcolor="#FFFFFF" colspan="7">2015년 6월</td>
	</tr>
	<tr>
		<td height="30" align="center" bgcolor="#DDDDDD">일</td>
		<td align="center" bgcolor="#DDDDDD">월</td>
		<td align="center" bgcolor="#DDDDDD">화</td>
		<td align="center" bgcolor="#DDDDDD">수</td>
		<td align="center" bgcolor="#DDDDDD">목</td>
		<td align="center" bgcolor="#DDDDDD">금</td>
		<td align="center" bgcolor="#DDDDDD">토</td>
	</tr>
	'.$day_list.'
<p/>
<center>
시작 시간 : <input type="time" name="s_time" id="s_time" value="09:00:00" required />
강의 시간 : <input type="text" name="e_time" id="e_time" required /><p/>
<input type="button" name="submit" id="submit" value="과목추가" onclick="update_lecture()"/><p/>
'.$student_list.'
<p/>
<input type="button" name="update" id="update" value="학생추가" onclick="update_student()"/>
</center>';

$base->LayoutMain();
?>