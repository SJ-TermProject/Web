<?
  session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta charset="utf-8">
    <script>
      function check_id() {
        window.open("check_id.php?id=" + document.member_form.id.value, "IDcheck", "left=200, top=200, width=250, height=100, scrollbars=n0, resizable=yes");
      }

      function check_input() {
        if(!document.member_form.pw.value) {
          alert("비밀번호를 입력하세요");
          document.member_form.pw.focus();
          return;
        }

        if(!document.member_form.pw_confirm.value) {
          alert("비밀번호 확인을 입력하세요");
          document.member_form.pw_confirm.focus();
          return;
        }

        if(!document.member_form.name.value) {
          alert("이름을 입력하세요");
          document.member_form.name.focus();
          return;
        }

        if (!document.member_form.hp2.value || !document.member_form.hp3.value ) {
            alert("휴대폰 번호를 입력하세요");
            document.member_form.id.focus();
            return;
        }

        if (document.member_form.pw.value !=  document.member_form.pw_confirm.value) {
            alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
            document.member_form.pass.focus();
            document.member_form.pass.select();
            return;
        }

        document.member_form.submit();
      }

      function reset_form() {
         document.member_form.id.value = "";
         document.member_form.pw.value = "";
         document.member_form.pw_confirm.value = "";
         document.member_form.name.value = "";
         document.member_form.hp1.value = "010";
         document.member_form.hp2.value = "";
         document.member_form.hp3.value = "";
         document.member_form.email1.value = "";
         document.member_form.email2.value = "";
         document.member_form.birth_day.value = "";

         document.member_form.id.focus();

         return;
      }
    </script>
  </head>
  <?
    include "../lib/dbconn.php";

    $sql = "select * from member where id='$userid'";
    $result = mysql_query($sql, $connect);
    $row = mysql_fetch_array($result);

    $hp = explode("-", $row[hp]);
    $hp1 = $hp[0];
    $hp2 = $hp[1];
    $hp3 = $hp[2];

    $email = explode("@", $row[email]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysql_close();
  ?>
  <body>
    <div id="header">
      <? include "../top_header.php"; ?>
    </div>
    <div id="menu">
      <? include "main_menu.php"; ?>
    </div>
    <div id="col2">
      <form name="member_form" method="post" action="modify.php">
      <div id="title"> <h1>회원정보수정</h1> </div>
      <div id="join1">
			  <ul>
			    <li>* 아이디(학번)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $row[id] ?></li>
			    <li>* 비밀번호&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="password" name="pw" value="<?= $row[pw] ?>">&nbsp;</li>
			    <li>* 비밀번호 확인&nbsp;&nbsp;&nbsp; <input type="password" name="pw_confirm" value="<?= $row[pw] ?>"></li>
			    <li>* 이름&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="name" value="<?= $row[name] ?>"></li>
			    <li>* 휴대폰&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" class="hp" name="hp1" value="<?= $hp1 ?>"> - <input type="text" class="hp" name="hp2" value="<?= $hp2 ?>"> - <input type="text" class="hp" name="hp3" value="<?= $hp3 ?>">
          </li>
			    <li>&nbsp;&nbsp;&nbsp;이메일&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" id="email" name="email1" value="<?= $email1 ?>"> @ <input type="text" id="email" name="email2" value="<?= $email2 ?>">
          </li>
          <li>&nbsp;&nbsp;&nbsp;생일&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" id="birth_day" name="day" value=" value="<?= $row[birth_day] ?>""></li>
			  </ul>
			</div>
			<div class="clear"></div>
			<div id="must"> * 는 필수 입력항목입니다.^^</div>

      <a href="#" onclick="check_input()"> 저장 </a>
      <a href="#" onclick="check_input()"> 취소 </a>
		  </form>
    </div>
  </body>
</html>
