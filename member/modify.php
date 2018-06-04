<?
  session_start();
  extract($_POST);
     extract($_GET);
     extract($_SESSION);

  $userid = $_SESSION['userid'];
?>
<meta charset="euc-kr">
<?
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

  include "../lib/dbconn.php";  //dconn.php 파일을 불러옴

  $sql = "update member set pw='$pw', name='$name', ";
  $sql .= "hp='$hp', email='$email', birth_day='$birth_day' where id='$userid'";

  mysql_query($sql, $connect);

  mysql_close();  // DB 연결 종료
  echo "
	  <script>
	   location.href = '../index.php';
	  </script>
	";
?>
