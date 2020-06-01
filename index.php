<?php
    session_start();
    use highway\get_props;
    require_once "highway/get_props.php";
    require_once "config/function.php";
    $init = new get_props();
    require_once "templates/header.php";
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
            case "login":
                $init->login();
            break;
            case "changepassword":
                $init->changepassword();
            break;
            case "changename":
                $init->changename();
            break;
            case "monster":
                $init->monster();
            break;
            case "register":
                $init->register();
            break;
            default:
                if(!isset($_SESSION['memberid'])) {
                    $init->entry();
                }else {
                    if($_SESSION['administrator'] != null) {
                        $init->indexforad();
                    }else {
                        $init->index($_SESSION['memberid'], $_SESSION['name']);
                    }
                } 
            break;
        }
    }else if(isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case "login":
                $init->validate_login($_POST['account'], $_POST['password']);
            break;
            case "logout":
                $init->logout();
            break;
            case "giveprops":
                csrfguard_start();
                $init->give_props();
                $init->indexforad();
            break;
            case "givesbprops":
                csrfguard_start();
                $init->give_sb_props($_POST['member'], $_POST['props'], $_POST['quantity']);
                $init->indexforad();
            break;
            case "delete_prop":
                $init->delete_prop($_POST['prop']);
                if($_SESSION['administrator'] != null) {
                    $init->indexforad();
                }else {
                    $init->index($_SESSION['memberid'], $_SESSION['name']);
                }
            break;
            case "accept_mission":
                $init->accept_mission($_POST['mission']);
                $init->index($_SESSION['memberid'], $_SESSION['name']);
            break;
            case "complete_mission":
                $init->complete_mission($_POST['done']);
                $init->index($_SESSION['memberid'], $_SESSION['name']);
            break;
            case "changepassword":
                csrfguard_start();
                $init->validate_password($_POST['password']);
            break;
            case "changename":
                csrfguard_start();
                $init->validate_name($_POST['name']);
            break;
            case "attack":
                $init->attack($_POST['decide'], $_POST['monster_id']);
                $init->monster();
            break;
            case "register":
                csrfguard_start();
                $init->validate_register($_POST['account'], $_POST['password'], $_POST['name'], $_POST['career']);
            break;
            default:
                if(!isset($_SESSION['memberid'])) {
                    $init->entry();
                }else {
                    if($_SESSION['administrator'] != null) {
                        $init->indexforad();
                    }else {
                        $init->index($_SESSION['memberid'], $_SESSION['name']);
                    }
                }
            break;
        }
    }else {
        if(!isset($_SESSION['memberid'])) {
            $init->entry();
        }else {
            if($_SESSION['administrator'] != null) {
                $init->indexforad();
            }else {
                $init->index($_SESSION['memberid'], $_SESSION['name']);
            }
        }
    }
    require_once "templates/footer.php";
?>