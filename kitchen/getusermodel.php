<?php
    namespace model;
    require_once "config\db.php";
    use config\db;
    class getusermodel {
        #尋找是否有相同使用者
        public function checksame($colname, $value, $member='') {
            $sql = 'SELECT '.$colname.' FROM member WHERE '.$colname.' = \''.$value.'\'';
            if($member != '') {
                $sql = $sql.'AND id != '.$member;
            }
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
    }
?>