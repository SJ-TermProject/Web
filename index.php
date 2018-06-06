<?
session_start();
  extract($_POST);
     extract($_GET);
     $userid = $_SESSION['userid'];
     $username = $_SESSION['username'];
     $userlevel = $_SESSION['userlevel'];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP calendar</title>

    <link rel="stylesheet" type="text/css" href="css/common.css?ver=2">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <style>
      body {
        background-color: #efefef;
      }
      .container {
        width: 100%;
        margin-top: 10px;
      }
      th {
        height:30px;
        text-align: center;
      }
      td {
        height: 100px;
      }
      .today {
        background: orange;
      }
      th:nth-of-type(7),td:nth-of-type(7){
        color: blue;
      }
      th:nth-of-type(1),td:nth-of-type(1){
        color: red;
      }
      tbody tr {
        height: 104px;
      }
     tbody td {
       margin-bottom: 0px;
       height: 104px;
     }
     #carouselExampleControls {
       width: 100%;
     }
    </style>
  </head>
  <body>
    <div id="wrap">
    <!--상단 헤더-->
    <div id="header">
    <div id="logo"><a href="index.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: navy;" class="far fa-calendar-alt fa-4x"></i></a></div>
    <div id="moto"><img src="./img/logo.png" style="width:300px;"></div>
    <div id="top_login">
      <?
        if(!isset($userid)) {
      ?>
      <a href="./login/login_form.php">로그인</a>
      <a href="./member/member_form.php">회원가입</a>
      <?
        }
        else {
      ?>
      <?=$username?>(<?=$userid?> level:<?=$userlevel?>) |
      <a href="./login/logout.php">로그아웃</a> |
      <a href="./member/member_form_modify.php">정보수정</a>
      <?
        }
      ?>
    </div>
  </div>

    <!--네비게이션 바-->
    <div class="menu" style="background-color: navy; padding: 0px 150px 0px 150px;">
      <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
          <a class="nav-link" href="./schedule/list.php">상세일정</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./notice/list.php">공지사항</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./board/list.php">자유게시판</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./anonym_board/list.php">익명게시판</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./survey/survey.php" onClick="window.open(this.href, '', 'width=400, height=300'); return false;">설문조사</a>
        </li>
      </ul>
  </div>


<!--배너 -->
    <div class="container">

      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img style="height:600px; width: 100%;" class="w-100" src="./banner1.jpg"alt="첫번째 슬라이드">
        </div>
        <div class="carousel-item">
          <img style="height:600px; width: 100%;" class="w-100" src="./banner3.png"alt="두번째 슬라이드">
        </div>
        <div class="carousel-item">
          <img style="height:600px; width: 100%;" class="w-100" src="./banner2.jpg" alt="세번째 슬라이드">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">이전</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">다음</span>
      </a>
      </div>

      <br>


      <? include './calendar.php'; ?><div id='calendar'></div>

  </div>
</div>

<br>
    <?php
      include './footer.php';
      ?>
  </body>
</html>
