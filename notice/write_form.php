<?
  session_start();
  extract($_POST);
     extract($_GET);
     extract($_SESSION);

     $id = $_POST['id'];
     $pw = $_POST['pw'];
?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="../css/common.css" media="all">
     <link rel="stylesheet" type="text/css" href="../css/greet.css" media="all">
     <title></title>
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
       width: 300px;
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
       width: 637px;
     }
     #write_form #write_row3 {
       height: 375px;
     }
     #write_form #write_row3 div.col1 {
       padding: 1px;
       height: 375px;
     }
     #write_button {
       margin: 0px;
       padding-top: 5px;
       height: 40px;
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
             <img src="../img/title_greet.gif">
           </div>
           <div class="clear"></div>

           <div id="write_form_title">
             <img src="../img/write_form_title.gif">
           </div>
           <div class="clear"></div>

          <form name="board_form" action="insert.php" method="post">
            <div id="write_form">
               <div class="write_line"></div>
               <div id="write_row1">
                 <div class="col1">이름 </div>
                 <div class="col2"><?=$username?></div>
                 <div class="col3"><input type="checkbox" name="html_ok" value="y">HTML 쓰기</div>
               </div>
                   <div class="write_line"></div>
                   <div id="write_row2"><div class="col1">제목</div>
                   <div class="col2"><input type="text" name="subject"></div>
                 </div>
                 <div class="write_line"></div>
                 <div id="write_row3"><div class="col1"><br><br><br><br><br><br><br>내용</div>
                 <div class="col2"><textarea name="content" rows="15" cols="88"></textarea></div>
                 </div>
                 <div class="write_line"></div>

               </div><div id="write_button"><a href="#">
                 <img src="../img/ok.png"></a>&nbsp;
                    <a href="list.php?page=<?=$page?>"> <img src="../img/list.png"></a></div>
                 </form>

               </div>
             </div>
           </div>
   </body>
 </html>
