<?php 
$query="SELECT * FROM animals ORDER BY date_add";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

<?=template_header("Živali")?>

<div class="row">
    <?php foreach($animals as $animal): ?>
        <div class=""
</div>

<?=template_footer()?>