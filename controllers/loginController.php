<?php

class LoginController{

    // database connection and table name
    private $db;
    private $table_name = "users";
  
    // object properties
    public $email;
    public $password;

    public function __construct(){
        include_once __DIR__."\..\config\dbconnecter.php";
        $this->db =new DbConnecter();
    }

    function login(){
       // echo $_POST["email"];
        $userRecord = $this->getUser($_POST["email"]);
        $loginPassword = 0;
        
        if (!empty($userRecord)) {
            if (!empty($_POST["password"])) {
               // $userpassword = $_POST["password"];
                $userpassword = md5($_POST["password"]);
            }
            
            $hashedPassword = $userRecord[0]["password"];

            var_dump($userpassword);
            var_dump($hashedPassword);
            
            $loginPassword = 0;
            if ($userpassword==$hashedPassword) {
                $loginPassword = 1;
            }

        } else {
            $loginPassword = 0;
        }

        

        if ($loginPassword == 1) {
            session_start();
            $_SESSION["email"] = $userRecord[0]["email"];
            session_write_close();
            $url = "./dashboard.php";
            header("Location: $url");
        } else if ($loginPassword == 0) {
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
    }

    public function getUser($email)
    {
        $query = 'SELECT * FROM users where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $memberRecord = $this->db->select($query, $paramType, $paramValue);
       // var_dump($memberRecord);
        return $memberRecord;
    }

    public function registerMember()
    {
        echo $_POST["gender"];
        $isEmailExists = $this->isEmailExists($_POST["email"]);
        if ($isEmailExists) {
            $response = array(
                "status" => "error",
                "message" => "Email already exists."
            );
        } else {
            if (! empty($_POST["signup-password"])) {

              //  $hashedPassword = password_hash($_POST["signup-password"], PASSWORD_DEFAULT);
                $hashedPassword = md5($_POST["signup-password"]);
            }
            $query = 'INSERT INTO users (name, email,password,gender ) VALUES (?, ?, ?, ?)';
            $paramType = 'ssss';
            $paramValue = array(
                $_POST["username"],
                $_POST["email"],
                $hashedPassword,
                $_POST["gender"],
                
            );
            $memberId = $this->db->insert($query, $paramType, $paramValue);
            if (! empty($memberId)) {
                $response = array(
                    "status" => "success",
                    "message" => "You have registered successfully."
                );
            }
        }
        return $response;
    }


    public function isEmailExists($email)
    {
        $query = 'SELECT * FROM users where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $resultArray = $this->db->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        echo $result;
        return $result;
    }

   
}