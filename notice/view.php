<?
session_start();
extract($_POST);
   extract($_GET);
   extract($_SESSION);
$table="greet";

include "../lib/dbconn.php";

$sql="select * from $table where num=$num";

$result=mysql_query($sql, $connect);

$row=mysql_fetch_array($result);

$item_num = $row[num];
$item_id = $row[id];
$item_name = $row[name];
$item_hit = $row[hit];
$item_date = $row[regist_day];
$item_subject = str_replace(" ","&nbsp;",$row[subject]);
$item_content = $row[content];
$is_html = $row[is_html];

if($is_html!="y"){
  $item_content=str_replace(" ","&nbsp;",$item_content);
  $item_content=str_replace("\n","<br>",$item_content);
}

$new_hit=$item_hit + 1;
$sql="update $table set hit=$new_hit where num=$num";
mysql_query($sql, $connect);

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="../css/common.css" media="all">
     <link rel="stylesheet" type="text/css" href="../css/greet.css" media="all">
     <title></title>
     <script>
     function del(href){
       if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n 정말 삭제하시겠습니까?"))
       {
         document.location.href=href;
       }
     }
     </script>
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
               <img src="../img/title_greet.gif">
             </div>

             <div id="view_comment">&nbsp;</div>

             <div id="view_title">
               <div id="view_title1"><?=$item_subject ?></div>
               <div id="view_title2"><?=$item_name ?> | 조회 : <?=$item_hit ?> | <?=$item_date ?>
               </div>
             </div>

             <div id="view_content">
               <?=$item_content ?>
             </div>

             <div id="view_button">
               <a href="list.php?page=<?=$page?>">
                <img src="../img/list.png"></a>&nbsp;
                <?
                if($userid==$item_id || $userid=="admin" || $userlevel==0){
                  ?>
                  <a href="write_form.php?num=<?=$num?>&page=<?=$page?>"><img src="../img/modify.png"></a>&nbsp;
                  <a href="javascript:del('delete.php?num=<?=$num?>')">
                  <img src="../img/delete.png"></a>&nbsp;
                  <?
                }
                ?>
                <?
                if($userid){
                  ?>
                  <a href="write_form.php"><img src="../img/write.png"></a>
                  <?
                }

                 ?>
             </div>
             <div class="clear"></div>
           </div>

         </div>

       </div>

   </body>
 </html>
