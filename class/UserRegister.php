<?php

class UserRegister
{

    private $conn;
    private $table_name = "users";

    public $name;
    public $email;
    public $password;
    public $confirm_password;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setConfirmPassword($confirm_password)
    {
        $this->confirm_password = $confirm_password;
    }




    public function validatePassword()
    {
        if ($this->password !== $this->confirm_password) {
            return false;
        }
        return true;
    }
    public function checkPasswordLength()
    {       //strlen() เป็นฟังชั่นเช็คความยาวของ string
        if (strlen($this->password) < 6) {
            return false;
        }
        return true;
    }

    public function validateUserInput()
    {
        if (!$this->checkPasswordLength() || !$this->validatePassword() || $this->checkEmail()) {
            return false;
        }
        return true;
    }


    public function createUser()
    {

        if (!$this->validateUserInput()) {
            return false;
        }


        $sql = "INSERT INTO {$this->table_name}(name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $hashedPassword);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function checkEmail()
    {
        $query = "SELECT id FROM {$this->table_name} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(":email", $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
