<?php
    namespace model;
    require_once "config\db.php";
    use config\db;

    class deletemodel {
        public function delete_mission_prop($member, $prop) {
            $sql = 'DELETE FROM bag WHERE mid = '.$member.' AND pid = '.$prop.' LIMIT 1';
            $db = new db();
            $result = $db->query2($sql);
            return $result;
        }
        public function delete_my_prop($prop) {
            $sql = 'DELETE FROM bag WHERE id = '.$prop;
            $db = new db();
            $result = $db->query2($sql);
            return $result;
        }
    }
?>