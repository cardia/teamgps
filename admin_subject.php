<?php
include('./admin_privilege.php');
include('./simple_html_dom.php');
include('./db_conn.php');

$now = date("s",time())*1000;
$semi = date("s",mktime(0,0,30,0,0,0)) * 1000;
if($now - $semi != 0){
	$now = $semi - $now;
	if($now < 0){
		$now = $semi-abs($now);
	}
}

$html = file_get_html('http://192.168.0.1/cgi-bin/timepro.cgi?tmenu=netconf&smenu=laninfo');

echo "<table border='1'>";
echo "<tr><td>학번</td><td>이름</td><td>수업 시작<td>수업 중간</td><td>출석결과</td></tr><tr>";
foreach($html->find('.item_td') as $mac){
	if(preg_match('/[0-9a-fA-F][0-9a-fA-F][:\-][0-9a-fA-F][0-9a-fA-F][:\-][0-9a-fA-F][0-9a-fA-F][:\-][0-9a-fA-F][0-9a-fA-F][:\-][0-9a-fA-F][0-9a-fA-F][:\-][0-9a-fA-F][0-9a-fA-F]/i',$mac)){
		$mac = strip_tags($mac);
		$query = "update chul_check set first_check = 1 where mac_address = '".$mac."'";
		mysql_query($query);		
		//if(date("i",time())>=29 && date("i",time())<=31){
		if(date("s",time())>=29 && date("s",time())<=31){
			$semi_query = "update chul_check set semi_check = 1 where mac_address = '".$mac."'";
			mysql_query($semi_query);
		}
		//if(date("i",time())>=59 && date("i",time())<=01){
		elseif(date("s",time())<=02){
			$final_query = "update chul_check set final_check = 1 where semi_check = 1 and first_check = 1 and mac_address = '".$mac."'";
			mysql_query($final_query);
			$query = "update chul_check set final_check = 0 where final_check != 1";
			mysql_query($query);
		}
	}
}
draw();
echo "<script language='javascript'>";
echo "window.setTimeout('window.location.reload()',".$now.");"; 
echo "</script>";

function draw(){
	$query = "select student_number, student_name, first_check, semi_check, final_check from chul_check";
	$result = mysql_query($query);
	while($row = @mysql_fetch_array($result)){
		echo "<td>".$row[student_number]."</td>";
		echo "<td>".$row[student_name]."</td>";
		switch ($row[first_check]){
			case 0: $first_check = "미출석";break;
			case 1: $first_check = "출석";break;
		}
		switch ($row[semi_check]){
			case 0: $semi_check = "미출석";break;
			case 1: $semi_check = "재실";
		}
		if(!is_null($row[final_check])){
			switch ($row[final_check]){
				case 0: $final_check = "결석";break;
				case 1: $final_check = "출석";break;
			}
			if($row[first_check]==1 && $row[semi_check]==0){
				$final_check = "도망";
			}
			elseif($row[first_check]==0 && $row[semi_check]==1){
				$final_check = "지각";
			}
		}
		else{
			$final_check = "체크 전";
		}
		echo "<td>".$first_check."</td>";
		echo "<td>".$semi_check."</td>";
		echo "<td>".$final_check."</td></tr>";
	}
}
mysql_close();
?>