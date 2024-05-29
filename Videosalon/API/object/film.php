<?php
    class Film
    {
        private $con;

        public $id;
        public $title;
        public $poster;
        public $description;
        public $producer;
        public $rentprice;
        public $buyprice;


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
            $query = "INSERT INTO films SET title=:title, description=:description, producer=:producer, poster=:poster, rentprice=:rentprice, buyprice=:buyprice";

            $stmt = $this->con->prepare($query);

            
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->producer = htmlspecialchars(strip_tags($this->producer));
            $this->poster = htmlspecialchars(strip_tags($this->poster));
            $this->rentprice = htmlspecialchars(strip_tags($this->rentprice));
            $this->buyprice = htmlspecialchars(strip_tags($this->buyprice));

            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":producer", $this->producer);
            $stmt->bindParam(":poster", $this->poster);
            $stmt->bindParam(":rentprice", $this->rentprice);
            $stmt->bindParam(":buyprice", $this->buyprice);

            if ($stmt->execute()) {
                return true;
            }
                return false;
        }
        function UpdateFilm()
        {
            $query = "UPDATE films SET title=:title, description=:description, producer=:producer, rentprice=:rentprice, buyprice=:buyprice 
                        WHERE id=:id";

            $stmt = $this->con->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->producer = htmlspecialchars(strip_tags($this->producer));
            $this->rentprice = htmlspecialchars(strip_tags($this->rentprice));
            $this->buyprice = htmlspecialchars(strip_tags($this->buyprice));

            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":producer", $this->producer);
            $stmt->bindParam(":rentprice", $this->rentprice);
            $stmt->bindParam(":buyprice", $this->buyprice);

        if ($stmt->execute()) {
            return true;
        }
            return false;
        }
        function UpdateFilmWithPoster()
        {
            $query = "UPDATE films SET title=:title, description=:description, producer=:producer, poster=:poster, rentprice=:rentprice, buyprice=:buyprice 
                        WHERE id=:id";

            $stmt = $this->con->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->producer = htmlspecialchars(strip_tags($this->producer));
            $this->poster = htmlspecialchars(strip_tags($this->poster));
            $this->rentprice = htmlspecialchars(strip_tags($this->rentprice));
            $this->buyprice = htmlspecialchars(strip_tags($this->buyprice));

            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":producer", $this->producer);
            $stmt->bindParam(":poster", $this->poster);
            $stmt->bindParam(":rentprice", $this->rentprice);
            $stmt->bindParam(":buyprice", $this->buyprice);

        if ($stmt->execute()) {
            return true;
        }
            return false;
        }

        function DeleteFilm()
        {

            $query = "DELETE FROM films 
                        WHERE id=:id";

            $stmt = $this->con->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":id", $this->id);

            if ($stmt->execute()) {
                return true;
            }
                return false;

        }
    }
?>