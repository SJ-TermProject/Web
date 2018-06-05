<?
  session_start();
  extract($_SESSION);
  extract($_GET);
  extract($_POST);

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

  $regist_day=date("Y-m-d (H:i)");

  $sql="insert into an_free_ripple (parent, id, name, content, regist_day) ";
  $sql.="values($num, '$userid', '$username', '$ripple_content', '$regist_day')";
  mysql_query($sql, $connect);
  mysql_close();

  echo ("
    <script>
      location.href='view.php?table=$table&num=$num';
    </script>
  ");
?>
