
<div class="row">
    <div class="table-responsive-sm">
    <table >
        <thead>
            <tr>
                <th class="col">Slika</th>
                <th>Ime</th>
                <th>Oznaka</th>
                <th>Vrsta</th>
                <th>Pasma</th>
                <th>Spol</th>
                <?php if($item['tag'] == 'F'): ?>
                    <th>Brejost</th>
                <?php endif; ?>
                <th>Zdravje</th>
                <th>Mati</th>
                <th>Oče</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="<?=$item['url']?>" style="max-height: 150px;"></td>
                <td><?=$item['name']?></td></a>
                <td><?=$item['ear_tag']?></td>
                <td><?=$item['type']?></td>
                <td><?=$item['breed']?></td>
                <td><?=$item['sex']?></td>

                <?php if($item['tag'] == 'F'): ?>
                    <?php if(!empty($item['fk_idpregnancies'])): ?>
                        <td><?=$item["pregnancy"]?></td>
                    <?php else: ?>
                        <td>N/A</td>
                    <?php endif;?>
                <?php endif; ?>
                
                <td><?=$item['status']?></td>

                <td><?php if(isset($item['idmother'])): ?>
                <a href="./index.php?page=animal&id=<?=$item['idmother']?>"><?=get_animal($item['idmother'])?></a>
                <?php else: echo"N/A"; endif; ?>
                        
                </td>
                <td><?php if(isset($item['idfather'])): ?>
                    <a href="./index.php?page=animal&id=<?=$item['idfather']?>"><?=get_animal($item['idfather'])?></a>
                <?php else: echo"N/A"; endif; ?></td>
            </tr>

        </tbody>    
    </table>
    </div>
</div>
