<?php
include('./admin_privilege.php');
include('./db_conn.php');

function lecture_list(){
	$query_result = mysql_query("select title from lecture");
	echo "<select id='title' name='title'>\n";
	while($row = @mysql_fetch_array($query_result)){
		echo "\t<option value='".$row[title]."'>".$row[title]."</option>\n";
	}
	echo "</select>\n<p/>\n";
}

function student_list(){
	$query_result = mysql_query("select student_number, student_name, lecture_1, lecture_2, lecture_3, lecture_4, lecture_5, lecture_6 from student_info");
	echo "<table border='1'>\n";
	echo "\t<tr>\n\t\t<td></td>\n\t\t<td>학번</td>\n\t\t<td>이름</td>\n\t\t<td>과목1</td>\n\t\t<td>과목2</td>\n\t\t<td>과목3</td>\n\t\t<td>과목4</td>\n\t\t<td>과목5</td>\n\t\t<td>과목6</td>\n\t</tr>\n";
	while($row = @mysql_fetch_array($query_result)){
		echo "\t<tr>\n\t\t<td><input type='checkbox' name='checkbox[]' id='checkbox[]' value='".$row[student_number]."'></td>\n";
		echo "\t\t<td>".$row[student_number]."</td>\n";
		echo "\t\t<td>".$row[student_name]."</td>\n";
		echo "\t\t<td>".$row[lecture_1]."</td>\n";
		echo "\t\t<td>".$row[lecture_2]."</td>\n";
		echo "\t\t<td>".$row[lecture_3]."</td>\n";
		echo "\t\t<td>".$row[lecture_4]."</td>\n";
		echo "\t\t<td>".$row[lecture_5]."</td>\n";
		echo "\t\t<td>".$row[lecture_6]."</td>\n\t</tr>\n";
		
	}
	mysql_close();
	echo "</table>\n";
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
	$.ajax({
		type: "POST",
		url: "lecture_submit.php",
		data: "lecture_title="+$('#lecture_title').val()+"&s_time="+$('#s_time').val()+"&e_time="+$('#e_time').val(),
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
과목명 : <input type="text" name="lecture_title" id="lecture_title" required />
시작 시간 : <input type="time" name="s_time" id="s_time" value="09:00:00" required />
끝 시간 : <input type="time" name="e_time" id="e_time" value="10:00:00" required />
<input type="button" name="submit" id="submit" value="과목추가" onclick="update_lecture()"/><p/>
과목 현황 : <?lecture_list()?>
<?student_list()?>
<p/>
<input type="button" name="update" id="update" value="학생추가" onclick="update_student()"/>
</body>
</html>