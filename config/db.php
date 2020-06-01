<?php
    namespace config;
    use mysqli;
    class db{
        public $server = "localhost";
        public $dbuser = "test";
        public $dbpassword = "mfGD6s18TzL36Job";
        public $dbname = "test";

        public $connect_data;
        #db連線
        public function __construct() {
            $connection = new mysqli($this->server, $this->dbuser, $this->dbpassword, $this->dbname);
            if($connection->connect_error) {
                die("連線失敗".$connection->connect_error);
            }
            $this->connect_data = $connection;
        }
        public function __destruct() {
            $this->connect_data->close();
        }
        #select用
        public function query($sql) {
            $data = [];
            if($result = $this->connect_data->query($sql)) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                $result->free();
            }
            if(empty($data)) {
                $data = false;
            }
            return $data;
        }
        #insert,update,delete用
        public function query2($sql) {
            $this->connect_data->query($sql);
            return true;
        }
    }
?>