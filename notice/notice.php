<?php
  session_start();
 ?>
<div id="header">
  <? include "../top_header.php";?>
</div>

<div id="menu">
  <? include "main_menu.php";?>
</div>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="../css/common.css" media="all">
     <link rel="stylesheet" type="text/css" href="../css/concert.css" media="all">
     <title></title>
   </head>
   <?
    include "../lib/dbconn.php";

    $scale = 10;

    if($mode=="search")
    {
      if(!$search){
        echo("
        <script>
          window.alert('검색할 단어를 입력해 주세요!');
          history.go(-1);
          </script>
        ");
        exit;
      }
      $sql="select * from greet where $find like '%search%' order by num desc";
    }
    else
    {
      $sql="select * from greet order by num desc";
    }

    $result = mysql_query($sql, $connect);

    $total_record=mysql_num_rows($result); //화면에 표시하는 전체 글의 개수

    if($total_record % $scale == 0)
      $total_page = floor($total_record/$scale);
    else
      $total_page=floor($total_record/$scale) + 1;

    if(!$page)
      $page = 1;

    //표시할 페이지($page)에 따라 $start 계산
    $start = ($page - 1) * $scale;

    $number = $total_record - $start;
    ?>
   <body>
     <div id="wrap">
       <div id="content">
         <div id="col2">
           <div id="title">
             <!-- <img src="../img/title_greet.gif">--> <p>가입인사</p>
           </div>

           <form name="board_form" action="list.php?mode=search" method="post">
             <div id="list_search">
               <div id="list_search1">총 <?= $total_record ?> 개의 게시물이 있습니다.
               </div>
               <div id="list_search2"> <!-- <img src="../img/select_search.gif"> --> <p>selelct</p>
               </div>
               <div id="list_search3">
                 <select name="find">
                   <option value="subject">제목</option>
                   <option value="subject">내용</option>
                   <option value="subject">이름</option>
                 </select>
               </div>
               <div id="list_search4"><input type="text" name="search">
               </div>
               <div class="list_search5"><!-- <input type="image" src="../img/list_search_button.gif"> --><a href="#">검색</a>
               </div>
             </div>
           </form>

           <div class="clear">
           </div>
           <div id="list_top_title">
             <ul>
               <li id="list_title1"> <!-- <img src="../img/list_title1.gif"> --> <p>번호</p> </li>
               <li id="list_title2"> <!--<img src="../img/list_title2.gif">--> <p>제목</p></li>
               <li id="list_title3"> <!--<img src="../img/list_title3.gif">--> <p>글쓴이</p></li>
               <li id="list_title4"> <!--<img src="../img/list_title4.gif">--> <p>등록일</p></li>
               <li id="list_title5"> <!--<img src="../img/list_title5.gif">--> <p>조회수</p></li>
             </ul>
           </div>

           <div id="list_content">
             <?php
              for($i=start; $i < $start+$scale && $i<$total_record; $i++){
                mysql_data_seek($result, $i);

                $row=mysql_feth_array($result);

                $item_num=$row[num];
                $item_id=$row[id];
                $item_name=$row[name];
                $item_hit=$row[hit];
                $item_date=$row[regist_day];
                $item_date=substr($item_date, 0, 10);
                $item_subject = str_replace(" ","&nbsp;", $row[subject]);
                ?>

                <div id="list_item">
                  <div id="list_item1"><?=$number ?></div>
                  <div id="list_item2"><a href="view.php?num=<?$item_num?> &page=<?=$page?>"><?=item_subject ?></a></div>
                  <div id="list_item3"><?=$item_date?></div>
                  <div id="list_item4"><?=$item_hit?></div>
                </div>

                  <?php
                  $number--;
                }
                  ?>
                  <div id="page_button">
                    <div id="page_num"> 이전 &nbsp;&nbsp;&nbsp;&nbsp;
                      <?
                        for($i=1;$i <=$total_page;$i++){
                          if($page==$i){
                            echo "<b> $i </b>";
                          }
                          else{
                            echo "<a href='list.php?page=$i'>$i </a>";
                          }
                        }
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;다음
                      </div>
                      <div id="button">
                        <a href="list.php?page=<?=$page?>">목록</a>&nbsp;
                        <?php
                        if($userid)
                        {
                          ?>
                          <a href="write_form.php">글쓰기</a>
                          <?php
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