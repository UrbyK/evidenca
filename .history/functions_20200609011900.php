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
        echo $item['ear_tag'] ." ".$item['name'];
    endforeach;
}
function is_admin(){

}

function animalTypeSelect($type){
    $pdo = pdo_connect_mysql();

    $query="SELECT idanimal_types FROM animal_types WHERE lower(type) = lower($type)";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $tip = $stmt->fetchAll(PDO::FETCH_ASSOC);
   foreach($tip as $item){
       return($item['idanimal_types'])
   };

}

?>