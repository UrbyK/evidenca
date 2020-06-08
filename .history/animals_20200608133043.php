<?php 
    $num_of_animals_per_page = 8;

    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;


    $query="SELECT * FROM animals a LEFT JOIN photos p ON a.idanimals = p.fk_idanimals
    INNER JOIN breeds b ON a.fk_idbreeds = b.idbreeds INNER JOIN animal_types aty ON b.fk_idanimal_types = aty.idanimal_types
    INNER JOIN sex s  ON a.fk_idsex = s.idsex INNER JOIN pregnancies prg ON a.fk_idpregnancies = prg.idpregnancies
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
<div class="row">
    <table>
        <tr>
            <th>Slika</th>
            <th>Ime</th>
            <th>Oznaka</th>
            <th>Vrsta</th>
            <th>Pasma</th>
            <th>Spol</th>
            <?php if($animal['tag'] == 'F'): ?>
                <th>Brejost</th>
            <?php endif; ?>
        </tr>
        <tr>
            <td><img src="<?=$animal['url']?>" style="max-height: 150px;"></td>
            <td><?=$animal['name']?></td>
            <td><?=$animal['ear_tag']?></td>
            <td><?=$animal['type']?></td>
            <td><?=$animal['breed']?></td>
            <td><?=$animal['sex']?></td>
            <?php if($animal['tag'] == 'F'): ?>
                <td><?=$animal["staus"]?></td>
            <?php endif; ?>
        </tr>


    </table>
</div>

<?php endforeach; ?>
<div class="row justify-content-center">
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" id="page-btn" role="group" aria-label="First group">
            <?php for($i = 0; $i <= ($total_animals/$num_of_animals_per_page); $i++): ?>
                <a href="./index.php?page=animals&p=<?=$i + 1?>"><button type="button" class="btn btn-secondary"><?=$i + 1?></button></a>
            <?php endfor; ?>
        </div>
    </div>
</div>


<?=template_footer()?>