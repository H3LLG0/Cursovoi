<?php
    class City
    {
        private $con;
        private $table_name = "city";

        public $id;
        public $name;
        public $slogan;

        public function __construct($db)
        {
            $this->con = $db;
        }

        function readCity()
        {
            $min = 1;
            $max = 2;
            $random = mt_rand($min, $max);
            if($random == 1)
            {
                $query = "SELECT * FROM city WHERE id = $random";

                $stmt = $this->con->prepare($query);
        
                // выполняем запрос
                $stmt->execute();
        
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                return $result;
            }
            else
            {
                $query = "SELECT * FROM city WHERE id = $random";

                $stmt = $this->con->prepare($query);
        
                // выполняем запрос
                $stmt->execute();
        
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                return $result;
            }
        }
    }
?>