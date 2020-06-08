<?php
    include_once('./dbh.inc.php');
    $q = intval($_GET['q']);
    $pdo=pdo_connect_mysql();
$query="SELECT * FROM animals a LEFT JOIN photos p ON a.idanimals = p.fk_idanimals
INNER JOIN breeds b ON a.fk_idbreeds = b.idbreeds INNER JOIN animal_types aty ON b.fk_idanimal_types = aty.idanimal_types
INNER JOIN sex s  ON a.fk_idsex = s.idsex LEFT JOIN pregnancies prg ON a.fk_idpregnancies = prg.idpregnancies
INNER JOIN health h ON a.fk_idhealth = h.idhealth
WHERE aty.idanimal_types = ?";
$stmt = $pdo->prepare($query);
$stmt->execute();



?>