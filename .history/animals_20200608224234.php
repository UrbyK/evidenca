<?php 
    $num_of_animals_per_page = 8;

    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;


    $query="SELECT * FROM animals a LEFT JOIN photos p ON a.idanimals = p.fk_idanimals
    INNER JOIN breeds b ON a.fk_idbreeds = b.idbreeds INNER JOIN animal_types aty ON b.fk_idanimal_types = aty.idanimal_types
    INNER JOIN sex s  ON a.fk_idsex = s.idsex LEFT JOIN pregnancies prg ON a.fk_idpregnancies = prg.idpregnancies
    INNER JOIN health h ON a.fk_idhealth = h.idhealth
    ORDER BY idanimals DESC LIMIT ?, ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $stmt->bindValue(1, ($current_page - 1) * $num_of_animals_per_page, PDO::PARAM_INT);
    $stmt->bindValue(2, $num_of_animals_per_page, PDO::PARAM_INT);
    $stmt->execute();

    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total_animals = $pdo->query('SELECT * FROM animals')->rowCount();
?>

<?=template_header("Živali")?>
<?php foreach($animals as $animal): ?>
<?=show_animal($animal)?>
<?php endforeach; ?>
<?=template_footer()?>