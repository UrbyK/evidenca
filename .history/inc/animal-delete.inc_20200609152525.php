<?php
    session_start();
    include_once('./dbh.inc.php');
    $pdo = pdo_connect_mysql();
    $animal_id = $_GET['id'];
    $query = "DELETE FROM photos WHERE fk_idanimals = $animal_id";
    $pdo->exec($query);

?>