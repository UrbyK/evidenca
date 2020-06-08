<?php 
    // check to make sure the id parameter is specified in the URL
    if (isset($_GET['id'])){
        $animalid = (int)$_GET['id'];
        // prepare statement and execute, prevents SQL injection
        $query = "SELECT * FROM animals a LEFT JOIN photos p ON a.idanimals = p.fk_idanimals
        INNER JOIN breeds b ON a.fk_idbreeds = b.idbreeds INNER JOIN animal_types aty ON b.fk_idanimal_types = aty.idanimal_types
        INNER JOIN sex s  ON a.fk_idsex = s.idsex LEFT JOIN pregnancies prg ON a.fk_idpregnancies = prg.idpregnancies
        INNER JOIN health h ON a.fk_idhealth = h.idhealth
        ORDER BY idanimals DESC LIMIT ?, ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$animalid]);
        // fetch from database, return as an array
        $animal = $stmt->fetch(PDO::FETCH_ASSOC);
        // check if product exist (array not empty)
        if (!$animal){
            // Simple error ro display id the id doen't exist/ is empty
            die('Animal does not exist!');
        }

    } else {
        // simple error if ID wasn't specified
        die('Animal ID was not specified!');
    }

?>

<?=template_header("Žival")?>

<?=show_animal($animal)?>

<?=template_footer()?>
