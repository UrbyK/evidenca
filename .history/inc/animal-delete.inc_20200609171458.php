<?php
    include_once('./dbh.inc.php');
    $pdo = pdo_connect_mysql();
    $animal_id = $_GET['id'];
    
    $base_directory = '../  ';

    $query = "SELECT * FROM photos p WHERE p.fk_idanimals = $animal_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($photos as $photo){
        unlink($base_directory.$photo['url']);
    }

    $query = "DELETE FROM photos WHERE fk_idanimals = $animal_id";
    $pdo->exec($query);

    $query = "DELETE FROM comments WHERE fk_idanimals = $animal_id";
    $pdo->exec($query);


    $stmt = $pdo->prepare("SELECT * FROM animals WHERE idmother = $animal_id OR idfather = $animal_id");
    $stmt->execute();
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($animals as $animal){
        if($animal['idmother'] == $animal_id){
            $query="UPDATE animals SET idmother = null WHERE idmother = $animal_id";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
        }

        if($animal['idfather'] == $animal_id){
            $query="UPDATE animals SET idfather = null WHERE idfather = $animal_id";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
        }
    }
    $query = "DELETE FROM animals WHERE idanimals = $animal_id";
    $pdo->exec($query);

    
    exit();

?>