<?php

namespace App\Model;

class Car
{
    private $db;
    private $table = "cars"; 

  
    public $id;
    public $make;
    public $model;
    public $year;
    public $rental_price;
    public $status;

   
    public function __construct($db)
    {
        $this->db = $db; 
    }


    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (make, model, year, rental_price, status) 
                  VALUES (:make, :model, :year, :rental_price, :status)";
        
        $stmt = $this->db->prepare($query);

 
        $stmt->bindParam(":make", $this->make);
        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":rental_price", $this->rental_price);
        $stmt->bindParam(":status", $this->status);

   
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

  
    public static function getCarById($id)
    {
        global $db;
        try {
            $stmt = $db->getConnectionInstance()->prepare("SELECT * FROM cars WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
   
            echo "Error: " . $e->getMessage();
        }
    }


    public static function getAllCars()
    {
        global $db;
        try {
            $stmt = $db->getConnectionInstance()->prepare("SELECT * FROM cars");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function update()
    {
        $query = "UPDATE " . $this->table . " SET make = :make, model = :model, year = :year, rental_price = :rental_price, status = :status WHERE id = :id";
        
        $stmt = $this->db->prepare($query);


        $stmt->bindParam(":make", $this->make);
        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":rental_price", $this->rental_price);
        $stmt->bindParam(":status", $this->status);
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
?>
