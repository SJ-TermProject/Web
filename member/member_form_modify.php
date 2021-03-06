<?
  session_start();

  $userid = $_SESSION['userid'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="../css/member.css" media="all">
    <style>

    td{
      padding: 10px;
      border: 1px solid #848484;
    }

    </style>
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
            document.member_form.hp.focus();
            return;
        }

        if (document.member_form.pw.value !=  document.member_form.pw_confirm.value) {
            alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
            document.member_form.pw.focus();
            document.member_form.pw.select();
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

    $hp = explode("-", $row['hp']);
    $hp1 = $hp[0];
    $hp2 = $hp[1];
    $hp3 = $hp[2];

    $email = explode("@", $row['email']);
    $email1 = $email[0];
    $email2 = $email[1];

    mysql_close();
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
      <form name="member_form" method="post" action="modify.php">
      <div id="title">
        <img src="../img/title_member_modify.gif">
      </div>

      <table id="form_join">

        <tr>
          <td bgcolor="lightgray">* 아이디(학번)</td>
          <td><?= $row['id'] ?></td>
        </tr>
        <tr>
          <td bgcolor="lightgray">* 비밀번호</td>
          <td><input type="password" name="pw" value="<?= $row['pw'] ?>">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="lightgray">* 비밀번호 확인</td>
          <td><input type="password" name="pw_confirm" value="<?= $row['pw'] ?>"></td>
        </tr>
        <tr>
          <td bgcolor="lightgray">* 이름</td>
          <td><input type="text" name="name" value="<?= $row['name'] ?>"></td>
        </tr>
        <tr>
          <td bgcolor="lightgray">* 휴대폰</td>
          <td>
            <input type="text" class="hp" name="hp1" value="<?= $hp1 ?>"> - <input type="text" class="hp" name="hp2" value="<?= $hp2 ?>"> - <input type="text" class="hp" name="hp3" value="<?= $hp3 ?>">
          </td>
        </tr>
        <tr>
          <td bgcolor="lightgray">&nbsp;&nbsp;&nbsp;이메일</td>
          <td><input type="text" id="email" name="email1" value="<?= $email1 ?>"> @ <input type="text" id="email" name="email2" value="<?= $email2 ?>"></td>
        </tr>
        <tr>
          <td bgcolor="lightgray">&nbsp;&nbsp;&nbsp;생일</td>
          <td><input type="text" id="birth_day" name="birth_day" value="<?=$row['birth_day'] ?>" placeholder="ex)19971118"></td>
        </tr>
        <tr>
          <td bgcolor="lightgray"id="must">
            <h6>* 는 필수 입력항목입니다.^^</h6>
          </td>
          <td>
            <div id="button"><a href="#"><img src="../img/button_save.gif" onclick="check_input()"></a>&nbsp;&nbsp;
                             <a href="#"><img src="../img/button_reset.gif" onclick="reset_form()"></a>
            </div>
          </td>
        </tr>

      </table>
      <!--
      <div id="form_join">
      <div id="join1">
			  <ul>
			    <li>* 아이디(학번)</li>
			    <li>* 비밀번호</li>
			    <li>* 비밀번호 확인</li>
			    <li>* 이름</li>
			    <li>* 휴대폰</li>
			    <li>&nbsp;&nbsp;&nbsp;이메일</li>
          <li>&nbsp;&nbsp;&nbsp;생일</li>
			  </ul>
			</div>
      <div id="join2">
        <ul>
			    <li><?//= $row['id'] ?></li>
			    <li><input type="password" name="pw" value="<?//= $row['pw'] ?>">&nbsp;</li>
			    <li><input type="password" name="pw_confirm" value="<?//= $row['pw'] ?>"></li>
			    <li><input type="text" name="name" value="<?//= $row['name'] ?>"></li>
			    <li>
            <input type="text" class="hp" name="hp1" value="<?//= $hp1 ?>"> - <input type="text" class="hp" name="hp2" value="<?//= $hp2 ?>"> - <input type="text" class="hp" name="hp3" value="<?//= $hp3 ?>">
          </li>
			    <li>
            <input type="text" id="email" name="email1" value="<?//= $email1 ?>"> @ <input type="text" id="email" name="email2" value="<?//= $email2 ?>">
          </li>
          <li>
            <input type="text" id="birth_day" name="birth_day" value="<?//= $row['birth_day'] ?>"></li>
			  </ul>
      </div>
			<div class="clear"></div>
			<div id="must"> * 는 필수 입력항목입니다.^^</div>
    </div>

    <div id="button"><a href="#"><img src="../img/button_save.gif" onclick="check_input()"></a>&nbsp;&nbsp;
                     <a href="#"><img src="../img/button_reset.gif" onclick="reset_form()"></a></div>
</div> -->
      </form>
    </div>
  </div>
    </div>
  </body>
</html>
