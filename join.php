<?php
require_once './layout.inc';
require_once './db.php';

$base = new Layout;
$base->link = './style.css';
$base->title = '사용자 등록';
$db = new DBC;
$db->DBI();

$ip=getenv("REMOTE_ADDR");
if(PHP_OS=='WINNT'){
	exec("arp -a", $rgResult);
	$mac_template="/[\d|A-F]{2}\-[\d|A-F]{2}\-[\d|A-F]{2}\-[\d|A-F]{2}\-[\d|A-F]{2}\-[\d|A-F]{2}/i"; 
	foreach($rgResult as $key=>$value){ 
		if(strpos($value, $ip)!==FALSE){ 
			preg_match($mac_template, $value, $matches);
			break; 
		} 
	} 
} else{ 
	exec("arp -a | grep $ip", $rgResult); 
	$mac_template="/[\d|A-F]{2}\:[\d|A-F]{2}\:[\d|A-F]{2}\:[\d|A-F]{2}\:[\d|A-F]{2}\:[\d|A-F]{2}/i"; 
	preg_match($mac_template, $rgResult[0], $matches); 
} 
$mac="55-55-55-55-55-55";#$matches[0];

$db->query = "select mac_address from user where mac_address = '".$mac."'";
$db->DBQ();
$db->DBO();

$result = $db->result->num_rows;
if($result > 0){
	echo "<script type='text/javascript'>";
	echo "alert('본 기기의 맥주소는 이미 등록 되어 있습니다 다른 기기로 등록 바랍니다');";
	echo "location.replace('./welcome.php');";
	echo "</script>";
}

$base->head='
<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="../js/check.js">
function pre_sign(){
	if($("input:checked").val() == "1"){
		alert("수집에 동의 바랍니다");
		return false;
	}
	if($("#sn").val() == ""){
		alert("학번을 입력 바랍니다");
		return false;
	}
	if($("#password").val() == ""){
		alert("비밀번호를 입력 바랍니다");
		return false;
	}
	if($("#name").val() == ""){
		alert("이름을 입력 바랍니다");
		return false;
	}
	
	$.ajax({
		type: "POST",
		url: "submit.php",
		data: "id="+$("#sn").val()+"&passwd="+$("#password").val()+"&name="+$("#name").val()+"&mac="+$("#mac").val(),
		cache: false,
		success: function(data){
			if(data == 0){
				alert("회원가입 되었습니다");
				location.replace("./login.php");
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
					$("#sn").val("");
				}				
			}
		});
	}
}</script>';

$base->content='
<table style="margin:0 auto; margin-top:5%;">
  <thead>
    <tr>
      <td colspan=2>
        <center>
          <textarea rows="4" cols="50">출석 체크 및 출석 결과 확인을 위해 학번 및 맥주소 수집에 동의 하십니까?</textarea>
        </center>
      </td>
    </tr>
    <tr>
      <td colspan=2>
        <center>
          <input type="radio" name="radio" id="radio_agree" value="0" checked/>동의
          <input type="radio" name="radio" id="radio_deny" value="1"/>거절
        </center>
        <br/><br/><br/>
      </td>
    </tr>
    <tr> 
      <th colspan=2><b> 회 원 가 입 </b></th>
    </tr>
    <tr><td></td></tr>
  </thead>
  <tfoot>
    <tr>
      <td colspan=2><center><p></p><p><br/><input type="submit" name="submit" id="submit" onclick="pre_sign()" value="가입"/></center></td>
    </tr>
  </tfoot>
  <tbody>
    <tr>
      <td>학번</td>
      <td><input type="text" name="sn" id="sn" size="20" onkeyup="dsn(this)" required /></td>
    </tr>
    <tr>
      <td>비밀번호</td>
      <td><input type="password" name="password" id="password" size="20" required /></td>
    </tr>
    <tr>
      <td>이름</td>
      <td><input type="text" name="name" id="name" size="20" required /></td>
    </tr>
    <tr>
      <td>맥주소</td>
      <td><input type="text" name="mac" id="mac" size="20" value="'.$mac.'" readonly required /></td>
    </tr>
  </tbody>
</table>';

$base->LayoutMain();
?>