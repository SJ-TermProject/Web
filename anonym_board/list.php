<?php
session_start();
$table="an_free";
$ripple="an_free_ripple";
extract($_POST);
   extract($_GET);
   extract($_SESSION);

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="../css/common.css" media="all">
     <link rel="stylesheet" type="text/css" href="../css/concert.css" media="all">
     <title></title>
     <style>
       #list_search {
         height: 40px;
       }
       #list_search #list_search2 {
         margin-left: 250px;
       }
       #list_top_title {
         height: 40px;
       }
       #list_top_title #list_title2 {
         margin-left:240px;
       }
       #list_top_title #list_title3 {
         margin-left:250px;
       }
       #list_top_title #list_title4 {
         margin-left:50px;
       }
       #list_top_title #list_title5 {
         margin-left:50px;
       }
       #list_item {
         padding: 1px;
         width: 100%;
         height: 30px;
       }
       #list_item #list_item1 {
         margin-left: 5px;
         width: 40px;
       }
       #list_item #list_item2 {
         margin-left: 20px;
         width: 490px;
       }
       #list_item #list_item3 {
         margin-left: 5px;
         width: 60px;
       }
       #list_item #list_item4 {
         margin-left: 5px;
         width: 120px;
       }
       #list_item #list_item5 {
         margin-left: 10px;
         width: 30px;
       }
       #page_num {
         float: center;
         margin-top: 1px;
       }
       #page_button {
         height: 50px;
       }
     </style>
   </head>
   <?php
   include "../lib/dbconn.php";
   $scale=10;

if(isset($mode)){
   if($mode=="search")
   {
     if(!$search)
     {
       echo("
       <script>
       window.alert('검색할 단어를 입력해 주세요!');
       history.go(-1);
       </script>
       ");
       exit;
     }
     $sql="select * from $table where $find like '%search%' order by num desc";
   }
   else{
     $sql="select * from $table order by num desc";
   }
 }else{
   $sql="select * from $table order by num desc";
 }

   $result = mysql_query($sql, $connect);
   $total_record = mysql_num_rows($result);

   if($total_record % $scale==0)
    $total_page=floor($total_record/$scale);
   else
     $total_page=floor($total_record/$scale) + 1;

     if(!isset($page))
      $page = 1;

      $start=($page - 1) * $scale;
      $number=$total_record - $start;

    ?>
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
             <img src="../img/title_concert.gif">
           </div>

           <form name="board_form" action="list.php?table=<?=$table?>&mode=search" method="post">
             <div id="list_search">
               <div id="list_search1"> ▷ 총 <?= $total_record ?> 개의 게시물이 있습니다. </div>
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
           <div class="clear"></div>

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
             <?
             for($i=$start; $i < $start+$scale && $i < $total_record; $i++){
               mysql_data_seek($result, $i);

               $row=mysql_fetch_array($result);
               $item_num=$row['num'];
               $item_id=$row['id'];
               $item_name=$row['name'];
               $item_hit=$row['hit'];
               $item_date=$row['regist_day'];
               $item_date=substr($item_date, 0, 10);
               $item_subject=str_replace(" ","&nbsp;",$row['subject']);

               $sql="select * from $ripple where parent=$item_num";
               $result2=mysql_query($sql, $connect);
               $num_ripple=mysql_num_rows($result2);
               ?>
               <div id="list_item">
                 <div id="list_item1"><?=$number ?></div>
                 <div id="list_item2"><a href="view.php?table=<?=$table?>
                   &num=<?=$item_num?>&page=<?=$page?>"><?=$item_subject?></a>
                   <?
                    if($num_ripple)
                      echo "[$num_ripple]";
                   ?>
                 </div>
                 <div id="list_item3"><?=$username?></div>
                 <div id="list_item4"><?=$item_date?></div>
                 <div id="list_item5"><?=$item_hit?></div>
               </div>
               <?php
               $number--;
             }
                ?>
                <div id="page_button">
                  <div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp;
                    <?
                    for($i=1;$i<=$total_page;$i++){
                      if($page==$i){
                        echo "<b> $i <b>";
                      }
                      else{
                        echo "<a href='list.php?table=$table&page=$i'> $i </a>";
                      }
                    }
                    ?>
                    &nbsp;&nbsp;&nbsp;&nbsp; 다음 ▶
                  </div>
                  <div id="button">
                    <a href="list.php?table=<?=$table?>&page=<?=$page?>">
                    <img src="../img/list.png"></a>&nbsp;
                    <?
                    if($userid){
                      ?>
                      <a href="write_form.php?table=<?=$table?>">
                      <img src="../img/write.png"></a>
                      <?
                    }
                    ?>

                  </div>
                </div>
              </div>
              <div class="clear"></div>


         </div>

       </div>

     </div>

   </body>
 </html>
