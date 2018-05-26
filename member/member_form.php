<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="euc-kr">
<script>
   function check_id()
   {
     window.open("check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=200,top=200,width=200,height=60,scrollbars=no,resizable=yes");
   }

   function check_input()
   {
      if (!document.member_form.id.value)
      {
          alert("아이디(학번)를 입력하세요");
          document.member_form.id.focus();
          return;
      }

      if (!document.member_form.pw.value)
      {
          alert("비밀번호를 입력하세요");
          document.member_form.pw.focus();
          return;
      }

      if (!document.member_form.pw_confirm.value)
      {
          alert("비밀번호 확인을 입력하세요");
          document.member_form.pw_confirm.focus();
          return;
      }

      if (!document.member_form.name.value)
      {
          alert("이름을 입력하세요");
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.hp2.value || !document.member_form.hp3.value )
      {
          alert("휴대폰 번호를 입력하세요");
          document.member_form.id.focus();
          return;
      }

      if (document.member_form.pw.value !=
            document.member_form.pw_confirm.value)
      {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      document.member_form.submit();
   }

   function reset_form()
   {
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
	<div id="header">
  	<? include "../top_header.php"; ?>
	</div>  <!--end of header-->
	<div id="menu">
  	<? include "main_menu.php"; ?>
	</div>

	<div id="col2">
        <form  name="member_form" method="post" action="insert.php">
		<div id="title">
			<h1>회원가입</h1>
		</div>

		<div id="form_join">
			<div id="join1">
			<ul>
			<li>* 아이디(학번)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="id">
        <a href="#" onclick="check_id()">&nbsp; 중복확인 </a>
      </li>
			<li>* 비밀번호&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="password" name="pw">&nbsp; 4~12자의 영문 소문자, 숫자와 특수기호(_)만 사용할 수 있습니다.</li>
			<li>* 비밀번호 확인&nbsp;&nbsp;&nbsp; <input type="password" name="pw_confirm"></li>
			<li>* 이름&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="name"></li>
			<li>* 휴대폰&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <select class="hp" name="hp1">
              <option value='010'>010</option>
              <option value='011'>011</option>
              <option value='016'>016</option>
              <option value='017'>017</option>
              <option value='018'>018</option>
              <option value='019'>019</option>
              </select>  - <input type="text" class="hp" name="hp2"> - <input type="text" class="hp" name="hp3"></li>
			<li>&nbsp;&nbsp;&nbsp;이메일&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" id="email" name="email1"> @ <input type="text" id="email" name="email2"></li>
      <li>&nbsp;&nbsp;&nbsp;생일&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" id="birth_day"></li>
			</ul>
			</div>
			<div class="clear"></div>
			<div id="must"> * 는 필수 입력항목입니다.^^</div>
		</div>

		<div id="button"><a href="#" onclick="check_input()">저장하기</a>&nbsp;&nbsp;
		                 <a href="#" onclick="reset_form()">취소하기</a>
		</div>
	    </form>
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
