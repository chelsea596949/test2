<?php
    namespace model;
    require_once "config\db.php";
    use config\db;

    class displaymodel {
        #我的道具
        public function GetMyProps($memberid) {
            $sql = 'SELECT `props`.name as pname, create_time, `props`.atk as p_atk, `props`.def as p_def, `props`.hp as p_hp, `props`.mp as p_mp
            , attr, `bag`.id as b_id FROM bag, member, props WHERE `member`.id = '.$memberid.' AND
             `member`.id = `bag`.mid AND `bag`.pid = `props`.id ORDER BY create_time DESC';
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #所有使用者
        public function GetAllMembers() {
            $sql = 'SELECT * FROM member WHERE administrator IS NULL';
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #我的能力值
        public function GetMyInform($col, $memberid, $career) {
            $sql = 'SELECT sum(`props`.'.$col.') as total FROM bag, member, props WHERE `member`.id = '.$memberid.' AND
            `member`.id = `bag`.mid AND `bag`.pid = `props`.id AND `props`.attr = \''.$career.'\'';
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #所有道具
        public function GetAllProps($prop = '') {
            if($prop == '') {
                $sql = 'SELECT * FROM props';
            }else {
                $sql = 'SELECT * FROM props WHERE id = '.$prop;
            }
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #我的職業
        public function GetMyCareer($memberid) {
            $sql = 'SELECT career FROM member WHERE administrator IS NULL AND id = '.$memberid;
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #所有任務
        public function GetMission() {
            $sql = 'SELECT `mission`.name as mi_name , `props`.name as pname , `mission`.id as mi_id , `mission`.pid as mi_pid 
            FROM mission, props WHERE `mission`.pid = `props`.id';
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #我的任務
        public function GetMyMission($memberid) {
            $sql = 'SELECT mission FROM member WHERE id = '.$memberid;
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #任務所需道具
        public function GetMissionProp($mission_id) {
            $sql = 'SELECT pid FROM mission WHERE id = '.$mission_id;
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #我所擁有的任務道具
        public function GetMyMissionProp($memberid, $pid) {
            $sql = 'SELECT count(`bag`.id) as quantity FROM member, bag, props WHERE `member`.id = `bag`.mid AND `member`.id = '.$memberid.' AND 
            `bag`.pid = `props`.id AND `bag`.pid = '.$pid;
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #怪物
        public function ShowMonster($monster = '') {
            if($monster == '') {
                $sql = 'SELECT * FROM monster';
            }else {
                $sql = 'SELECT * FROM monster WHERE id = '.$monster;
            }
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #怪物會掉落的道具
        public function GetMonsterProp($prop) {
            $sql = 'SELECT name FROM props WHERE id = '.$prop;
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #我的攻擊
        public function GetMyPower($member_id) {
            $sql = 'SELECT atk FROM member WHERE id = '.$member_id;
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        #任務數量
        public function GetMissionNum() {
            $sql = 'SELECT count(*) as mission_num FROM mission';
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
        public function GetMonNum() {
            $sql = 'SELECT count(*) as mon_num FROM monster';
            $db = new db();
            $result = $db->query($sql);
            return $result;
        }
    }
?>