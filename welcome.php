<?php
session_start();
session_destroy();
?>
<html>
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
function kd(){
	if(event.keyCode == 13){
		login();
	}
}
function join(){
	location.replace("./join.php");
}
function login(){
	$.ajax({
		type: "POST",
		url: "login.php",
		data: "id="+$('#id').val()+"&passwd="+$('#password').val(),
		cache: false,
		success: function(data){
			if(data == 0){
				alert("환영합니다");
				location.replace("./view.php?id="+document.getElementById('id').value);
			}		
			else{
				alert("없는 ID이거나 비빌먼호를 잘못 입력 하셨습니다");
			}				
		}
	});
}
</script>
<title>환영합니다</title>
</head>
<body>
<div>
	<span>아이디 : <input type="text" name="id" id="id" /></span>
	<span>비밀번호 : <input type="password" name="pass" id="pass" onkeydown="kd()"/></span>
</div>
<br>
<div>	
	<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	<span><input type="submit" name="join" id="join" onclick="join()" value="회원가입"/></span>
	<span><input type="submit" name="login" id="login" onclick="login()" value="로그인"/></span>
</div>
</body>
</html>