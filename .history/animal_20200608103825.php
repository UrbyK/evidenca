<?php 
    // check to make sure the id parameter is specified in the URL
    if (isset($_GET['id'])){
        // prepare statement and execute, prevents SQL injection
        $stmt = $pdo->prepare('SELECT * FROM animals a INNER JOIN photos p 
        ON a.idanimals = p.fk_idanimals WHERE a.idanimals = ?');
        $stmt->execute([$_GET['id']]);
        // fetch from database, return as an array
        $animal = $stmt->fetch(PDO::FETCH_ASSOC);
        // check if product exist (array not empty)
        if (!$animal){
            // Simple error ro display id the id doen't exist/ is empty
            die('Animal does not exist!');
        }

    } else {
        // simple error if ID wasn't specified
        die('Animal ID was not specified!');
    }

?>

<?=template_header("Žival")?>
<div class="row">
    <div class="col-12 col-sm-7 col-md-6 col-lg-4 col-xl-5 animal">
        <img src="./<?=$animal['url']?>" alt="<?=$animal['url']?>" style="max-width:350px; height:auto;">
    </div>
    <div class="col-12 col-sm-5 col-md-6 col-lg-8 col-xl-7">
        <div class=""
        <h1><?=$animal['name']?></h1>
        
        <!-- Description of product -->
        <div class="description">
            <?=$animal['ear_tag']?>
        </div>
    </div>
</div>

<?=template_footer()?>
