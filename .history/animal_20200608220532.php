<?php 
    // check to make sure the id parameter is specified in the URL
    if (isset($_GET['id'])){
        // prepare statement and execute, prevents SQL injection
        $stmt = $pdo->prepare('SELECT * FROM animals a LEFT JOIN photos p ON a.idanimals = p.fk_idanimals
        INNER JOIN breeds b ON a.fk_idbreeds = b.idbreeds INNER JOIN animal_types aty ON b.fk_idanimal_types = aty.idanimal_types
        INNER JOIN sex s  ON a.fk_idsex = s.idsex LEFT JOIN pregnancies prg ON a.fk_idpregnancies = prg.idpregnancies
        INNER JOIN health h ON a.fk_idhealth = h.idhealth WHERE a.idanimals = ?');
        $stmt->execute([$_GET['id']]);
        // fetch from database, return as an array
        $animals = $stmt->fetch(PDO::FETCH_ASSOC);
        // check if product exist (array not empty)
        if (!$animals){
            // Simple error ro display id the id doen't exist/ is empty
            die('Animal does not exist!');
        }

    } else {
        // simple error if ID wasn't specified
        die('Animal ID was not specified!');
    }

?>

<?=template_header("Žival")?>
<?php foreach($animals as $animal): ?>
<?=animal_output($animal)?>
<?php endforeach;?>
<?=template_footer()?>
