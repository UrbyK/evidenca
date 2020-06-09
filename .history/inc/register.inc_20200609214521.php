<?php
    include_once('./dbh.inc.php');
    $pdo = pdo_connect_mysql();

    if(isset($_POST['reg_btn'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $email = htmlspecialchars($_POST['email']);
        $pass = $_POST['password'];
        $pass_conf = $_POST['confirm_password'];

        if(!empty($username) && !empty($email) && !empty($pass) && !empty($pass) && ($pass==$pass_conf)){
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (fname, lname, username, email, password)
                VALUES(?,?,?,?,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$fname, $lname, $username, $email, $pass]);
        }

    }
    else{

        echo "<script type='text/javascript'> document.location = '../index.php?page=register'; </script>";
        exit();
    }
    echo "<script type='text/javascript'> document.location = '../index.php?page=login'; </script>";
    exit();

?>