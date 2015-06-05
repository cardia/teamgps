function pre_sign(){
	if($('input:checked').val() == "1"){
		alert("수집에 동의 바랍니다");
		return false;
	}
	if($('#sn').val() == ""){
		alert("학번을 입력 바랍니다");
		return false;
	}
	if($('#password').val() == ""){
		alert("비밀번호를 입력 바랍니다");
		return false;
	}
	if($('#name').val() == ""){
		alert("이름을 입력 바랍니다");
		return false;
	}
	
	if($('#major').val() == ""){
		alert("이름을 입력 바랍니다");
		return false;
	}	
	
	$.ajax({
		type: "POST",
		url: "submit.php",
		data: "id="+$('#sn').val()+"&passwd="+$('#password').val()+"&name="+$('#name').val()+"&mac="+$('#mac').val()+"&major="+$('#major').val(),
		cache: false,
		success: function(data){
			if(data == 0){
				alert("회원가입 되었습니다");
				location.replace("./welcome.php");
			}
			else{
				alert("서버 오류로 가입에 실패 하였습니다\n 잠시후 다시 시도 바랍니다");
			}				
		}
	});
}
function dsn(sn){
	var id = sn.value;
	if(sn.value.length==9){
		$.ajax({
			type: "POST",
			url: "check_sn.php",
			data: "id="+ id ,
			cache: false,
			success: function(data){
				if(data == 0){
					alert("사용 가능한 학번 입니다");
				}
				else{
					alert("사용 중인 학번 입니다");
					$('#sn').val("");
				}				
			}
		});
	}
}
