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
$stmt->execute($q);

$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php foreach($animals as $animal): ?>
<div class="row animal-table">
    <table class="table-responsive-lg">
        <thead>
            <tr>
                <th></th>
                <th>Ime</th>
                <th>Oznaka</th>
                <th>Vrsta</th>
                <th>Pasma</th>
                <th>Spol</th>
                <?php if($animal['tag'] == 'F'): ?>
                    <th>Brejost</th>
                <?php endif; ?>
                <th>Zdravje</th>
                <th>Mati</th>
                <th>Oče</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="<?=$animal['url']?>" style="max-height: 150px;"></td>
                <td><?=$animal['name']?></td></a>
                <td><?=$animal['ear_tag']?></td>
                <td><?=$animal['type']?></td>
                <td><?=$animal['breed']?></td>
                <td><?=$animal['sex']?></td>

                <?php if($animal['tag'] == 'F'): ?>
                    <?php if(!empty($animal['fk_idpregnancies'])): ?>
                        <td><?=$animal["pregnancy"]?></td>
                    <?php else: ?>
                        <td>N/A</td>
                    <?php endif;?>
                <?php endif; ?>
                
                <td><?=$animal['status']?></td>

                <td><?php if(isset($animal['idmother'])): ?>
                <a href="./index.php?page=animal&id=<?=$animal['idmother']?>"><?=get_animal($animal['idmother'])?></a>
                <?php else: echo"N/A"; endif; ?>
                        
                </td>
                <td><?php if(isset($animal['idfather'])): ?>
                    <a href="./index.php?page=animal&id=<?=$animal['idfather']?>"><?=get_animal($animal['idfather'])?></a>
                <?php else: echo"N/A"; endif; ?></td>
            </tr>

        </tbody>   

    </table>
    <div class="controls">
        
        <a href="./index.php?page=animal&id=<?=$animal['idanimals']?>" class="btn btn-primary">Pogled</a>

        <?php if(($animal['fk_idusers'])=== $_SESSION['user_id']):?>
            <a href="./index.php?page=animal-edit&id=<?=$animal['idanimals']?>" class="btn btn-primary">Uredi</a>
        <?php endif; ?>
                    

    </div>
</div>
<?php endforeach; ?>