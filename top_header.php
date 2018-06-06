<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/common.css">
  </head>
  <body>
    <div id="logo"><a href="../index.php"><i style="color: navy;" class="far fa-calendar-alt fa-4x"></i></a></div>
    <div id="moto"><img src="../img/logo1.png" style="width:300px;"></div>
    <div id="top_login">
      <?
    //  error_reporting(E_ALL & ~E_NOTICE );
        extract($_SESSION);

        if(!isset($userid)) {
      ?>
      <a href="../login/login_form.php">로그인</a>
      <a href="../member/member_form.php">회원가입</a>
      <?
        }
        else {
      ?>
      <?=$username?>(<?=$userid?> level:<?=$userlevel?>) |
      <a href="../login/logout.php">로그아웃</a> |
      <a href="../member/member_form_modify.php">정보수정</a>
      <?
        }
      ?>
    </div>

  </body>
</html>
