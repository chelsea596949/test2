<?php
    // 將姓名填充到陣列中
    $a[]="Anna";
    $a[]="Brittany";
    $a[]="Cinderella";
    $a[]="Diana";
    $a[]="Eva";
    $a[]="Fiona";
    $a[]="Gunda";
    $a[]="Hege";
    $a[]="Inga";
    $a[]="Johanna";
    $a[]="Kitty";
    $a[]="Linda";
    $a[]="Nina";
    $a[]="Ophelia";
    $a[]="Petunia";
    $a[]="Amanda";
    $a[]="Raquel";
    $a[]="Cindy";
    $a[]="Doris";
    $a[]="Eve";
    $a[]="Evita";
    $a[]="Sunniva";
    $a[]="Tove";
    $a[]="Unni";
    $a[]="Violet";
    $a[]="Liza";
    $a[]="Elizabeth";
    $a[]="Ellen";
    $a[]="Wenche";
    $a[]="Vicky";

    //從請求URL地址中取得 q 引數
    $q=$_GET["q"];

    //搜尋是否有匹配值， 如果 q>0(字串長度大於0)
    if (strlen($q) > 0)
    {
        $hint="";
        for($i=0; $i<count($a); $i++)
        {
            //strlower():把字串轉成全部小寫
            //substr():第一個變數:要找的字串,第2個變數:要找字串裡的第幾個字,第3個變數:取得的字串長度(預設0)
            if (strtolower($q)==strtolower(substr($a[$i],0,strlen($q))))
            {
                if ($hint=="")
                {
                    $hint=$a[$i];
                }
                else
                {
                    $hint=$hint." , ".$a[$i];
                }
            }
        }
    }

    // 如果沒有匹配值設定輸出為 "no suggestion" 
    if ($hint == "")
    {
        $response="no suggestion";
    }
    else
    {
        $response=$hint;
    }

    //輸出回傳值
    echo $response;
?>