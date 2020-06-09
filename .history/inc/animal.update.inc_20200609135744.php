<?php
    session_start();
    include_once('./dbh.inc.php');
    try{
        $pdo = pdo_connect_mysql();
        $idanimal = (int)$_SESSION['animal_id'];
        $username = $_POST['username'];
        $pregnancies = $_POST['pregnancy'];
        $health = $_POST['health'];

        $query = "SELECT * FROM animals WHERE idanimals = $idanimal";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 1){
                $sql = "UPDATE animals SET fk_idusers = (SELECT idusers FROM users WHERE username = ?),
                    fk_idhealth = (SELECT idhealth FROM health WHERE status = ?),
                    fk_idpregnancies = (SELECT idpregnancies FROM pregnancies WHERE pregnancy = ?)
                    WHERE idanimals = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $health, $pregnancies, $idanimal]);

                echo "Uspešno";
                exit();
            }


        echo "Prišlo je do napake!";


    } catch(PDOException $e){
        echo $sql . $e->getMessage();
    }

    exit();
?>