<?php 
    // check to make sure the id parameter is specified in the URL
    if (isset($_GET['id'])){
        // prepare statement and execute, prevents SQL injection
        $stmt = $pdo->prepare('SELECT * FROM animals a LEFT JOIN photos p 
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
    <div class="col-12 col-sm-5 col-md-6 col-lg-8 col-xl-7 animal-info">
        <h1><?=$animal['ear_tag']?> <?=$animal['name']?></h1>
        
        <!-- Description of product -->
        <div class="description">
            
<div class="insert-form my-form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card user-form">
                <div class="card-header">
                    <h1 class="card-title">Vnos živali</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="./inc/animal-insert.inc.php" class="content" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Rojstvo:</label>
                            <input type="date" name="birth" id="birth" required>

                            <label for="breed">Pasma:</label>
                            <?php $querry="SELECT * FROM breeds b INNER JOIN animal_types ani ON b.fk_idanimal_types = ani.idanimal_types";
                                $stmt=$pdo->prepare($querry);
                                $stmt->execute();
                                $breeds = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>
                            <select name="breed" id="breed" required>
                                <?php foreach($breeds as $breed): ?>
                                    <option value="<?=$breed['idbreeds']?>"><?=$breed['type']?>: <?=$breed['breed']?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="sex">Spol:</label>
                            <?php $querry = "SELECT * FROM sex";
                                $stmt = $pdo->prepare($querry);
                                $stmt->execute();
                                $sexs = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>
                            <select name="sex" id="sex" required>
                                <?php foreach($sexs as $sex): ?>
                                <option value="<?=$sex['idsex']?>"><?=$sex['sex']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="mother">Mati:</label>
                            <?php $querry = "SELECT * FROM animals a INNER JOIN sex s ON a.fk_idsex=s.idsex WHERE s.tag = 'F'";
                                $stmt = $pdo->prepare($querry);
                                $stmt->execute();
                                $mothers = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

                            <select name="mother" id="mother">
                                <option value="">N/A</option>
                                <?php foreach($mothers as $mother): ?>
                                    <option value="<?=$mother['idanimals']?>"><?=$mother['ear_tag']?> <?=$mother['name']?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="father">Oče:</label>
                            <?php $querry = "SELECT * FROM animals a INNER JOIN sex s ON a.fk_idsex=s.idsex WHERE s.tag = 'M'";
                                $stmt = $pdo->prepare($querry);
                                $stmt->execute();
                                $fathers = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

                            <select name="father" id="father">
                                <option value="">N/A</option>
                                <?php foreach($fathers as $father): ?>
                                    <option value="<?=$father['idanimals']?>"><?=$father['ear_tag']?> <?=$father['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                                
                        <div class="form-group">
                            <label for="pregnancy">Brejost:</label>
                            <?php $querry="SELECT * FROM pregnancies";
                                $stmt = $pdo->prepare($querry);
                                $stmt->execute();
                                $pregnancies = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>
                            <select name="pregnancy" id="pregnancy">
                                <option value="">N/A</option>
                                    <?php foreach($pregnancies as $pregnancy): ?>
                                        <option value="<?=$pregnancy['idpregnancies']?>"><?=$pregnancy['pregnancy']?></option>
                                    <?php endforeach; ?>
                            </select>

                            <label for="health">Zdravje:</label>
                            <?php $querry="SELECT * FROM health";
                                $stmt = $pdo->prepare($querry);
                                $stmt->execute();
                                $health = $stmt->fetchAll(PDO::FETCH_ASSOC);?>
                            <select name="health" id="health" required>
                                <?php foreach($health as $status): ?>
                                    <option value="<?=$status['idhealth']?>"><?=$status['status']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Slike:</label>
                            <input type="file" name="files" id="files" required>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" name="sub_btn" class="btn btn-primary" id="save" value="Sharni">Shrani</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>

<?=template_footer()?>


