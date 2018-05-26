<?php
 date_default_timezone_set('Asia/Tokyo');

  if(isset($_GET['ym'])) {
  $ym = $_GET['ym'];
}else{
  $ym = date('Y-m');
}

$timestamp = strtotime($ym,"-01");
if($timestamp === false) {
  $timestamp = time();
}

$today = date('Y-m-d',time());

$html_title = date('Y/m',$timestamp);

$prev = date('Y-m',mktime(0,0,0,date('m',$timestamp)-1,1,date('Y',$timestamp)));
$next = date('Y-m',mktime(0,0,0,date('m',$timestamp)+1,1,date('Y',$timestamp)));

$day_count = date('t',$timestamp);

$str = date('w',mktime(0,0,0,date('m',$timestamp),1,date('Y',$timestamp)));

$weeks = array();
$week = '';

$week .= str_repeat('<td></td>',$str);

for($day = 1; $day <= $day_count; $day++, $str++){
  $date = $ym.'-'.$day;

  if($today == $date){
    $week .= '<td class="today">'.$day;
  }else {
    $week .= '<td>'.$day;
  }
  $week .= '</td>';

  if($str % 7 == 6 || $day == $day_count) {
    if($day == $day_count){
      $week .= str_repeat('<td></td>', 6 - ($str % 7));
    }

    $weeks[] = '<tr>'.$week.'</tr>';

    $week = '';
  }
}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP calendar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <style>
      .container {
        margin-top: 80px;
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
    </style>
  </head>
  <body>
    <div id="header">
      <? include "top_header.php"; ?>
    </div>  <!--end of header-->
    <ul class="nav nav-pills">
      <li role="presentation"><a href="./meun/schedule.php"> 상세일정 </a></li>
      <li role="presentation"><a href="./menu/notice.php"> 공지사항 </a></li>
      <li role="presentation"><a href="./menu/board.php"> 자유게시판 </a></li>
      <li role="presentation"><a href="./menu/anonymous_board.php"> 익명게시판 </a></li>
    </ul>
    <div class="container">
      <h3><a href='?ym=<?php echo $prev; ?>'> &lt; </a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>"> &gt; </a></h3>
      <br>
      <table class="table table-borderd">
        <tr>
          <th>S</th>
          <th>M</th>
          <th>T</th>
          <th>W</th>
          <th>T</th>
          <th>F</th>
          <th>S</th>
        </tr>
        <?php
          foreach($weeks as $week) {
            echo $week;
          }

        ?>


      </table>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  </body>
</html>
