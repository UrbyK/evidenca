<?php

?>

<?=template_header("Home")?>
<?php if(!isset($_SESSION['user_id'])): ?>
    <div class="row justify-content-center home-row">
        <div class="card home-card">
            <div class="card-header">
                <h1 class="card-title">Dobrodošli! Dostopate do evidence živali!</h1>
            </div>
            <div class="card-body">
                Dobrodošli, za sodelovanje, ogled se prosim vpišite v svoj račun.
                <p>Če ga nimate ga prosim ustvarite.</p>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row justify-content-center home-row">
        <div class="card home-card">
            <div class="card-header">
                <h1 class="card-title">Dobrodošli! <?=get_user($_SESSION['user_id'])?></h1>
            </div>
            <div class="card-body">
                
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
<?php endif; ?>

<?=template_footer()?>