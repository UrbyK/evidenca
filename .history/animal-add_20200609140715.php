<?=template_header('Dodaja_zivali')?>

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
                            <label>Ime:</label>
                            <input type="text" name="name" id="name" placholder="Ime živali" required>

                            <label>Ušesna oznaka:</label>
                            <input type="text" name="ear_tag" id="ear_tag" placeholder="SI12594493/SI745165" required maxlength="10">
                        </div>

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
                            <?php $querry = "SELECT * FROM animals a INNER JOIN sex s ON a.fk_idsex=s.idsex WHERE lower(s.tag) = lower('F')";
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
                            <?php $querry = "SELECT * FROM animals a INNER JOIN sex s ON a.fk_idsex=s.idsex WHERE lower(s.tag) = lower('M')";
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

<?=template_footer()?>