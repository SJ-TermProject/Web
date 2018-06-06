<?
session_start();
extract($_POST);
   extract($_GET);
   extract($_SESSION);
$table="greet";

if(!$userid) {
  echo("
    <script>
      window.alert('로그인 후 이용하세요.')
       location.replace('../login/login_form.php');
    </script>
  ");
  exit;
}

include "../lib/dbconn.php";

$sql="select * from $table where num=$num";

$result=mysql_query($sql, $connect);

$row=mysql_fetch_array($result);

$item_num = $row['num'];
$item_id = $row['id'];
$item_name = $row['name'];
$item_hit = $row['hit'];
$item_date = $row['regist_day'];
$item_subject = str_replace(" ","&nbsp;",$row['subject']);
$item_content = $row['content'];
$is_html = $row['is_html'];

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
     <link rel="stylesheet" type="text/css" href="../css/concert.css?ver=1" media="all">
     <title></title>
     <style>
     #view_title {
       height: 45px;
     }
     #view_title #view_title1 {
       padding-left: 70px;
       width: 500px;
     }
     #view_title #view_title2 {
       text-align: center;
       width: 270px;
     }
     </style>
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
               <h5>공지사항</h5>
             </div>

             <div id="view_title">
               <div id="view_title1"><?=$item_subject ?></div>
               <div id="view_title2" style="margin-left: 350px;"><?=$item_name ?> | 조회 : <?=$item_hit ?> | <?=$item_date ?>
               </div>
             </div>
             <div id="view_content"><?=$item_content ?></div>
             <div id="view_button">
               <a class="btn btn-outline-secondary" href="list.php?" role="button">목록</a>&nbsp;
                <?
                if(isset($userid)){
                if($userid==$item_id || $userid=="admin" || $userlevel==0){
                  ?>
                  <a class="btn btn-outline-secondary" href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>" role="button">수정</a>&nbsp;
                  <a class="btn btn-outline-secondary" href="javascript:del('delete.php?num=<?=$num?>')" role="button">삭제</a>&nbsp;
                  <?
                }
              }
                ?>
                <?
                if(isset($userid)){
                  ?>
                    <a class="btn btn-outline-dark" href="write_form.php" role="button">글쓰기</a>&nbsp;
                  <?
                }

                 ?>
             </div>
             <div class="clear"></div>
           </div>

         </div>

       </div>
       <?
       include '../footer.php';
       ?>
   </body>
 </html>
