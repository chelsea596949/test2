<?php
    //如果有get到q,就強制轉型成整數，否則設定為空字串
    $q = isset($_GET["q"]) ? intval($_GET["q"]) : '';
    
    if(empty($q)) {
        echo '請選擇一個網站';
        exit;
    }
    
    $con = mysqli_connect('localhost','test','mfGD6s18TzL36Job');
    if (!$con)
    {
        die('Could not connect: ' . mysqli_error($con));
    }
    // 選擇資料庫
    mysqli_select_db($con,"test");
    // 設定編碼，防止中文亂碼
    mysqli_set_charset($con, "utf8");
    
    $sql="SELECT * FROM Websites WHERE id = '".$q."'";
    
    $result = mysqli_query($con,$sql);
    
    echo "<table border='1'>
    <tr>
    <th>ID</th>
    <th>網站名</th>
    <th>網站 URL</th>
    <th>Alexa 排名</th>
    <th>國家</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['url'] . "</td>";
        echo "<td>" . $row['alexa'] . "</td>";
        echo "<td>" . $row['country'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    mysqli_close($con);
?>