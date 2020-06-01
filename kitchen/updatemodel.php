<?php
    namespace model;
    require_once "config\db.php";
    use config\db;

    class updatemodel{
        public function updateinform($col, $memberid, $value) {
            $sql = 'UPDATE member SET '.$col.' = \''.$value.'\' WHERE id = '.$memberid;
            $db = new db();
            $db->query2($sql);
            return true;
        }
        public function accept_mission($mission, $member_id) {
            $sql = 'UPDATE member SET mission = CONCAT(`member`.mission, \''.$mission.',\') WHERE id = '.$member_id;
            $db = new db();
            $db->query2($sql);
            return true;
        }
        public function complete_mission($mission, $member) {
            $sql = 'UPDATE member SET mission = REPLACE(mission, \''.$mission.',\', \'\') WHERE member.id = '.$member;
            $db = new db();
            $db->query2($sql);
            return true;
        }
    }
?>