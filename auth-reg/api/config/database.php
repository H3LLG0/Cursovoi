<?php
    class Database
    {
        private $host = "localhost";
        private $db_name = "AuthDB";
        private $username = "root";
        private $password = "";
        public $con;
    
        public function getConnection()
        {
            $this->con = null;
    
            try {
                $this->con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->con->exec("set names utf8");
            } catch (PDOException $exception) {
                echo "Ошибка подключения: " . $exception->getMessage();
            }
    
            return $this->con;
        }
    }
?>