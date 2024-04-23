<?php

class QNA extends Database {
    private $conn;

    public function __construct(){
        $this->conn = $this->db_connection();
    }

    public function insertQnA() {
        try {
            //Nacitanie JSON suboru
            $data = json_decode(file_get_contents('data/datas.json'), true);
            $otazky = $data["otazky"];
            $odpovede = $data["odpovede"];
            //Vlozenie otazok a odpovedi v ramci transakcie
            $this->conn->beginTransaction();

            $sql = "INSERT INTO qna (otazka, odpoved) VALUES (:otazka, :odpoved)";
            $statement = $this->conn->prepare($sql);
            /*BONUS*/
            for ($i = 0; $i < count($otazky); $i++) {
                $query = "SELECT COUNT(*) FROM qna WHERE otazka = :otazka AND odpoved = :odpoved "; //sql dotaz, ktory spocita kombinacie otazka, odpoved
                $check = $this->conn->prepare($query); //pripravi prikaz na vykonanie
                $check->bindParam(':otazka', $otazky[$i]); //spoji placeholder :otazka s hodnotou premennej $otazky[$i]
                $check->bindParam(':odpoved', $odpovede[$i]); //spoji placeholder :odpoved s hodnotou premennej $odpovede[$i]
                $check->execute(); //spusti prikaz
                $pocet = $check->fetchColumn(); //spocita pocet vysledkov (stlpcov)

                if ($pocet == 0) { //ak je pocet nulovy, dana kombinacia otazka-odpoved sa v databaze nenachadza, pridame ju do databazy
                    $statement->bindParam(':otazka', $otazky[$i]);
                    $statement->bindParam(':odpoved', $odpovede[$i]);
                    $statement->execute();
                }
                /*BONUS*/
            }
            $this->conn->commit();
            echo "Data boli vlozene";
        } catch (\PDOException $e) {
            //Zobrazenie chyboveho hlasenia
            echo "Chyba pri vkladani dat do databazy ".$e->getMessage();
            $this->connection->rollback(); //Vratenie spat zmien v pripade chyby
        }
    }

    public function nacitajOtazky() {
        try {
            $query = "SELECT ID_otazka, otazka, odpoved FROM qna";
            $statement = $this->conn->prepare($query);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            echo '<section class="container">';
            foreach ($result as $r) {
                echo '<div class="accordion">
                <div class="question"><strong>' .$r["ID_otazka"]."-". $r["otazka"] . '</strong></div>
                <div class="answer">' . $r["odpoved"] . '</div>';
                echo '</div>';
            }
            echo '</section>';
        } catch (\PDOException $exception) {
            echo "Chyba pri nacitani udajov z databazy" . $exception->getMessage();
        }
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function updateQuestion($index, $question, $answer) {
        try {
            $query = "SELECT * FROM qna";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $query = "UPDATE qna SET otazka = :otazka, odpoved = :odpoved WHERE $index = :id";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(':otazka', $question);
                $statement->bindParam(':odpoved', $answer);
                $statement->bindParam(':id', $result['ID_otazka']);
                $statement->execute();
                echo "Otázka bola úspešne updatovaná!";
            } else {
                echo "Nesprávny index otázky!";
            }
        } catch (\PDOException $e) {
            echo "Chyba pri updatovaní: " . $e->getMessage();
        }
    }

    public function deleteQuestion($index) {
        try {
            $query = "SELECT * FROM qna";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $query = "DELETE FROM qna WHERE $index = :id";
                $statement = $this->conn->prepare($query);
                $statement->bindParam(':id', $result['ID_otazka']);
                $statement->execute();
                echo "Otázka bola úspešne odstránená!";
            } else {
                echo "Nesprávny index otázky";
            }
        } catch (\PDOException $e) {
            echo "Chyba pri mazaní: " . $e->getMessage();
        }
    }

}
?>
