<?php

    include_once('./dbh.inc.php');
    $pdo = pdo_connect_mysql();

    $query="SELECT idanimal_types FROM animal_types WHERE lower(type) = lower('govedo')";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $tip = $stmt->fetch()

    print_r($tip);
?>