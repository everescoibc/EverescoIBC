<html>
<head>
<meta charset="utf-8">
</head>
<?php
	include "dbonline.php";

	//세션 변수 대입
	$keypw = $_SESSION['keypw'];

	//키 체크
	$keycheck = "SELECT * FROM user WHERE keypw = '{$keypw}'";
	$res01 = $db->query($keycheck);

	//키 값 존재할 경우
	if($res01->num_rows == 1){
		
		//비번 일치여부 확인
		$pw = $_POST['password'];
		$repw = $_POST['repassword'];
		
		//일치할 경우
		if($pw == $repw){

			//비밀번호 함수화
			//$userpw = password_hash($_POST['password'], PASSWORD_DEFAULT);
	
			//sql 회원정보 전송
			$sql = mq("UPDATE user SET password='".$pw."' WHERE keypw='{$keypw}'");
			
			//세션 해제
			session_unset();
			
		}
		
		//일치하지 않을 경우
		else{
			echo "<script>alert('邮箱与密码不一致。'); location.href='../cn/resetpw-pw.php';</script>";
		}
		
	}
	else{
		echo "<script>alert('没有认证。'); location.href='../cn/sign-in.php';</script>";
	}
?>
<script type="text/javascript">alert("密码重置成功请登录。"); location.href='../cn/sign-in.php';</script>
</html>