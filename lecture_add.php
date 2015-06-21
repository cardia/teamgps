<?php
require_once './db.php';
require_once './admin_privilege.php';

function lecture_list(){
	$db = new DBC;
	$db->DBI();
	$db->query = "select title,lecture_number from lecture";
	$db->DBQ();
	$db->DBO();
	echo "<select id='title' name='title'>\n";
	while($row = $db->result->fetch_assoc()){
		echo "\t<option value='".$row[lecture_number]."'>".$row[title]."(".$row[lecture_number].")</option>\n";
	}
	echo "</select>\n<p/>\n";
}

/*function student_list(){
	$db = new DBC;
	$db->DBI();
	$db->query = "select u.user_number, u.user_name l.title from user as u, lecture as l";
	$db->DBQ();
	$db->DBO();
	echo "<table border='1'>\n";
	//echo "\t<tr>\n\t\t<td></td>\n\t\t<td>학번</td>\n\t\t<td>이름</td>\n\t\t<td>과목1</td>\n\t\t<td>과목2</td>\n\t\t<td>과목3</td>\n\t\t<td>과목4</td>\n\t\t<td>과목5</td>\n\t\t<td>과목6</td>\n\t</tr>\n";
	echo "\t<tr>\n\t\t<td></td>\n\t\t<td>학번</td>\n\t\t<td>이름</td>\n\t</tr>\n";
	while($row = $db->result->fetch_assoc()){
		echo "\t<tr>\n\t\t<td><input type='checkbox' name='checkbox[]' id='checkbox[]' value='".$row[user_number]."'></td>\n";
		echo "\t\t<td>".$row[user_number]."</td>\n";
		echo "\t\t<td>".$row[user_name]."</td>\n\t</tr>\n";
	}
	echo "</table>\n";
}*/
function day_list(){
	$last_day = date("t", mktime(0,0,0,6,1,2015));
	$start_week = date("w", strtotime(date("Y-m")."-01"));
	$total_week = ceil(($last_day + $start_week) / 7);
	$last_week = date('w', strtotime(date("Y-m")."-".$last_day));
	
	$day=1;
    for($i=1; $i <= $total_week; $i++){
		echo "<tr>";
		for ($j=0; $j<7; $j++){
			echo "<td height='30' align='center' bgcolor='#FFFFFF'>";
			if (!(($i == 1 && $j < $start_week) || ($i == $total_week && $j > $last_week))){
				if($j == 0){
				echo "<font color='#FF0000'>";
				}
				else if($j == 6){
					echo "<font color='#0000FF'>";
				}
				else{
					echo "<font color='#000000'>";
				}

				if($day == date("j")){
					echo "<b>";
				}

				echo "<input type='checkbox' name='day_list[]' id='day_list[]' value='".$day."'>$day";

				if($day == date("j")){
					echo "</b>";
				}

				echo "</font>";

				$day++;
			}
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
?>
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<LINK href="../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
function update_lecture(){
	var checked = []
	$("input[name='day_list[]']:checked").each(function (){
		checked.push(parseInt($(this).val()));
	});
	$.ajax({
		type: "POST",
		url: "lecture_submit.php",
		data: "lecture_number="+$('#lecture_number').val()+"&lecture_title="+$('#lecture_title').val()+"&lecture_day="+checked+"&s_time="+$('#s_time').val()+"&e_time="+$('#e_time').val(),
		cache: false,
		success: function(data){
			if(data == 0){
				alert("과목 추가 되었습니다");
				location.reload();
			}
			else{
				alert("서버 오류로 과목 추가에 실패 하였습니다\n 잠시후 다시 시도 바랍니다");
			}				
		}
	});
}
function update_student(){
	var checked = []
	$("input[name='checkbox[]']:checked").each(function (){
		checked.push(parseInt($(this).val()));
	});
	$.ajax({
		type: "POST",
		url: "student_update.php",
		data: "title="+$('#title').val()+"&student_number="+checked,
		cache: false,
		success: function(data){
			if(data == 0){
				alert("업데이트 되었습니다");
				location.reload();
			}			
		}
	});
}
</script>
</head>
<body>
과목 현황 : <?lecture_list()?>
과목 번호 : <input type="text" name="lecture_number" id="lecture_number" required />
과목 명 : <input type="text" name="lecture_title" id="lecture_title" required /><p/>
<table width='500' cellpadding='0' cellspacing='1' bgcolor='#999999'>
	<caption>강의 요일</caption>
	<tr>
		<td height='50' align='center' bgcolor='#FFFFFF' colspan='7'><?=date("Y년 n월")?></td>
	</tr>
	<tr>
		<td height='30' align='center' bgcolor='#DDDDDD'>일</td>
		<td align='center' bgcolor='#DDDDDD'>월</td>
		<td align='center' bgcolor='#DDDDDD'>화</td>
		<td align='center' bgcolor='#DDDDDD'>수</td>
		<td align='center' bgcolor='#DDDDDD'>목</td>
		<td align='center' bgcolor='#DDDDDD'>금</td>
		<td align='center' bgcolor='#DDDDDD'>토</td>
	</tr>
	<?day_list()?>
<p/>
시작 시간 : <input type="time" name="s_time" id="s_time" value="09:00:00" required />
강의 시간 : <input type="text" name="e_time" id="e_time" required /><p/>
<input type="button" name="submit" id="submit" value="과목추가" onclick="update_lecture()"/><p/>
<?//student_list()?>
<p/>
<!--<input type="button" name="update" id="update" value="학생추가" onclick="update_student()"/>-->
</body>
</html>
