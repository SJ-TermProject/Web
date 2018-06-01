<meta charset="euc-kr">
<?
  $id = $_POST['id'];
  $pw = $_POST['pw'];
  $name = $_POST['name'];
  $hp1 = $_POST['hp1'];
  $hp2 = $_POST['hp2'];
  $hp3 = $_POST['hp3'];
  $email1 = $_POST['email1'];
  $email2 = $_POST['email2'];
  $birth_day = $_POST['birth_day'];

  $hp = $hp1."-".$hp2."-".$hp3;
  $email = $email1."@".$email2;
  $ip = $REMOTE_ADDR;  //방문자의 IP 주소 저장

  include "../lib/dbconn.php";  //dconn.php 파일을 불러옴

  $sql = "select * from member where id='$id'";
  $result = mysql_query($sql, $connect);
  $exist_id = mysql_num_rows($result);

  if($exist_id) {
   echo("
         <script>
           window.alert('해당 아이디(학번)가 존재합니다.')
           history.go(-1)
         </script>
       ");
       exit;
  }
  else {  //레코드 삽입 명령을 $sqldp dlqfur
   $sql = "insert into member(id, pw, name, hp, email, birth_day, level) ";
   $sql .= "values('$id', '$pw', '$name', '$hp', '$email', '$birth_day', 2)";
   mysql_query($sql, $connect);  // $sql에 저장된 명령 실행
  }

  mysql_close();  // DB 연결 종료
  echo "
	  <script>
	   location.href = '../index.php';
	  </script>
	";
?>
