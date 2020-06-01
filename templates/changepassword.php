<form id="change_password" action="?action=changepassword" method="post">
<h3 id="h3_change">修改密碼</h3>
  <input type='hidden' name='CSRFName' value='<?php echo $csrf[0]; ?>'>
  <input type='hidden' name='CSRFToken' value='<?php echo $csrf[1]; ?>'>
    密碼:<br><input type="password" name="password" required><br>(只能輸入英文大小寫和底線)<br><br>
    <input type="submit" value="修改" name = "submit">
  <form><br>