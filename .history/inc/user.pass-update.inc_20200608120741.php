<?php
    session_start();
    include_once('./dbh.inc.php');
    try{
        $pdo = pdo_connect_mysql();
        $idusers = (int)$_SESSION['user_id'];
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $confirm_password = $_POST['confirm_password'];

        $query = "SELECT * FROM users WHERE idusers = $idusers";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 1 && ($new_pass == $confirm_password)){
            $acc = $stmt->fetch();
            if(password_verify($old_pass, $acc['password'])){
                $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = ? WHERE idusers = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$new_pass, $idusers]);

                echo"Geslo uspešno spremenjeno!";
                exit();
            }
            echo"Prišlo je do napake!";
        }
        echo"Preverite potrditev gesla!"


    } catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
?>