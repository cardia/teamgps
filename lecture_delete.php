<?php
include('./admin_privilege.php');
include('./db_conn.php');

function lecture_list(){
	$query_result = mysql_query("select * from lecture");
	echo "<table border='1'>\n";
	echo "\t<tr>\n\t\t<td></td>\n\t\t<td>과목명</td>\n\t\t<td>시작시간</td>\n\t\t<td>끝시간</td>\n\t</tr>\n";
	while($row = @mysql_fetch_array($query_result)){
		echo "\t<tr>\n\t\t<td><input type='checkbox' name='titlelist[]' id='titlelist[]' value='".$row[title]."'></td>\n";
		echo "\t\t<td>".$row[title]."</td>\n";
		echo "\t\t<td>".$row[s_time]."</td>\n";
		echo "\t\t<td>".$row[e_time]."</td>\n\t</tr>\n";
	}
	mysql_close();
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
	$("input[name='titlelist[]']:checked").each(function (){
		checked.push($(this).val());
	});
	$.ajax({
		type: "POST",
		url: "lecture_list_delete.php",
		data: "title="+checked,
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