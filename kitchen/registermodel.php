<?php
    namespace model;
    require_once "config\db.php";
    use config\db;
    class registermodel {
        #註冊
        public function register($account, $password, $name, $career) {
            $sql = 'INSERT INTO member (account, password, name, career) VALUES (\''.$account.'\', \''.$password.'\', \''.$name.'\', \''.$career.'\')';
            $db = new db();
            $db->query2($sql);
            return true;
        }
    }
?>