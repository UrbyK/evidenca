<?php 
    $num_of_animals_per_page = 10;

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
        <div class="card col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="hvrbox">
            <a href="./index.php?page=animal&id=<?=$animal['idanimals']?>">
                <img src="<?=$animal['url']?>" alt="<?=$animal['caption']?>"
                    class="card-img-top hvrbox-layer_bottom img-thumbnail">
                    <div class="hvrbox-layer_top hvrbox-layer_slideup">
                        <p class="hvrbox-text"><?=$animal['summary']?></p>
                    </div>
            </a>
            </div>

        </div>

    <?php endforeach; ?>
</div>


<div class="btn-container">

    <?php if ($current_page > 2): ?>
    <div class="nav-btn btn">
        <a href="./index.php?page=animals&p=<?=1?>"><i class="fa fa-angle-double-left fa-2x"></i></a>
    </div>
    <?php endif; ?>

    <?php if ($current_page > 1): ?>
    <div class="nav-btn btn">
        <a href="./index.php?page=animals&p=<?=$current_page-1?>"><i class="fa fa-chevron-circle-left fa-2x"></i></a>
    </div>
    <?php endif; ?>

    <?php if ($total_animals > ($current_page * $num_of_animals_per_page) - $num_of_animals_per_page + count($animals)): ?>
    <div class="nav-btn btn">
        <a href="./index.php?page=animals&p=<?=$current_page+1?>"><i class="fa fa-chevron-circle-right fa-2x"></i></a>
    </div>
    <?php endif; ?>
    
    <?php if ($total_animals > ($current_page * $num_of_animals_per_page) - $num_of_animals_per_page + count($animals) && $current_page < (ceil($total_animals / $num_of_animals_per_page)-1) ): ?>
    <div class="nav-btn btn">
        <a href="./index.php?page=animals&p=<?=ceil($total_animals / $num_of_animals_per_page)?>"><i class="fa fa-angle-double-right fa-2x"></i></a>
    </div>
    <?php endif; ?>

</div> <!-- btn-container -->

<?=template_footer()?>