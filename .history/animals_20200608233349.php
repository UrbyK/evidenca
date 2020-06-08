<?php 
    if(!empty($_SESSION['user_id']) && isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }

    $num_of_animals_per_page = 7;

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

        <?php if(($animal['fk_idusers']) == $user_id):?>
            <a href="./index.php?page=animal-edit&id=<?=$animal['idanimals']?>" class="btn btn-primary">Uredi</a>
        <?php endif; ?>
                    

    </div>
</div>
<?php endforeach; ?>

<!-- page navigation buttons -->
<div class="row justify-content-center">
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" id="page-btn" role="group" aria-label="First group">
            <?php for($i = 0; $i <= ($total_animals/$num_of_animals_per_page)-1; $i++): ?>
                <a href="./index.php?page=animals&p=<?=$i + 1?>"><button type="button" class="btn btn-secondary"><?=$i + 1?></button></a>
            <?php endfor; ?>
        </div>
    </div>
</div>


<?=template_footer()?>