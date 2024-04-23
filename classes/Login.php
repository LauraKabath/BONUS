<?php

class Login extends Database {
    private $conn;

    public function __construct(){
        $this->conn = $this->db_connection();
    }

    public function register($meno, $heslo, $repeatHeslo , $email){

        if ($heslo !== $repeatHeslo){
            echo "Nespravne zadane heslo";
            return false;
        }

        $query = "INSERT INTO tabpouzivatelia(Meno, Email, Heslo) VALUES (:meno, :email, :heslo)";
        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(':meno', $meno);
        $stmt->bindParam(':heslo', $heslo);
        $stmt->bindParam(':email', $email);

        try {
            $insert = $stmt->execute();
            return $insert;
        } catch (\Exception $exception){
            echo "Chyba pri vkladani".$exception->getMessage();
            $this->conn->rollback();
        }

    }

    public function login($email, $heslo){
        $query = "SELECT * FROM tabpouzivatelia WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);

        try {
            $stmt->execute();
            $userdata = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0){
                if ($heslo == $userdata['Heslo']){
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = true; //$userdata['ID_pouzivatel'];
                    return true;
                } else {
                    return false;
                }
            } else {
                return "neregistrovany";
            }
        } catch (\Exception $exception){
            echo "Chyba pri prihlasovani".$exception->getMessage();
            $this->conn->rollback();
        }

    }
}