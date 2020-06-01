<form id="change_name" action="?action=changename" method="post">
<h3 id="h3_change_name">修改名稱</h3>
  <input type='hidden' name='CSRFName' value='<?php echo $csrf[0]; ?>'>
    <input type='hidden' name='CSRFToken' value='<?php echo $csrf[1]; ?>'>
    <label for="name">名稱:</label><br><input type="text" name="name" value="<?php echo $_SESSION['name'];?>" required><br><br>
    <input type="submit" value="修改" name = "submit">
  <form><br>