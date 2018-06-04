<?
  session_start();
  $num = $_POST['parent'];
  $userid = $_POST['id'];
  $username = $_POST['name'];
  $ripple_content = $_POST['content'];
  $regist_day = $_POST['regist_day'];
?>
<meta charset="utf-8">
<?
  if(!$userid) {
    echo("
      <script>
        window.alert('로그인 후 이용하세요.')
        history.go(-1)
      </script>
    ");
    exit;
  }
  include "../lib/dbconn.php";

  $regist_day=date("Y-m-d (H:i)")

  $sql="insert into free_ripple (parent, id, name, content, regist_day) ";
  $sql="values($num, '$userid', '$username', '$ripple_content', '$regist_day')";

  mysql_query($sql, $connect);
  mysql_close();

  echo ("
    <script>
      location.href='view.php?table=$table&num=$num';
    </script>
  ");
?>
