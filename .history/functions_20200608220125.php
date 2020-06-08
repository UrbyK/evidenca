<?php
    session_start();
    include('./inc/dbh.inc.php');

function template_header($title){
    include_once('./header.php');
}

function template_footer(){
    include_once('./footer.php');
}

function get_animal($idanimal){
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare("SELECT * FROM animals WHERE idanimals = $idanimal");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $item):
        echo $item['ear_tag'] ." ".$item['name'];
    endforeach;
}

function animal_output($animal){
    echo <<<EOT
    <div class="row">
    <table >
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
            <th>Zdravje</th>
            <th>Mati</th>
            <th>Oče</th>
        </tr>
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


    </table>
</div>
<?php endforeach; ?>

<!-- page navigation buttons -->
<div class="row justify-content-center">
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" id="page-btn" role="group" aria-label="First group">
            <?php for($i = 0; $i <= ($total_animals/$num_of_animals_per_page); $i++): ?>
                <a href="./index.php?page=animals&p=<?=$i + 1?>"><button type="button" class="btn btn-secondary"><?=$i + 1?></button></a>
            <?php endfor; ?>
        </div>
    </div>
</div>
EOT;
}



?>