<?php
    header("Content-Type: text/html; charset: utf-8");
?>
<div class="loginform">
<h3>登入</h3>
<form action="?action=login" method="post" id='login'>
<label for="account">帳號:<br></label><input type="text" name="account" id="account" required><br>
(只能輸入英文大小寫和底線)<br><br>
<label for="password">密碼:<br></label><input type="password" name="password" id="password" required><br>
(只能輸入英文大小寫和底線)<br><br>
<input type="submit" id = "loginbutton" value="登入" name = "submit">
</form><br>
  <a id="register">還沒有帳號嗎?點此註冊</a>
</div>