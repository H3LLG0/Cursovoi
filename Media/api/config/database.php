<?php
    class Database
    {
        // укажите свои учетные данные базы данных
        private $host = "localhost";
        private $db_name = "koteyka";
        private $username = "root";
        private $password = "";
        public $con;
    
        // получаем соединение с БД
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