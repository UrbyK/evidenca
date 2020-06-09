<?php
    session_start();
    include_once('./dbh.inc.php');

    $idcomment = $_GET['id'];
    $animal_id = $_GET['animal_id'];

    $query = "DELETE FROM comments WHERE idcomments = ? AND fk_idusers = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$idcomment, $_SESSION['user_id']]);

    if(is_admin()){
        $query = "DELETE FROM comments WHERE idcomments = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$idcomment]);
    }

    echo "<script type='text/javascript'> document.location = '../index.php?page=animal&id=$idanimal'; </script>";
    die();
?>