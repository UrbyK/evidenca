<?php 
    $num_of_animals_per_page = 8;

    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;


    $query="SELECT * FROM animals a LEFT JOIN photos p ON a.idanimals = p.fk_idanimals
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

<div class="row">
    <?php foreach($animals as $animal): ?>
        <div class="card col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
            <div class="hvrbox">
            <a href="./index.php?page=animal&id=<?=$animal['idanimals']?>">
                <img src="<?=$animal['url']?>" alt="<?=$animal['url']?>"
                    class="card-img-top hvrbox-layer_bottom img-thumbnail">
                    <div class="hvrbox-layer_top hvrbox-layer_slideup">
                        <p class="hvrbox-text"><?=$animal['summary']?></p>
                    </div>
            </a>
            </div>
            <div class="card-body">

            </div>   
        </div>

    <?php endforeach; ?>
</div>

<div class="row justify-content-center">
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" id="page-btn" role="group" aria-label="First group">
            <?php for($i = 0; $i <= ($total_animals/$num_of_animals_per_page); $i++): ?>
               <button type="button" class="btn btn-secondary"><?=$i + 1?></button>
            <?php endfor; ?>
        </div>
    </div>
</div>


<?=template_footer()?>