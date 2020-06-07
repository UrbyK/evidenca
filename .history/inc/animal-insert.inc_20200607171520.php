<?php
    include_once('./dbh.inc.php');
    include_once('./picture-upload.inc.php');
    $pdo = pdo_connect_mysql();

    if(isset($_POST['sub_btn'])){
        
        $name = $_POST['name'];
        $ear_tag = $_POST['ear_tag'];
        $birth = date('Y-m-d', strtotime($_POST['birth']));
        $sex = $_POST['sex'];
        $user = $_SESSION['user_id'];
        $mother = $_POST['mother'];
        if($mother===""){
            $mother=null;
        }
        $father = $_POST['father'];
        if($father===""){
            $father=null;
        }

        $breed = $_POST['breed'];
        $pregnancy = $_POST['pregnancy'];
        if($pregnancy===""){
            $pregnancy=null;
        }

        $health = $_POST['health'];

        $querry = "INSERT INTO animals (name, ear_tag, birth, fk_idsex, fk_idusers, idmother, idfather, fk_idbreeds, fk_idpregnancies, fk_idhealth)
                VALUES(?,?,?,?,?,?,?,?,?,?)";

        $stmt = $pdo->prepare($querry);
        $stmt->execute([$name, $ear_tag, $birth, $sex, $user, $mother, $father, $breed, $pregnancy, $health]);
       
        $last_id = $pdo->lastInsertId();
        $url = $_FILES['files']['name'];
        image_upload($last_id, $url);



    }
?>