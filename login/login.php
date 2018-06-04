<?
  session_start();

  $id = $_POST['id'];
  $pw = $_POST['pw'];
?>
<meta charset="utf-8">
<?
  //이전 화면에서 이름이 입력되지 않았으면 "이름을 입력하세요."
  //메세지 출력
  if(!$id) {  //isset($id) 안되면 이렇게 하기
    echo ("
      <script>
        window.alert('아이디를 입력하세요.')
        history.go(-1)
      </script>
    ");
    exit;
  }

  if(!$pw) {
    echo ("
      <script>
        window.alert('비밀번호를 입력하세요.')
        history.go(-1)
      </script>
    ");
    exit;
  }

  include "../lib/dbconn.php";

  $sql = "select * from member where id='$id'";
  $result = mysql_query($sql, $connect);
  $num_match = mysql_num_rows($result);

  if(!$num_match) {
    echo ("
      <script>
        window.alert('등록되지 않은 아이디입니다.')
        history.go(-1)
      </script>
    ");
  }
  else {
    $row = mysql_fetch_array($result);
    $db_pw = $row[pw];

    if($pw!=$db_pw) {
      echo ("
        <script>
          window.alert('비밀번호가 틀립니다.')
          history.go(-1)
        </script>
      ");
      exit;
    }
    else {
      $userid = $row[id];
      $username = $row[name];
      $userlevel = $row[level];

      $_SESSION['userid'] = $userid;
      $_SESSION['username'] = $username;
      $_SESSION['userlevel'] = $userlevel;

      echo ("
        <script>
          location.href = '../index.php';
        </script>
      ");
    }
  }
?>
