<form action="?action=register" method="post" id="registerform">
<h3>註冊</h3>
    <p>※帳號、密碼、名稱皆不能為空值</p>
    <label for="account">帳號:</label><br><input type="text" name="account" required><br>(只能輸入英文大小寫和底線)<br><br>
    <label for="password">密碼:</label><br><input type="password" name="password" required><br>(只能輸入英文大小寫和底線)<br><br>
    <label for="name">名稱:</label><br><input type="text" name="name" required><br><br>
    <label for="career">職業:</label><br>
    <select name="career">
      <option value="日本武士">日本武士</option>
      <option value="黑手黨">黑手黨</option>
      <option value="鬼">鬼</option>
      <option value="格鬥家">格鬥家</option>
      <option value="雙刀流">雙刀流</option>
    </select><br><br>
    <input type='hidden' name='CSRFName' value='<?php echo $csrf[0]; ?>'>
    <input type='hidden' name='CSRFToken' value='<?php echo $csrf[1]; ?>'>
    <input type="submit" value="註冊" name = "submit">
  <form><br>