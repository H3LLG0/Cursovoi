<?php
    class Film
    {
        private $con;

        public $id;
        public $title;
        public $description;
        public $type;
        public $producer;


        public function __construct($db)
        {
            $this->con = $db;
        }
        function readFilms()
        {
            $query = "SELECT * FROM films";

            $stmt = $this->con->prepare($query);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function CreateFilm()
        {
            
        }
    }
?>