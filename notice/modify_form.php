<?php
session_start();
extract($_POST);
   extract($_GET);
   extract($_SESSION);
include "../lib/dbconn.php";

$sql="select * from greet where num=$num";
$result = mysql_query($sql,$connect);

$row=mysql_fetch_Array($result);
$item_subject=$row['subject'];
$item_content=$row['content'];
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="../css/common.css" media="all">
     <link rel="stylesheet" type="text/css" href="../css/greet.css" media="all">
     <title></title>
   </head>
   <body>
   <div id="wrap">
     <div id="header">
       <? include "../top_header.php"; ?>
     </div>

     <div id="menu">
       <? include "main_menu.php"; ?>
     </div>

     <div id="content">

       <div id="col2">
         <div id="title">
           <h5>&nbsp;공지사항</h5>
         </div>
         <div class="clear"></div>

         <div id="write_form_title">
           <p>글쓰기</p>
         </div>

         <div class="clear"></div>
         <form name="board_form" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>" method="post">

           <div id="write_form">
             <div class="write_line">
             </div>
             <div id="write_row1">
               <div class="col1">이름</div>
               <div class="col2"><?=$username?></div>
            </div>
            <div class="write_line"></div>
            <div id="write_row2"><div class="col1"> 제목 </div>
            <div class="col2"><input type="text" name="subject" value="<?=$item_subject?>"></div>
            </div>
            <div class="write_line"></div>
            <div id="write_row3"><div class="col1"> 내용  </div>
            <div class="col2"><textarea name="content" rows="15" cols="79">
              <?=$item_content?></textarea></div>
            </div>
            <div class="write_line"></div>
           </div>

           <div id="write_button"><input type="image" src="../img/ok.png">&nbsp;
             <a href="list.php?page=<?=$page?>"><img src="../img/list.png"></a>
           </div>

         </form>

       </div>

     </div>

   </div>
 </body>
 </html>
