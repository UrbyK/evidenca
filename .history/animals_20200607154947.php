<?php 
    $num_of_animals_per_page = 2;

    $current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;


    $query="SELECT * FROM animals a INNER JOIN photos p ON a.idanimals = p.fk_idanimals
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
            <a href="./index.php?page=animal&id=<?=$animal['idproducts']?>">
                <img src="<?=$product['image']?>" alt="<?=$product['name']?>"
                    class="card-img-top hvrbox-layer_bottom img-thumbnail">
                    <div class="hvrbox-layer_top hvrbox-layer_slideup">
                        <p class="hvrbox-text"><?=$product['summary']?></p>
                    </div>
            </a>
            </div>
            <div class="card-body">
                <ul>
                    <li><a href="./index.php?page=product&id=<?=$product['idproducts']?>"><span class="product-name"><?=$product['name']?></span></a></li>
                    <li><span class="price"><?=$product['price']?>&euro;</span></li>
                </ul>
            </div>

            <div class="card-btn">
                
                <form action="./index.php?page=cart" method="post">
                    <input type="number" name="quantity" value="1" min="1" max="<?=$product['currentstock']?>" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?=$product['idproducts']?>">
                    <input type="submit" value="Dodaj v košarico">
                </form>
            </div>
    
        </div>

    <?php endforeach; ?>
</div>

<?=template_footer()?>