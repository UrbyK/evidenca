<?php

    session_start();

    include_once('./dbh.inc.php');
    $pdo = pdo_connect_mysql();

    $user = $_POST['username'];
    $pass = $_POST['password'];

    if(isset($_POST['log_btn'])){
        if(!empty($user) && !empty($pass)){
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user]);
            
            if($stmt->rowCount() == 1){
                $acc = $stmt->fetch();
                if(password_verify($pass, $acc['password'])){
                    $_SESSION['user_id'] = $acc['idusers'];
                    $_SESSION['admin'] = $acc['admin'];

                    header("Location: ../index.php");
                    die();
                }

            }

            echo "<script type='text/javascript'> document.location = '../index.php?page=login'; </script>";
            exit();
        }
    }

?>