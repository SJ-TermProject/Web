<div id="header">
  <? include "../top_header.php"; ?>
</div>  <!--end of header-->
<div id="menu">
  <? include "main_menu.php"; ?>
</div>
<?php
  session_start();
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <?php

   include "../lib/dbconn.php";
   $scale = 10;  //한 화면에 표시되는 글의 개수

   if($mode=="search"){
     if(!$search){
       echo("
       <script>
       window.alert('검색한 단어를 입력해 주세요!');
       history.go(-1);
       </script>
       ");
       exit;
     }
     $sql="select * from $table where $find like '%$search%' order by num desc";
   }
   else {
     $sql="select * from $table order by num desc";
   }

   $result = mysql_query($sql, $connect);
   $total_record = mysql_num_rows($result); //전체 글의 개수

   if($total_record % $scale==0)
   $total_page = floor($total_record/$scale);
    else {
      $total_page=floor($total_record/$scale) + 1;
    }
    if(!$page)
      $page=1;

    //표시할 페이지($page)에 따라 $start 계산
    $start = ($page-1) * $scale;
    $number = $total_record - $start;
    ?>
   <body>
     <div id="wrap">
       <div id="header">
         <? include "../lib/top_login2.php"; ?>
       </div>

       <div id="menu">
         <? include "../lib/top_menu2.php"; ?>
       </div>

       <div id="content">
         <div id="col1">
           <div id="left_menu">
             <? include "../lib/left_menu.php";?>
           </div>
         </div>
         <div id="col2">
           <div id="title">
             <img src="../img/title_concert.gif">
           </div>

           <form name="board_form" action="list.php?table=<?=$table?>&mode=search" method="post">
             <div id="list_search">
               <div id="list_search1"> => 총 <?= $total_record ?> 개의 게시물이 있습니다.</div>
               <div id="list_search2"> <img src="../img/select_search.gif"></div>
               <div id="list_search3">
                 <select name="find">
                   <option value="subject">제목</option>
                   <option value="content">내용</option>
                   <option value="name">이름</option>
                 </select>
               </div>
               <div id="list_search4"><input type="text" name="search"></div>
               <div id="list_search5"><input type="image" src="../img/list_search_button.gif"></div>
             </div>
           </form>
           <div class="clear">
           </div>

           <div id="list_top_title">
             <ul>
               <li id="list_title1"><img src="../img/list_title1.gif"></li>
               <li id="list_title2"><img src="../img/list_title2.gif"></li>
               <li id="list_title3"><img src="../img/list_title3.gif"></li>
               <li id="list_title4"><img src="../img/list_title4.gif"></li>
               <li id="list_title5"><img src="../img/list_title5.gif"></li>
             </ul>
           </div>

           <div id="list_content">
             <?php
             for($i=$start; $i<$start+$scale && $i < $total_record; $i++){
               //가져올 레코드로 위치(포인터) 이동
               mysql_data_seek($result, $i);

               //하나의 레코드 가져오기
               $row=mysql_fetch_array($result);
               $item_num=$row[num];
               $item_id=$row[id];
               $item_name=$row[name];
               $item_hit=$row[hit];
               $item_date=$row[regist_day];
               $item_date=substr($item_date, 0, 10);
               $item_subject = str_replace(" ","&nbsp;",$row[subject]);
               ?>

               <div id="list_item">
                 <div id="list_item1"><?=$number ?></div>
                 <div id="list_item2"><a href="view.php?table=<?=$table?>
                   &num=<?=$item_num?>&page=<?=$page?>"><?=$item_subject ?></a></div>
                 <div id="list_item3"><?=$item_date ?></div>
                 <div id="list_item4"><?=$item_hit ?></div>
                 </div>
                 <?
                 $number--;
               }
               ?>
               <div id="page_button">
                 <div id="page_num"> 이전 &nbsp;&nbsp;&nbsp;&nbsp;
                   <?
                   //게시판 목록 하단에 페이지 링크 번호 출력
                   for($i=1; $i<=$total_page; $i++)
                   {
                     if($page==$i){
                       echo "<b> $i </b>";
                     }
                     else{
                       echo "<a href='list.php?table=$table&page=$i'>$i</a>";
                     }
                   }
                   ?>
                   &nbsp;&nbsp;&nbsp;&nbsp;다음
                 </div>
                 <div id="button">
                   <a href="list.php?table=<?=$table?>&page=<?=$page?>">
                   <img src="../img/list.png"></a>&nbsp;
                   <?
                   if($userid){
                     ?>
                     <a href="write_form.php?table=<?=$table?>">
                     <img src="../img/write.png">
                   </a>
                   <?
                   }
                   ?>

                 </div>

               </div>
               </div>
               <div class="clear">
               </div>


           </div>

         </div>

       </div>
   </body>
 </html>
