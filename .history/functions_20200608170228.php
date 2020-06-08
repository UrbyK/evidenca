<?php
    session_start();
    include('./inc/dbh.inc.php');

function template_header($title){
    include_once('./header.php');
}

function template_footer(){
    include_once('./footer.php');
}

function get_animal($idanimal){
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare("SELECT * FROM animals WHERE idanimals = $idanimal");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $item):
        echo $item['name'];
    endforeach;
}


?>