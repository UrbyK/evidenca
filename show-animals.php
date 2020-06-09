
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
                <td align="center"><img src="<?=$animal['url']?>" style="max-height: 125px;"></td>
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
            <a href="./inc/animal-delete.inc.php?id=<?=$animal['idanimals']?>" onclick="return confirm('Prepričani');" class="btn btn-primary">Izbriši</a> 
        <?php endif; ?>
                    

    </div>
</div>
<?php endforeach; ?>