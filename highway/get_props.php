<?php
    namespace highway;
    use model\loginmodel;
    require_once "kitchen/loginmodel.php";
    use model\displaymodel;
    require_once "kitchen/displaymodel.php";
    use model\insertmodel;
    require_once "kitchen/insertmodel.php";
    use model\deletemodel;
    require_once "kitchen/deletemodel.php";
    use model\updatemodel;
    require_once "kitchen/updatemodel.php";
    use model\getusermodel;
    require_once "kitchen/getusermodel.php";
    use model\registermodel;
    require_once "kitchen/registermodel.php";
    class get_props {
        public function entry() {
            ShowPage('entry');
        }
        public function login() {
            $csrf = csrfguard_replace_forms();
            ShowPage('login');
        }
        #驗證帳密
        public function validate_login($account, $password) {
            $model = new loginmodel();
            #過濾帳密
            $account_checked = keyWordCheck($account, 'account');
            $password_checked = keyWordCheck($password, 'password');
            #如果有不被允許的字符出現
            if($account_checked != $account || $password_checked != $password) {
                say('請重新輸入');
                return;
            }
            $result = $model->validate($account_checked, $password_checked);
            $result2 = CheckUser($result);
            #登入確認
            switch ($result2) {
                #驗證成功
                case 'pass':
                    #記住使用者帳號
                    $_SESSION['memberid'] = $result[0]['id'];
                    #記住使用者id
                    $_SESSION['name'] = $result[0]['name'];
                    $_SESSION['administrator'] = $result[0]['administrator'];
                    $_SESSION['password'] = $result[0]['password'];
                    if($_SESSION['administrator'] != null) {
                        GoToPage('indexforad');
                    }else{
                        GoToPage('index');
                    }
                    
                    break;
                #驗證失敗
                case 'nopass':
                    say('帳密錯誤');
                    return;
            }
        }
        #管理員首頁
        public function indexforad() {
            $model = new displaymodel();
            #拿到所有會員資料
            $member = $model->GetAllMembers();
            #拿到所有道具資料
            $prop = $model->GetAllProps();
            #批次給道具
            if(isset($_SESSION['name'])) {
                if($_SESSION['administrator'] != null) {
                    #防csrf
                    $csrf = csrfguard_replace_forms();
                    $csrf1 = csrfguard_replace_forms();
                    require_once "templates/welcomead.php";
                    foreach($member as $m) {
                        require "templates/welcomead1.php";
                    }
                    require_once "templates/welcomead1_2.php";
                    foreach($prop as $p) {
                        require "templates/welcomead2.php";
                    }
                    require_once "templates/welcomead2_2.php";
                }
            }
            #顯示所有會員資訊
            foreach($member as $m) {
                $r1 = $model->GetMyInform('atk', $m['id'], $m['career']);
                $r2 = $model->GetMyInform('def', $m['id'], $m['career']);
                $r3 = $model->GetMyInform('hp', $m['id'], $m['career']);
                $r4 = $model->GetMyInform('mp', $m['id'], $m['career']);
                $atk = $r1[0]['total'] + 100;
                $def = $r2[0]['total'] + 100;
                $hp = $r3[0]['total'] + 100;
                $mp = $r4[0]['total'] + 100;
                require "templates/mypower.php";
                require "templates/memberdata.php";
                $i = 1;
                $data = $model->GetMyProps($m['id']);
                #如果此會員有道具
                if($data != false) {
                    foreach($data as $d) {
                        require "templates/MyProps.php";
                        $i++;
                    }
                }else {#沒道具
                    require "templates/Noprop.php";
                }
                require "templates/endtable.php";
            }
            echo "</div>";
        }
        #登出
        public function logout() {
            session_destroy();
            GoToPage();
        }
        #給道具
        public function give_props() {
            $model = new displaymodel();
            $member = $model->GetAllMembers();
            $model2 = new insertmodel();
            foreach($member as $m) {
                $pid = rand(1, 20);
                $result = $model2->giveprops($m['id'], $pid);
            }
        }
        #給特定的人道具
        public function give_sb_props($member, $props, $quantity) {
            $model = new displaymodel();
            $mdata = $model->GetAllMembers();
            $how_many_member = count($mdata) + 1;
            #確定value是在資料庫中的值
            $result = InRange($mdata, $member);
            if($result == $how_many_member) {
                say('請重新輸入');
            }
            $pdata = $model->GetAllProps();
            $result2 = InRange($pdata, $props);
            if($result == count($pdata)) {
                say('請重新輸入');
            }
            #給道具
            $model2 = new insertmodel();
            for($i = 1;$i <= $quantity;$i++) {
                $result = $model2->giveprops($member, $props);
            }
        }
        #刪除自己想刪除的道具
        public function delete_prop($prop) {
            if($_SESSION['administrator'] == null) {
                $model2 = new displaymodel();
                $result2 = $model2->GetMyProps($_SESSION['memberid']);
                $i = 1;
                foreach($result2 as $r2) {
                    if($prop == $r2['b_id']) {
                        break;
                    }
                    $i++;
                }
                if($i > count($result2)) {
                    say('錯誤');
                    return;
                }
            }
            $model = new deletemodel();
            $result = $model->delete_my_prop($prop);
        }
        
        #一般會員首頁
        public function index($memberid, $name) {
            $model = new displaymodel();
            $career = $model->GetMyCareer($memberid);
            $data = $model->GetMyProps($memberid);
            #得到各個角色資訊
            $r1 = $model->GetMyInform('atk', $memberid, $career[0]['career']);
            $r2 = $model->GetMyInform('def', $memberid, $career[0]['career']);
            $r3 = $model->GetMyInform('hp', $memberid, $career[0]['career']);
            $r4 = $model->GetMyInform('mp', $memberid, $career[0]['career']);
            #加上初始值
            $atk = $r1[0]['total'] + 100;
            $def = $r2[0]['total'] + 100;
            $hp = $r3[0]['total'] + 100;
            $mp = $r4[0]['total'] + 100;
            if(isset($_SESSION['name'])) {
                ShowPage('welcomemember');
                require_once "templates/mypower.php";
            }
            require_once "templates/fieldname.php";
            $i = 1;
            if(!empty($data)) {
                foreach($data as $d) {
                    require "templates/MyProps.php";
                    $i++;
                }
            }else {
                ShowPage('NoProp');
            }
            ShowPage('endtable');
            $mission = $model->GetMission();#任務的所有資訊
            $mymission = $model->GetMyMission($_SESSION['memberid']);#使用者所承接的任務
            $mission_statement = mission_statement($mymission[0]['mission'], count($mission));#任務狀態
            $j = 0;
            ShowPage('missionboardtop');
            foreach($mission as $mi) {
                $mission_prop = $model->GetMissionProp($mi['mi_id']);
                $my_mission_prop = $model->GetMyMissionProp($_SESSION['memberid'], $mission_prop[0]['pid']);
                require "templates/missionboard.php";
                $j++;
            }
            ShowPage('missionboardend');
        }
        #接受任務
        public function accept_mission($mission) {
            $model2 = new displaymodel();
            $result = $model2->GetMissionNum();
            if($mission > $result[0]['mission_num']) {
                say('錯誤');
            }
            $model = new updatemodel();
            $result = $model->accept_mission($mission, $_SESSION['memberid']);
        }
        #完成任務
        public function complete_mission($mission) {
            $model4 = new displaymodel();
            $mission_num = $model4->GetMissionNum();
            if($mission > $mission_num[0]['mission_num']) {
                GoToPage();
                return;
            }
            $mission_information = $model4->GetMission();#任務的所有資訊
            $mymission = $model4->GetMyMission($_SESSION['memberid']);#使用者所承接的任務
            $mission_statement = mission_statement($mymission[0]['mission'], count($mission_information));#任務狀態
            // print_r($mission_statement);
            $mission_prop = $model4->GetMissionProp($mission);
            $my_mission_prop = $model4->GetMyMissionProp($_SESSION['memberid'], $mission_prop[0]['pid']);
            $index = $mission - 1;
            if($mission_statement[$index] != '進行中' || $my_mission_prop[0]['quantity'] == 0) {#檢查任務接取狀態和道具數量
                say('錯誤');
            }
            $del_prop_id = $model4->GetMissionProp($mission);
            $model = new updatemodel();
            $result = $model->complete_mission($mission, $_SESSION['memberid']);#任務狀態更新
            $model2 = new deletemodel();
            $result2 = $model2->delete_mission_prop($_SESSION['memberid'], $del_prop_id[0]['pid']);#刪除任務所需道具
            $model3 = new insertmodel(); 
            $prop = rand(1, 20);
            $result3 = $model3->giveprops($_SESSION['memberid'], $prop);#給獎勵
        }
        #更改密碼的介面
        public function changepassword() {
            $csrf = csrfguard_replace_forms();
            require_once "templates/changepassword.php";
        }
        #檢查密碼並更改
        public function validate_password($password) {
            $password_checked = keyWordCheck($password, 'password');
            #如果有不被允許的字符
            if($password_checked != $password) {
                say('請重新輸入');
                return;
            }
            $model = new updatemodel();
            $result = $model->updateinform('password', $_SESSION['memberid'], $password);
            if($result == true) {
                say('修改成功');
            }
        }
        #更改名稱的介面
        public function changename() {
            $csrf = csrfguard_replace_forms();
            require_once "templates/changename.php";
        }
        #檢查名稱並更改
        public function validate_name($name) {
            $name_checked = keyWordCheck($name, 'name');
            #如果有不被允許的字符
            if($name_checked != $name) {
                say('請重新輸入');
                return;
            }
            $model = new getusermodel();
            #比對資料庫中是否有相同名稱
            $result = $model->checksame('name', $name, $_SESSION['memberid']);
            #有相同名稱
            if($result != null) {
                say('已有相同名稱');
                return;
            }
            #修改
            $model2 = new updatemodel();
            $result2 = $model2->updateinform('name', $_SESSION['memberid'], $name);
            if($result2 == true) {
                $_SESSION['name'] = $name;
                say('修改成功');
            }
        }
        #打怪頁面
        public function monster() {
            ShowPage('homepage');
            $model = new displaymodel();
            $career = $model->GetMyCareer($_SESSION['memberid']);
            #得到各個角色資訊
            $r1 = $model->GetMyInform('atk', $_SESSION['memberid'], $career[0]['career']);
            $r2 = $model->GetMyInform('def', $_SESSION['memberid'], $career[0]['career']);
            $r3 = $model->GetMyInform('hp', $_SESSION['memberid'], $career[0]['career']);
            $r4 = $model->GetMyInform('mp', $_SESSION['memberid'], $career[0]['career']);
            #加上初始值
            $atk = $r1[0]['total'] + 100;
            $def = $r2[0]['total'] + 100;
            $hp = $r3[0]['total'] + 100;
            $mp = $r4[0]['total'] + 100;
            require_once "templates/mypower.php";
            require_once "templates/monstertop.php";
            $monster = $model->ShowMonster();#怪物資訊
            foreach($monster as $m) {
                if(!isset($_SESSION[$m['name']]['attacked'])) {
                    $_SESSION[$m['name']]['attacked'] = false;
                }
                if($_SESSION[$m['name']]['attacked'] == false) {
                    $_SESSION[$m['name']]['atk'] = (int)$m['atk'];
                    $_SESSION[$m['name']]['def'] = (int)$m['def'];
                    $_SESSION[$m['name']]['hp'] = (int)$m['hp'];
                }
                $prop = $model->GetMonsterProp($m['pid']);
                $_SESSION['decide'] = 0;
                require "templates/monster.php";
            }
            ShowPage('endtable');
        }
        #攻擊怪物
        public function attack($decide, $monster_id) {
            #表單重複發送的話
            if($_SESSION['decide'] != $decide) {
                unset($_SESSION['decide']);
                say('錯誤');
                return;
            }
            $_SESSION['decide'] += 1;
            $model2 = new displaymodel();
            #怪物數量
            $result2 = $model2->GetMonNum();
            if($monster_id > $result2[0]['mon_num']) {
                say('錯誤');
                return;
            }
            #得到職業加成
            $career = $model2->GetMyCareer($_SESSION['memberid']);
            #得到角色攻擊力
            $r1 = $model2->GetMyInform('atk', $_SESSION['memberid'], $career[0]['career']);
            #加上初始值
            $atk = $r1[0]['total'] + 100;
            #怪物資訊
            $result = $model2->ShowMonster($monster_id);
            #怪物名稱
            $mon_name = $result[0]['name'];
            if($atk <= $_SESSION[$mon_name]['def']) {#如果使用者的攻擊力小於怪物的防禦力
                say('請回去練練');
                return;
            }
            #使用者的攻擊力-怪物的防禦,再用怪物的血量扣除結果
            $_SESSION[$mon_name]['hp'] = $_SESSION[$mon_name]['hp'] - ((int)$atk - $_SESSION[$mon_name]['def']);
            #怪物還有血的話
            if($_SESSION[$mon_name]['hp'] > 0) {
                $_SESSION[$mon_name]['attacked'] = true;#攻擊狀態變成"攻擊中"
                //GoToPage('monster');#回打怪介面
            }else if($_SESSION[$mon_name]['hp'] <= 0) {
                $model = new insertmodel();
                $data = $model2->ShowMonster($monster_id);
                $result = $model->giveprops($_SESSION['memberid'], $data[0]['pid']);#給任務所需道具
                $bonus = $model2->GetAllProps($data[0]['pid']);
                $_SESSION[$mon_name]['hp'] = (int)$data[0]['hp'];#把怪物血量回歸預設值
                $_SESSION[$mon_name]['attacked'] = false;#把攻擊狀態回到"沒打"
                if($result == true) {
                    say('獲得道具 '.$bonus[0]['name']);
                }
            }
        }
        #註冊頁面
        public function register() {
            $csrf = csrfguard_replace_forms();
            require_once "templates/register.php";
        }
        #確認是否有相同的帳號，沒有的話就可以註冊
        public function validate_register($account, $password, $name, $career) {
            if($career != '日本武士' && $career != '黑手黨' && $career != '鬼' && $career != '雙刀流' && $career != '格鬥家') {
                say('請重新輸入');
                return;
            }
            $model = new getusermodel();
            $account_checked = keyWordCheck($account, 'account');
            $password_checked = keyWordCheck($password, 'password');
            $name_checked = keyWordCheck($name, 'name');
            #如果有不被允許的字符
            if($account_checked != $account || $password_checked != $password || $name_checked != $name) {
                say('請重新輸入');
                return;
            }
            #判斷是否有相同帳號或密碼
            $result1 = $model->checksame('account', $account);
            $result2 = $model->checksame('name', $name);
            #有相同帳號
            if($result1 != null) {
                say('已有相同帳號');
                return;
            }
            #有相同名稱
            if($result2 != null) {
                say('已有相同名稱');
                return;
            }
            if($result1 == null && $result2 == null) {
                $model2 = new registermodel();
                $result3 = $model2->register($account, $password, $name, $career);#註冊
                if($result3 == true) {
                    say('註冊成功，請重新登入');
                }
            }
        }
    }
?>