<?
  session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/member.css" rel="stylesheet" type="text/css" media="all">
<style>

td{
  padding-left: 10px;
  border: 1px solid #848484;
}

</style>
<script>
   function check_id() {
     window.open("check_id.php?id=" + document.member_form.id.value, "IDcheck", "left=200,top=200,width=200,height=60,scrollbars=no,resizable=yes");
   }

   function check_input() {
      if (!document.member_form.id.value) {
          alert("아이디(학번)를 입력하세요");
          document.member_form.id.focus();
          return;
      }

      if (!document.member_form.pw.value) {
          alert("비밀번호를 입력하세요");
          document.member_form.pw.focus();
          return;
      }

      if (!document.member_form.pw_confirm.value) {
          alert("비밀번호 확인을 입력하세요");
          document.member_form.pw_confirm.focus();
          return;
      }

      if (!document.member_form.name.value) {
          alert("이름을 입력하세요");
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.hp2.value || !document.member_form.hp3.value ) {
          alert("휴대폰 번호를 입력하세요");
          document.member_form.hp.focus();
          return;
      }

      if (document.member_form.pw.value != document.member_form.pw_confirm.value) {
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
    <form  name="member_form" method="post" action="insert.php">
		<div id="title">
			<img src="../img/title_join.gif">
		</div>

    <table id="form_join">

      <tr>
        <td bgcolor="lightgray">* 아이디(학번)</td>
        <td><input type="text" name="id"><a href="#">&nbsp;&nbsp;<img src="../img/check_id.gif" onclick="check_id()"></a>&nbsp;&nbsp;&nbsp;8~10자의 숫자만 사용할 수 있습니다.</td>
      </tr>
      <tr>
        <td bgcolor="lightgray">* 비밀번호</td>
        <td><input type="password" name="pw"></td>
      </tr>
      <tr>
        <td bgcolor="lightgray">* 비밀번호 확인</td>
        <td><input type="password" name="pw_confirm"></td>
      </tr>
      <tr>
        <td bgcolor="lightgray">* 이름</td>
        <td><input type="text" name="name"></td>
      </tr>
      <tr>
        <td bgcolor="lightgray">* 휴대폰</td>
        <td><select class="hp" name="hp1">
          <option value='010'>010</option>
          <option value='011'>011</option>
          <option value='016'>016</option>
          <option value='017'>017</option>
          <option value='018'>018</option>
          <option value='019'>019</option>
          </select>  - <input type="text" class="hp" name="hp2"> - <input type="text" class="hp" name="hp3"></td>
      </tr>
      <tr>
        <td bgcolor="lightgray">&nbsp;&nbsp;&nbsp;이메일</td>
        <td><input type="text" id="email1" name="email1"> @ <input type="text" name="email2"></td>
      </tr>
      <tr>
        <td bgcolor="lightgray">&nbsp;&nbsp;&nbsp;생일</td>
        <td><input type="text" id="birth_day" value="ex.911102"></td>
      </tr>

        <td id="must">
          * 는 필수 입력항목입니다.^^
        </td>
        <td>
          <div id="button" style="border-right: none;"><a href="#"><img src="../img/button_save.gif" onclick="check_input()"></a>&nbsp;&nbsp;
      		                 <a href="#"><img src="../img/button_reset.gif" onclick="reset_form()"></a>
          </div>
        </td>


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
          <li><div id="id1"><input type="text" name="id"></div>
          <div id="id2"><a href="#"><img src="../img/check_id.gif" onclick="check_id()"></a></div>
          <div id="id3">8~10자의 숫자만 사용할 수 있습니다.</div></li>
          <li><input type="password" name="pw"></li>
          <li><input type="password" name="pw_confirm"></li>
          <li><input type="text" name="name"></li>
          <li><select class="hp" name="hp1">
            <option value='010'>010</option>
            <option value='011'>011</option>
            <option value='016'>016</option>
            <option value='017'>017</option>
            <option value='018'>018</option>
            <option value='019'>019</option>
            </select>  - <input type="text" class="hp" name="hp2"> - <input type="text" class="hp" name="hp3"></li>
          <li><input type="text" id="email1" name="email1"> @ <input type="text" name="email2"></li>
          <li><input type="text" id="birth_day" value="ex.911102"></li>
        </ul>
      </div>
			<div class="clear"></div>
			<div id="must"> * 는 필수 입력항목입니다.^^</div>
		</div>

		<div id="button"><a href="#"><img src="../img/button_save.gif" onclick="check_input()"></a>&nbsp;&nbsp;
		                 <a href="#"><img src="../img/button_reset.gif" onclick="reset_form()"></a></div> -->
	    </form>
	</div> <!-- end of col2 -->
</div>
</div> <!-- end of wrap -->

</body>
</html>
