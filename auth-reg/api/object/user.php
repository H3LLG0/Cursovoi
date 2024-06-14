<?php

    class User
    {

        private $con;

        public $login;
        public $pas;
        public $name;
        public $lastname;


        public function __construct($db)
        {
            $this->con = $db;
        }

        function readUsers()
        {
            $query = "SELECT * FROM users";

            $stmt = $this->con->prepare($query);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function register()
        {
            $query = "INSERT INTO users
            SET
                name=:name, lastname=:lastname, login=:login, pas=:pas, id_type_user=:id_type_user";

        $stmt = $this->con->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->pas = htmlspecialchars(strip_tags($this->pas));
        $this->id_type_user = htmlspecialchars(strip_tags($this->id_type_user));


        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":login", $this->login);
        $stmt->bindParam(":pas", $this->pas);
        $stmt->bindParam(":id_type_user", $this->id_type_user);

        if ($stmt->execute()) {
            return true;
        }
            return false;

        }
    }

?>