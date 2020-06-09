<?php
    session_start();
    include_once('./dbh.inc.php');
    $pdo= pdo_connect_mysql();

    if (!isset($_POST['content']) || empty($_POST['content'])) {
        header("Location: location.php?id=".$_POST['animal_id']);
        echo "<script type='text/javascript'> document.location = '../index.php?page=animal&id='".$_POST['animal_id']."; </script>";
        exit();
    }
?>