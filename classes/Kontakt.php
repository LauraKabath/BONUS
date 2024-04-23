<?php

class Kontakt extends Database {
    private $conn;

    public function __construct(){
        $this->conn = $this->db_connection();
    }

    public function addNote($name, $email, $notes){

        $query = "INSERT INTO tabkontakt(meno, email, poznamka) VALUES(:name, :email, :notes)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':notes', $notes);

        try {
            $insert = $stmt->execute();
            return $insert;
        } catch (\Exception $exception){
            echo "Chyba pri vkladani".$exception->getMessage();
            $this->conn->rollback();
        }
    }

}