<?php 
    // check to make sure the id parameter is specified in the URL
    if (isset($_GET['id'])){
        // prepare statement and execute, prevents SQL injection
        $stmt = $pdo->prepare('SELECT * FROM animals a INNER JOIN photos p 
        ON a.idanimals = p.fk_idanimals WHERE p.idphotos = ?');
        $stmt->execute([$_GET['id']]);
        // fetch from database, return as an array
        $animal = $stmt->fetch(PDO::FETCH_ASSOC);
        // check if product exist (array not empty)
        if (!$animal){
            // Simple error ro display id the id doen't exist/ is empty
            die('Product does not exist!');
        }

    } else {
        // simple error if ID wasn't specified
        die('Product ID was not specified!');
    }

?>
<?=template_header("Žival")?>
<?=template_footer()?>
