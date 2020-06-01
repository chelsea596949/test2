<?php
    function ShowPage($page) {
        require_once "templates/".$page.".php";
    }
    #產生token
    function csrfguard_generate_token($unique_form_name) {
        if (function_exists("hash_algos") && in_array("sha512", hash_algos())){
            $token = hash("sha512", mt_rand(0, mt_getrandmax()));
        }else {
            $token = '';
            for ($i = 0;$i < 128;++$i) {
                $r = mt_rand(0,35);
                if($r < 26) {
                    $c = chr(ord('a')+$r);
                }else {
                    $c = chr(ord('0')+$r-26);
                }
                $token.=$c;
            }
        }
        #存入session
        store_in_session($unique_form_name, $token);
        return $token;
    }
    #驗證token
    function csrfguard_validate_token($unique_form_name, $token_value) {
        #從session中取得token
        $token = get_from_session($unique_form_name);
        #比對post的token是否跟session中的token一樣
        if ($token == false) {
            return false;
        }else if ($token == $token_value) {
            $result = true;
        }else {
            $result = false;
        }
        #清掉session中的token
        unset_session($unique_form_name);
        return $result;
    }
    function csrfguard_replace_forms() {
        $name = "CSRFGuard_".mt_rand(0,mt_getrandmax());
        $token = csrfguard_generate_token($name);
        $csrf = array($name, $token);
        return $csrf;
    }
    #比對csrfname跟csrftoken
    function csrfguard_start() {
        if ( !isset($_POST['CSRFName']) || !isset($_POST['CSRFToken']) ) {
            trigger_error("No CSRFName found, probable invalid request.",E_USER_ERROR);
        }
        $name = $_POST['CSRFName'];
        $token = $_POST['CSRFToken'];
        if (csrfguard_validate_token($name, $token) == false) {
            trigger_error("Invalid CSRF token.", E_USER_ERROR);
        }
    }
    function store_in_session($key, $value) {
        if (isset($_SESSION)) {
            $_SESSION[$key] = $value;
        }
    }
    function unset_session($key) {
        $SESSION[$key] = '';
        unset($_SESSION[$key]);
    }
    function get_from_session($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }else { return false; }
    }
    #匹配字元
    function keyWordCheck($content, $type = ''){
        if($type == 'account' || $type == 'password') {
            $pattern = '/[a-zA-Z0-9_]/';
        }else if($type == 'comment') {
            $pattern = '/^[一-龥A-Za-z0-9 _。，、,%？]+$/';
        }else if($type == 'name') {
            $pattern = '/^[一-龥A-Za-z0-9_]+$/';
        }
        preg_match_all($pattern, $content, $match);
        $result = '';
        foreach($match[0] as $value) {#組合字元
            $result = $result.$value;
        }
        return $result;
    }
    function say($string) {
        echo '<script language="javascript">';
        echo 'alert("'.$string.'");';
        if($string == '修改成功') {
            echo 'location.href="index.php";';
        }else if($string == '註冊成功，請重新登入') {
            echo 'location.href="index.php?page=login";';
        }else if(strpos($string,'獲得道具') !== false) {
            echo 'location.href="index.php?page=monster";';
        }else {
            echo 'history.go(-1);';
        }
        echo '</script>';
    }
    #確認是否登入成功
    function CheckUser($result) {
        if($result) {
            return 'pass';
        }else {
            return 'nopass';
        }
    }
    #跳轉頁面
    function GoToPage($page = '') {
        if($page == '') {#預設
          header('Location:/practice_ajax');
        }else {
          header('Location:/practice_ajax?page='.$page);
        }
    }
    #判斷輸入值是否有在資料庫內
    function InRange($data, $value) {
        $i = 0;
        foreach($data as $d) {
            if($d === $value) {
                break;
            }
            $i++;
        }
        return $i;
    }
    function mission_statement($mission, $length) {
        $mission = string_to_array($mission);
        $statement = array();
        if(empty($mission)) {
            for($i = 0;$i < $length;$i++) {
                $statement[$i] = '未接取';
            }
            return $statement;
        }
        for($i = 0;$i < $length;$i++) {
            $now = $i + 1;
            foreach($mission as $m) {
                if($m == $now) {
                    $statement[$i] = '進行中';
                    break;
                }else {
                    $statement[$i] = '未接取';
                }
            }
        }
        return $statement;
    }
    function string_to_array($mission) {
        if(empty($mission)) {
            return $mission;
        }
        $mission = explode(",",$mission);
        return $mission;
    }
?>