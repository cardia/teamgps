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
