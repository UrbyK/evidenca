<?php 
    session_start();
    unset($_SESSION['user_id'], $_SESSION['admin']);
    session_destroy();
    echo"Uspešno izpisani!";    
    header("Location: index.php");

    exit();
?>