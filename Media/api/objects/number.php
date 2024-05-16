<?php
    class Number
    {
        private $con;
        private $table_name = "number";

        public $id;
        public $name;
        public $area;
        public $size;
        public $price;

        


        public function __construct($db)
        {
            $this->con = $db;
        }
        function read()
{
    // выбираем все записи
    $query = "SELECT * FROM number";

    // подготовка запроса
    $stmt = $this->con->prepare($query);

    // выполняем запрос
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
    }
?>