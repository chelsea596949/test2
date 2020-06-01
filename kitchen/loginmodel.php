<?php
    namespace model;
    require_once "config\db.php";
    use config\db;
    class loginmodel {
        #驗證帳密
        public function validate($account, $password) {
            $sql = 'SELECT * FROM member WHERE account = \''.$account.'\'';
            $db = new db();
            $result1 = $db->query($sql);
            #如果帳號正確
            if($result1 != false) {
                $sql2 = 'SELECT * FROM member WHERE account = \''.$account.'\' AND password = \''.$password.'\'';
                $result2 = $db->query($sql2);
                #帳密都對
                if($result2 != false) {
                    return $result2;
                #密碼錯誤
                }else{
                    return 0;
                }
            #帳號錯誤
            }else {
                return 0;
            }
        }
    }
?>