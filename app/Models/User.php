<?php

namespace App\Model;

class User
{
    private $db;
    private $table = "users"; 

   
    public $id;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $created_at;

  
    public function __construct($db)
    {
        $this->db = $db; 
    }

   
    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (name, email, password, phone, created_at) 
                  VALUES (:name, :email, :password, :phone, :created_at)";
        
        $stmt = $this->db->prepare($query);

       
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":created_at", $this->created_at);

    
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

  
    public static function getUserById($id)
    {
        global $db;
        try {
            $stmt = $db->getConnectionInstance()->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
  
            echo "Error: " . $e->getMessage();
        }
    }


    public static function getAllUsers()
    {
        global $db;
        try {
            $stmt = $db->getConnectionInstance()->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

   
    public function update()
    {
        $query = "UPDATE " . $this->table . " SET name = :name, email = :email, password = :password, phone = :phone WHERE id = :id";
        
        $stmt = $this->db->prepare($query);

  
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
