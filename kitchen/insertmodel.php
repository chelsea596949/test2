<?php
    namespace model;
    require_once "config\db.php";
    use config\db;

    class insertmodel {
        public function giveprops($mid, $pid) {
            $sql = 'INSERT INTO bag (mid, pid) VALUES ('.$mid.', '.$pid.')';
            $db = new db();
            $result = $db->query2($sql);
            return $result;
        }
    }
?>