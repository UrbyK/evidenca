<?php 



    // check to make sure the id parameter is specified in the URL
    if (isset($_GET['id'])){
        $animal_id = $_GET['id'];
        // prepare statement and execute, prevents SQL injection
        $stmt = $pdo->prepare('SELECT * FROM animals a LEFT JOIN photos p ON a.idanimals = p.fk_idanimals
        INNER JOIN breeds b ON a.fk_idbreeds = b.idbreeds 
        INNER JOIN animal_types aty ON b.fk_idanimal_types = aty.idanimal_types
        INNER JOIN sex s  ON a.fk_idsex = s.idsex 
        LEFT JOIN pregnancies prg ON a.fk_idpregnancies = prg.idpregnancies
        LEFT JOIN users u ON a.fk_idusers = u.idusers
        INNER JOIN health h ON a.fk_idhealth = h.idhealth WHERE a.idanimals = ?');
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

        <div class="description">
            
            <div class="insert-form my-form">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card user-form">
                            <div class="card-header">
                                <h1 class="card-title">Podatki živali</h1>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="./inc/animal-insert.inc.php" class="content" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Lastnik:</label>
                                        <?php $querry = "SELECT * FROM users WHERE idusers ='".$animal['fk_idusers']."' ";
                                            $stmt = $pdo->prepare($querry);
                                            $stmt->execute();
                                            $users = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>
                                        
                                            <?php foreach($users as $user): ?>
                                        <input type="text" name="owner" id="owner" value="<?=$user['fname']?> <?=$user['lname']?>" disabled>
                                            <?php endforeach; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Rojstvo:</label>
                                        <input type="date" name="birth" id="birth" value="<?=$animal['birth']?>" disabled>

                                        <label for="breed">Pasma:</label>
                                        <input type="text" name="breed" id="breed" value="<?=$animal['type']?>: <?=$animal['breed']?>" disabled>

                                        <label for="sex">Spol:</label>
                                        <input type="text" name="sex" id="sex" value="<?=$animal['sex']?>" disabled>

                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="mother">Mati:</label>
                                        <?php $querry = "SELECT * FROM animals a WHERE idanimals ='".$animal['idmother']."' ";
                                            $stmt = $pdo->prepare($querry);
                                            $stmt->execute();
                                            $mothers = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>
                                        
                                            <?php foreach($mothers as $mother): ?>
                                                <input type="text" name="mother" id="mother" value="<?=$mother['ear_tag']?>: <?=$mother['name']?>" disabled>
                                            <?php endforeach; ?>

                                        <label for="father">Oče:</label>
                                        <?php $querry = "SELECT * FROM animals a WHERE idanimals ='".$animal['idfather']."' ";
                                            $stmt = $pdo->prepare($querry);
                                            $stmt->execute();
                                            $fathers = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

                                            <?php foreach($fathers as $father): ?>
                                                <input type="text" name="father" id="father" value="<?=$father['ear_tag']?>: <?=$father['name']?>" disabled>
                                            <?php endforeach; ?>

                                    </div>
                                            
                                    <div class="form-group">
                                        <label for="pregnancy">Brejost:</label>
                                        <?php $querry="SELECT * FROM pregnancies WHERE idpregnancies ='".$animal['fk_idpregnancies']."' ";
                                            $stmt = $pdo->prepare($querry);
                                            $stmt->execute();
                                            $pregnancies = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>
                                                <?php foreach($pregnancies as $pregnancy): ?>
                                                    <input type="text" name="pregnancy" id="pregnancy" value="<?=$pregnancy['pregnancy']?>" disabled>
                                                <?php endforeach; ?>

                                        <label for="health">Zdravje:</label>
                                        <?php $querry="SELECT * FROM health WHERE idhealth = '".$animal['fk_idhealth']."'";
                                            $stmt = $pdo->prepare($querry);
                                            $stmt->execute();
                                            $health = $stmt->fetchAll(PDO::FETCH_ASSOC);?>
                                            <?php foreach($health as $status): ?>
                                                <input type="text" name="health" id="helath" value="<?=$status['status']?>" disabled>
                                            <?php endforeach; ?>
                                    </div>
                                    <?php if(is_admin() || isset($_SESSION['user_id']) == $animal['fk_idusers']): ?>
                                    <div class="col-md-6">
                                       <a href="./index.php?page=animal-edit&id=<?=$animal['idanimals']?>" class="btn btn-primary">Uredi</a>
                                    </div>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="comments">
        <div class="card"> 
                <h3 class="card-title">Komentiraj</h3>
            <div class ="card-body">
                <form action="./inc/comment-insert.inc.php" method="post">
                    <input type="hidden" name="animal_id" value="<?=$animal_id?>" />
                    <select name="rate">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <br />
                    <textarea name="content" cols="18" rows="4" id="styled" placeholder="Komentarji..."></textarea>

                    <input class="btn btn-primary" type="submit" value="Shrani" />
                </form>
            </div>
        </div>
    </div>
</div>
<br />
<div class="container-fluid">
    <div class="row">
        <?php $query = "SELECT c.*, u.username FROM comments c INNER JOIN users u 
        ON c.fk_idusers = u.idusers WHERE c.fk_idanimals = ? ORDER BY c.date_add DESC";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$animal_id]);
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($comments as $comment): ?>
            <div class="col-lg-3 col-md-6 col-sm-9 col-12 acomment">
                <div class="acomment-meta">
                <?=$comment['username']?> @ <?=$comment['date_add']?>
                <?php for($i=0; $i<5; $i++):
                    if($i<$comment['rating']): ?>
                        <span class="fa fa-star checked"></span>
                    <?php else: ?>
                        <span class="fa fa-star"></span>
                    <?php endif; endfor; ?>
                </div>
                <div class="card">
                    <?=$comment['content']?>
                </div>
            </div>
            <?php if($comment['fk_idusers'] == $_SSESSION['user_id'] || is_admin()): ?>
                <button type="submit" name="delete" class="btn btn-primary" id="delete" value="Izbriši">Izbriši</button>
            <?php endif; ?>
            <?php endforeach; ?>
        


    </div>
</div>
<br />

<script>
    $("#delete").click(function(e){
        e.preventDefault();

        var old_pass = $( "#old_pass" ).val();
        var new_pass = $( "#new_pass" ).val();
        var confirm_password = $( "#confirm_password" ).val();

        console.log(old_pass);
        console.log(new_pass);
        console.log(confirm_password);

        $.ajax({
            type: 'POST',
            data: 'old_pass=' + old_pass + '&new_pass=' + new_pass + '&confirm_password=' + confirm_password,
            url:'./inc/user.pass-update.inc.php',
            success:function(data){
                alert(data);
            }

        });



    })
</script>
<?=template_footer()?>


