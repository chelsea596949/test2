<h3>歡迎 <?php echo $_SESSION['name']; ?></h3>
  <a href = "?action=logout">點此登出</a>
  <form action = "?page=changepassword" method="post" class='nocsrf'>
    <input type = "submit" name = "submit" value = "修改密碼">
  </form><form action = "?page=changename" method="post" class='nocsrf'>
    <input type = "submit" name = "submit" value = "修改名稱">
  </form>
  <a href = "?page=monster" id="monster">開始打怪</a>