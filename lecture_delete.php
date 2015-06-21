<?php
require_once './layout.inc';
require_once './db.php';
require_once './admin_privilege.php';

$base = new Layout;
$base->link = './style.css';

$db = new DBC;
$db->DBI();
$db->query = "select lecture.lecture_number as lecture_number, lecture.title as title, lecture_time.took_time as took_time 
from lecture,lecture_time group by lecture_number";
$db->DBQ();
$db->DBO();
$subjects = "<table class='view' style='margin:1 auto; margin-top:5%; width='90%' cellpadding='3' cellspacing='0' border='1' align='center' style='border-collapse:collapse; border:1px gray solid;'>\n";
$subjects = $subjects."\t<tr>\n\t\t<td></td>\n\t\t<td>과목명</td>\n\t\t<td>강의 시간</td>\n\t</tr>\n";
while($row = $db->result->fetch_assoc()){
  $subjects = $subjects."\t<tr>\n\t\t<td><input type='checkbox' name='lecture_number[]' id='lecture_number[]' value='".$row[lecture_number]."'></td>";
  $subjects = $subjects."\n\t\t<td>".$row[title]."</td>";
  //$subjects = $subjects."\n\t\t<td>".$row[start_time]."</td>";
  //$subjects = $subjects."\n\t\t<td>".$row[take_time]."</td>";
  $subjects = $subjects."\n\t\t<td>".$row[took_time]."</td>\n\t</tr>\n";
}
$subjects = $subjects."</table>\n";


echo '<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>';
echo '<script type="text/javascript" src="../js/lecture.js"></script>';

$base->AdminSide();
$base->content = $subjects.'<p/>
<center><input type="button" name="update" id="update" value="과목 삭제" onclick="delete_lecture()"/></center>';

$base->LayoutMain();
?>
