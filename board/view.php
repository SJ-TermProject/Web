<?
session_start();
extract($_POST);
   extract($_GET);
   extract($_SESSION);
$table="free";

include "../lib/dbconn.php";

$sql="select * from $table where num=$num"; //$num값이 안들어옴**

$result=mysql_query($sql, $connect);

$row=mysql_fetch_array($result);

$item_num = $row['num'];
$item_id = $row['id'];
$item_name = $row['name'];
$item_hit = $row['hit'];

$image_name[0] = $row['file_name_0'];
$image_name[1] = $row['file_name_1'];
$image_name[2] = $row['file_name_2'];

$image_copied[0] = $row['file_copied_0'];
$image_copied[1] = $row['file_copied_1'];
$image_copied[2] = $row['file_copied_2'];

$item_date = $row['regist_day'];
$item_subject = str_replace(" ","&nbsp;",$row['subject']);
$item_content = $row['content'];
$is_html = $row['is_html'];

if($is_html!="y"){
  $item_content=str_replace(" ","&nbsp;",$item_content);
  $item_content=str_replace("\n","<br>",$item_content);
}

for($i=0;$i<3;$i++){
  if($image_copied[$i]){
    $imageinfo=GetImageSize("./data/".$image_copied[$i]);

    $image_width[$i]=$imageinfo[0];
    $image_height[$i]=$imageinfo[1];
    $image_type[$i]=$imageinfo[2];

    if($image_width[$i]>785)
    $image_width[$i]=785;
  }
  else{
    $image_width[$i]="";
    $image_height[$i]="";
    $image_type[$i]="";
  }
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
     <link rel="stylesheet" type="text/css" href="../css/board4.css" media="all">
     <title></title>
     <script>
     function check_input() {
       if(!document.ripple_form.ripple_content.value) {
         alert("내용을 입력하세요!");
         document.ripple_form.ripple_content.focus();
         return;
       }
       document.ripple_form.submit();
     }

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
               <img src="../img/title_free.gif">
             </div>

             <div id="view_comment">&nbsp;</div>

             <div id="view_title">
               <div id="view_title1"><?=$item_subject ?></div>
               <div id="view_title2"><?=$item_name ?> | 조회 : <?=$item_hit ?> | <?=$item_date ?>
               </div>
             </div>

             <div id="view_content">
               <?
               for($i=0;$i<3;$i++){
                 if($image_copied[$i]){
                   $img_name=$image_copied[$i];
                   $img_name="./data/".$img_name;
                   $img_width=$image_width[$i];

                   echo "<img src='$img_name' width='$img_width'>"."<br><br>";
                 }
               }
               ?>
               <?=$item_content ?>
             </div>

             <div id="ripple">
               <?
               $sql="select * from free_ripple where parent='$item_num'";
               $ripple_result=mysql_query($sql);

               while($row_ripple=mysql_fetch_array($ripple_result)) {
                 $ripple_num=$row_ripple['num'];
                 $ripple_id=$row_ripple['id'];
                 $ripple_name=$row_ripple['name'];
                 $ripple_content=str_replace("\n", "<br>", $row_ripple['content']);
                 $ripple_content=str_replace(" ", "&nbsp;", $ripple_content);
                 $ripple_date=$row_ripple['regist_day'];
               ?>
               <div id="ripple_writer_title">
                 <ul>
                   <li id="writer_title1"><?=$ripple_name?></li>
                   <li id="writer_title2"><?=$ripple_date?></li>
                   <li id="writer_title3">
                     <?
                     if($userid=="admin" || $userid==$ripple_id)
                      echo "<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>[삭제]</a>";
                     ?>
                   </li>
                 </ul>
               </div>
               <div id="ripple_content"><?=$ripple_content?></div>
               <div class="hor_line_ripple"></div>
               <?
               }
               ?>

               <form name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">
                 <div id="ripple_box">
                   <div id="ripple_box1"><img src="../img/title_comment.gif"></div>
                   <div id="ripple_box2"><textarea rows="5" cols="65" name="ripple_content"></textarea></div>
                   <div id="ripple_box3"><a href="#"><img src="../img/ok_ripple.gif" onclick="check_input()"></a></div>
                 </div>
               </form>
             </div>

             <div id="view_button">
               <a href="list.php?table=<?=$table?>&page=<?=$page?>">
                <img src="../img/list.png"></a>&nbsp;
                <?
                if($userid && ($userid==$item_id)){
                  ?>
                  <a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>"><img src="../img/modify.png"></a>&nbsp;
                  <a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">
                  <img src="../img/delete.png"></a>&nbsp;
                  <?
                }
                ?>
                <?php
                if($userid){
                  ?>
                  <a href="write_form.php?table=<?=$table?>"><img src="../img/write.png"></a>
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
