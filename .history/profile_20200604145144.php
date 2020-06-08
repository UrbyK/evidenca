<?php
    if(!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])){
        echo "<script type='text/javascript'> document.location = './index.php?page=login'; </script>";
        exit();
    }

?>

<?=template_header("Profile")?>
<h1>HELP ME</h1>
<?=template_footer();