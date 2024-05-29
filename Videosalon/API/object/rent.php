<?php
    class Rent
    {
        private $con;

        public $client;
        public $product;
        public $term;
        public $price;
        public function __construct($db)
        {
            $this->con = $db;
        }
        function RentFilm()
        {
            $query = "INSERT INTO film_rent
            SET
                client=:client, product=:product, term=:term, price=:price";

        $stmt = $this->con->prepare($query);

        $this->client = htmlspecialchars(strip_tags($this->client));
        $this->product = htmlspecialchars(strip_tags($this->product));
        $this->term = htmlspecialchars(strip_tags($this->term));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bindParam(":client", $this->client, PDO::PARAM_INT);
        $stmt->bindParam(":product", $this->product, PDO::PARAM_INT);
        $stmt->bindParam(":term", $this->term, PDO::PARAM_INT);
        $stmt->bindParam(":price", $this->price, PDO::PARAM_INT);


        if ($stmt->execute()) {
            return true;
        }
            return false;
        }
        function ReadRentedFilms()
        {
            $query = "SELECT * FROM film_rent WHERE client=:client";

        $stmt = $this->con->prepare($query);

        $this->client = htmlspecialchars(strip_tags($this->client));

        $stmt->bindParam(":client", $this->client, PDO::PARAM_INT);

        $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }    
    }
?>