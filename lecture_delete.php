<?php
require_once './db.php';
require_once './admin_privilege.php';

function lecture_list(){
	$db = new DBC;
	$db->DBI();
	$db->query = "select lecture.lecture_number as lecture_number, lecture.title as title, lecture_time.took_time as took_time from lecture,lecture_time group by lecture_number";
	$db->DBQ();
	$db->DBO();
	echo "<table border='1'>\n";
	echo "\t<tr>\n\t\t<td></td>\n\t\t<td>과목명</td>\n\t\t<td>강의 시간</td>\n\t</tr>\n";
	while($row = $db->result->fetch_assoc()){
		echo "\t<tr>\n\t\t<td><input type='checkbox' name='lecture_number[]' id='lecture_number[]' value='".$row[lecture_number]."'></td>";
		echo "\n\t\t<td>".$row[title]."</td>";
		//echo "\n\t\t<td>".$row[start_time]."</td>";
		//echo "\n\t\t<td>".$row[take_time]."</td>";
		echo "\n\t\t<td>".$row[took_time]."</td>\n\t</tr>\n";
	}
	echo "</table>\n";
}
?>
<html>
<meta charset="UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<LINK href="../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
function delete_lecture(){
	var checked = []
	$("input[name='lecture_number[]']:checked").each(function (){
		checked.push($(this).val());
	});
	$.ajax({
		type: "POST",
		url: "lecture_list_delete.php",
		data: "lecture_number="+checked,
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
<?lecture_list()?>
<p/>
<input type="button" name="update" id="update" value="과목삭제" onclick="delete_lecture()"/>
</body>
</html>
