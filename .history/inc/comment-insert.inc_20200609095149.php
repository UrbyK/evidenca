<?php
    session_start();
    include_once('./dbh.inc.php');
    $pdo= pdo_connect_mysql();

    $idanimal = $_POST['animal_id'];

    if (!isset($_POST['content']) || empty($_POST['content'])) {
        echo "<script type='text/javascript'> document.location = '../index.php?page=animal&id=$idanimal'; </script>";
        die();
    }


    $rate = $_POST['rate'];
    $content = $_POST['content'];
    $idusers= $_SESSION['user_id'];

    $query = "INSERT INTO comments(fk_idanimals, fk_idusers, content, rating) VALUES(?,?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$idanimal, $idusers, $content, $rate]);

    echo "<script type='text/javascript'> document.location = '../index.php?page=animal&id=$idanimal'; </script>";
    die();

?>