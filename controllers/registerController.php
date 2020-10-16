<?php

class RegisterUser{

    // database connection and table name
    private $conn;
    private $table_name = "users";
  
    // object properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $gender;

    public function __construct($db){
        $this->conn = $db;
    }

    function create(){

        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, email=:email, password=:password, gender=:gender";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->gender=htmlspecialchars(strip_tags($this->gender));

        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":gender", $this->gender);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}