<?php
    session_start();
    include_once('./dbh.inc.php');
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

        //picture upload
        $total = count($_FILES['name']);
        echo $total;
        /*
        $animal_id = $pdo->lastInsertId();
        $target_dir = "./uploads/";
        $change_name = date("Y-m-d-h-i-s")."-".$animal_id."-";
        $target_file = $target_dir . $change_name . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }*/
    }
?>