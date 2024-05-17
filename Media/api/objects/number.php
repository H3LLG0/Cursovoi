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
    function create()
    {
        // запрос для вставки (создания) записей
        $query = "INSERT INTO
               number
            SET
                name=:name, area=:area, size=:size, price=:price";

        // подготовка запроса
        $stmt = $this->con->prepare($query);

        // очистка
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->area = htmlspecialchars(strip_tags($this->area));
        $this->size = htmlspecialchars(strip_tags($this->size));
        $this->price = htmlspecialchars(strip_tags($this->price));

        // привязка значений
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":area", $this->area);
        $stmt->bindParam(":size", $this->size);
        $stmt->bindParam(":price", $this->price);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    }
?>