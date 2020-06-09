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
        INNER JOIN health h ON a.fk_idhealth = h.idhealth WHERE a.name LIKE '%".$search_item."%' OR a.ear_tag LIKE '%".$search_item."%'");

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
<?php foreach($animals as $animal): ?>
    <div class="row animal-table">
    <table class="table-responsive-lg table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Ime</th>
                <th scope="col">Oznaka</th>
                <th scope="col">Vrsta</th>
                <th scope="col">Pasma</th>
                <th scope="col">Spol</th>
                <?php if($animal['tag'] == 'F'): ?>
                    <th scope="col">Brejost</th>
                <?php endif; ?>
                <th scope="col">Zdravje</th>
                <th scope="col">Mati</th>
                <th scope="col">Oče</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="<?=$animal['url']?>" style="max-width: 100%;"></td>
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

        <?php if(is_admin() || $_SESSION['user_id'] == $animal['fk_idusers']): ?>
            <a href="./index.php?page=animal-edit&id=<?=$animal['idanimals']?>" class="btn btn-primary">Uredi</a>
            <button class="btn btn-primary">Odstrani</button>
        <?php endif; ?>
                    

    </div>
</div>
<?php endforeach; ?>


<?=template_footer()?>