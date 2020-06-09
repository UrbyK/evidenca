<?php

include_once('./functions.php');
$pdo = pdo_connect_mysql();
$search_item = "";
    if(!empty($_GET['search']) && isset($_GET['search_btn'])){

        $search_item = $_GET['search'];

        $stmt = $pdo->prepare("SELECT * FROM animals a LEFT JOIN photos p ON a.idanimals = p.fk_idanimals
        INNER JOIN breeds b ON a.fk_idbreeds = b.idbreeds 
        INNER JOIN animal_types aty ON b.fk_idanimal_types = aty.idanimal_types
        INNER JOIN sex s  ON a.fk_idsex = s.idsex 
        LEFT JOIN pregnancies prg ON a.fk_idpregnancies = prg.idpregnancies
        LEFT JOIN users u ON a.fk_idusers = u.idusers
        INNER JOIN health h ON a.fk_idhealth = h.idhealth 
        WHERE a.name LIKE '%".$search_item."%' 
        OR a.ear_tag LIKE '%".$search_item."%'
        OR lower(b.breed) LIKE  lower('%".$search_item."%')
        OR lower(aty.type) LIKE lower('%".$search_item."%')" );

$stmt->execute();

$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    /*
        foreach($products as $product){
            echo $product['name']."<br />\n";
        }*/
    
    }
    else{
        header("Location: ./#");
        exit();
    }


?>

<?=template_header("Živali")?>
<?=show_animals($animals)?>


<?=template_footer()?>