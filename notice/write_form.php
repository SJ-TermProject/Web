<?
  session_start();
  extract($_POST);
     extract($_GET);
     extract($_SESSION);

     include "../lib/dbconn.php";

     if(isset($mode)){
     if($mode=="modify")
     {
       $sql="select * from $table where num=$num";
       $result = mysql_query($sql, $connect);
       $row = mysql_fetch_array($result);

       $item_subject = $row['subject'];
       $item_content = $row['content'];

     }
   }

?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="../css/common.css" media="all">
     <link rel="stylesheet" type="text/css" href="../css/concert.css?ver=1" media="all">
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
     <style>
     #write_form_title {
       height: 40px;
     }
     #write_form #write_row1 {
       height: 34px;
     }
     #write_form #write_row1 div.col2 {
       margin-top: 5px;
       margin-left: 10px;
       height: 33px;
       width: 560px;
     }
     #write_form #write_row2 {
       height: 34px;
     }
     #write_form #write_row2 div.col2 {
       margin-left: 10px;
       height: 34px;
     }
     #write_form #write_row2 div.col2 input{
       height: 34px;
     }
     #write_form #write_row3 {
       height: 375px;
     }
     #write_form #write_row3 div.col1 {
       padding: 1px;
       height: 375px;
     }
     #write_form #write_row4 {
       height: 34px;
     }
     #write_form #write_row4 div.col2 {
       height: 34px;
     }
     #write_form #write_row4 div.col2 input{
       width: 647px;
       height: 30px;
     }
     #write_form #write_row5 {
       height: 34px;
     }
     #write_form #write_row5 div.col2 {
       height: 34px;
     }
     #write_form #write_row5 div.col2 input{
       width: 647px;
       height: 30px;
     }
     #write_form #write_row6 {
       height: 34px;
     }
     #write_form #write_row6 div.col2 {
       height: 34px;
     }
     #write_form #write_row6 div.col2 input{
       width: 647px;
       height: 30px;
     }
     </style>
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
             <h5>공지사항</h5>
           </div>
           <div class="clear"></div>

           <div id="write_form_title">
             <p>글쓰기</p>
           </div>
           <div class="clear"></div>
           <?
           if(isset($mode)){
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
               }else {
                 ?>

          <form name="board_form" action="insert.php?table=<?=$table?>" method="post" enctype="multipart/form-data">
            <?}?>
            <div id="write_form">
               <div class="write_line"></div>
               <div id="write_row1">
                 <div class="col1">이름 </div>
                 <div class="col2"><?=$username?></div>

               </div>
                   <div class="write_line"></div>
                   <div id="write_row2"><div class="col1">제목</div>
                   <div class="col2"><input type="text" name="subject" value="<?if(isset($mode)){if($mode=="modify"){echo $item_subject;}}?>" style="height:30px; width:1050px;"></div>
                 </div>
                 <div class="write_line"></div>
                 <div id="write_row3"><div class="col1"><br><br><br><br><br><br><br>내용</div>
                 <div class="col2"><textarea name="content" rows="15" cols="138"><?if(isset($mode)){if($mode=="modify"){echo $item_content;}}?></textarea></div>
                 </div>
                 <div class="write_line"></div>

               </div><div id="write_button"><a href="#">
                 <a class="btn btn-outline-dark" href="#" onclick="check_input()" role="button">완료</a>
                  <a class="btn btn-outline-secondary" href="list.php" role="button">목록</a></div>
                </a>


               </div>
               </form>
             </div>
           </div>
           <br>
           <br>

           <?
           include '../footer.php';
           ?>
   </body>
 </html>
