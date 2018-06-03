<?php
session_start();
include "../lib/dbconn.php";

if($mode=="modify")
{
  $sql="select * from $table where num=$num";
  $result = mysql_query($sql, $connect);
  $row = mysql_fetch_array($result);

  $item_subject = $row[subject];
  $item_content = $row[content];

  $item_file_0=$row[file_name_0];
  $item_file_1=$row[file_name_1];
  $item_file_2=$row[file_name_2];

  $copied_file_0 = $row[$file_copied_0];
  $copied_file_1 = $row[$file_copied_1];
  $copied_file_2 = $row[$file_copied_2];
}

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="../css/common.css" media="all">
     <link rel="stylesheet" type="text/css" href="../css/concert.css" media="all">
     <title></title>
     <script>
     function check_input()
     {
       if(!document.board_form.subject.value)
       {
         alert("제목을 입력하세요!");
         document.board_form.subject.focus();
         return ;
       }

       if(!document.board_form.content.value){
         alert("내용을 입력하세요!");
         document.board_form.content.focus();
         return ;
       }
       document.board_form.submit();
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
             <img src="../img/title_concert.gif">
           </div>
           <div class="clear"></div>

           <div id="write_form_title">
             <img src="../img/write_form_title.gif">
           </div>
           <div class="clear"></div>

           <?
            if($mode=="modify")
            {
              ?>
              <form name="board_form" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>"
                 method="post" enctype="multipart/form-data">
                 <?
               }
               else
               {
                 ?>
                 <form name="board_form" action="insert.php?table=<?=$table?>" method="post" enctype="multipart/form-data">
                   <?
                 }
                 ?>
                 <div id="write_form">
                   <div class="write_line"></div>
                   <div id="write_row1"><div class="col1"> 이름 </div>
                   <div class="col2"><?=$username?></div>
                   <?
                   if($userid && ($mode !="modify"))
                   {
                     ?>
                     <div class="col3"><input type="checkbox" name="html_ok" value="y">
                        HTML 쓰기</div>
                        <?
                   }
                     ?>
                   </div>
                   <div class="write_line"></div>
                   <div id="write_row2"><div class="col1">제목</div>
                   <div class="col2"><input type="text" name="subject" value="<?=$item_subject?>"></div>
                 </div>
                 <div class="write_line"></div>
                 <div id="write_row3"><div class="col1">내용</div>
                 <div class="col2"><textarea name="content" rows="15" cols="79">
                 <?=$item_content?></textarea></div>
                 </div>
                 <div class="write_line"></div>
                 <div id="write_row4"><div class="col1"> 이미지파일1 </div>
                 <div class="col2"><input type="file" name="upfile[]"></div>
                 </div>
                 <div class="clear"></div>
                 <?
                 if($mode=="modify" && $item_file_0){

                  ?>
                  <div class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다.
                    <input type="checkbox" name="del_file[]" value="0"> 삭제</div>
                    <div class="clear"></div>
                    <?
                  }
                  ?>
                  <div class="write_line"></div>
                  <div id="write_row5"><div class="col1"> 이미지 파일2</div>
                  <div class="col2"><input type="file" name="upfile[]"></div>
                </div>
                <?
                if($mode=="modify" && $item_file_1)
                {
                  ?>
                  <div class="delete_ok"><?=$item_file_1?> 파일이 등록되어 있습니다.
                    <input type="checkbox" name="del_file[]" value="1"> 삭제</div>
                    <div class="clear"></div>
                    <?
                }
                ?>
                <div class="write_line"></div>
                <div class="clear"></div>
                <div id="write_row6"><div class="col1"> 이미지파일3 </div>
                <div class="col2"><input type="file" name="upfile[]"></div>
                </div>

                <?
                if($mode=="modify" && $item_file_2)
                {
                  ?>
                  <div class="delete_ok"><?=$item_file_2?> 파일이 등록되어 있습니다.
                    <input type="checkbox" name="del_file[]" value="2"> 삭제</div>
                    <div class="clear"></div>
                    <?
                }

                 ?>
                 <div class="write_line"></div>
                 <div class="clear"></div>
                  </div>
                  <div id="write_button"><a href="#">
                  <img src="../img/ok.png" onclick="check_input()"></a>&nbsp;
                  <a href="list.php?table=<?=$table?>&page=<?=$page?>"> <img src="../img/list.png">
                  </a>
                </div>
                 </form>

               </div>
             </div>
           </div>
   </body>
 </html>
