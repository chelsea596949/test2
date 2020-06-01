<h3>歡迎管理員 <?php echo $_SESSION['name']; ?></h3>
  <a href = "?action=logout">點此登出</a>
  <form id="give_everybody_prop" method="post">
    <input type = "submit" name = "submit" value = "發放道具給所有玩家">
    <input type='hidden' name='CSRFName' id="CSRFName" value='<?php echo $csrf[0]; ?>'>
    <input type='hidden' name='CSRFToken' id="CSRFToken" value='<?php echo $csrf[1]; ?>'>
  </form><hr>
  <form action="?action=givesbprops" id="give_sb_prop" method="post">
    <input type='hidden' name='CSRFName' value='<?php echo $csrf1[0]; ?>'>
  <input type='hidden' name='CSRFToken' value='<?php echo $csrf1[1]; ?>'>
  <label for="member">選擇玩家:</label>
    <select name="member" id="member">