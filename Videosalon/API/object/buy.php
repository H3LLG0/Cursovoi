<?php
    class Buy
    {
        private $con;

        public $client;
        public $product;
        public $price;
        public function __construct($db)
        {
            $this->con = $db;
        }
        function BuyFilm()
        {
            $query = "INSERT INTO film_buy
            SET
                client=:client, product=:product, price=:price";

        $stmt = $this->con->prepare($query);

        $this->client = htmlspecialchars(strip_tags($this->client));
        $this->product = htmlspecialchars(strip_tags($this->product));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bindParam(":client", $this->client);
        $stmt->bindParam(":product", $this->product);
        $stmt->bindParam(":price", $this->price);

        if ($stmt->execute()) {
            return true;
        }
            return false;
        }

        function ReadBuedFilms()
        {
            $query = "SELECT * FROM film_buy
                INNER JOIN films
                    ON film_buy.product = films.id
            WHERE client=:client";

        $stmt = $this->con->prepare($query);

        $this->client = htmlspecialchars(strip_tags($this->client));

        $stmt->bindParam(":client", $this->client, PDO::PARAM_INT);

        $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }    
    }
?>