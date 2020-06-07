<?php
    session_start();
    include_once("./dbh.inc.php");

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

    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //vse je ok, zapišem še v bazo
            $query = "INSERT INTO photos (location_id, caption, url) VALUES (?,?,?)";
            $stmt=$pdo->prepare($query);
            $stmt->execute([$location_id,$description,$target_file]);
        } 
    }

?>