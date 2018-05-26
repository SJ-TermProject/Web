<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div id="header">
    	<? include "../top_header.php"; ?>
  	</div>
  	<div id="menu">
    	<? include "main_menu.php"; ?>
  	</div>
    <div id="col2">
      <form name="member_form" method="post" action="login.php">
        <div id="title"> <h1>로그인</h1> </div>
        <div id="login_form"> <h2>회원님의 아이디와 비밀번호를 입력해주세요.</h2><div class="clear"></div>
          <div id="login">
            <div id=id_pw_input>
              <ul>
                <li>아이디&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="id" class="login_input"></li>
                <li>비밀번호&nbsp;&nbsp; <input type="password" name="pw" class="login_input"></li>
              </ul>
              <button>로그인</button>
            </div>
            <div class="clear"></div>
            <div id="login_line"></div>
            <div id="join_button">아직 회원이 아니십니까? <a href="../member/member_form.php">회원가입</a></div>
        </div>
      </div>
    </form>
    </div>
  </body>
</html>
