<?php
    class User
    {
        private $con;

        public $id;
        public $name;
        public $surname;
        public $email;
        public $password;
        public $role;

        public function __construct($db)
        {
            $this->con = $db;
        }
        function readUser()
        {
            $query = "SELECT * FROM users";

            $stmt = $this->con->prepare($query);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function registerUser()
        {
        $query = "INSERT INTO users
            SET
                name=:name, surname=:surname, email=:email, password=:password, role=:role";

        $stmt = $this->con->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->role = htmlspecialchars(strip_tags($this->role));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);

        if ($stmt->execute()) {
            return true;
        }
            return false;
        }
    }
?>