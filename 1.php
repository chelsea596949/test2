<html>
<head>
<script>
function showHint(str)
{
    //str.length:輸入的字串長度
    if (str.length==0)
    { 
        //如果id為txtHint的輸入框沒有字的話，傳回的html設定為空
        document.getElementById("txtHint").innerHTML="";
        return;
    }
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 瀏覽器執行的程式碼
        xmlhttp=new XMLHttpRequest();
    }
    else
    {    
        //IE6, IE5 瀏覽器執行的程式碼
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    //整個頁面都load好了
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            //收到gethint.php傳來的response，塞入id為txtHint的地方
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
        }
    }
    //找gethint.php裡get的變數q,並定義其value為str
    xmlhttp.open("GET","gethint.php?q="+str,true);
    //傳送
    xmlhttp.send();
}
</script>
</head>
<body>

<p><b>在輸入框中輸入一個姓名:</b></p>
<form> 
    <!--onkeyup:在使用者釋放按鍵後執行後面的function-->
姓名: <input type="text" onkeyup="showHint(this.value)">
</form>
<p>回傳值: <span id="txtHint"></span></p>

</body>
</html>