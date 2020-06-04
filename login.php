<?=template_header("Login")?>

<div class="row justify-content-center">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Prijava</h1>
            </div>
            <div class="card-body">
                <form method="post" action="./inc/login.inc.php" class="content">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="username">Uporabniško ime:</label>
                        <div class="col-md-6">
                            <input type="text" name="username" id="username" placeholder="Uporabniško ime" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="password">Geslo:</label>
                        <div class="col-md-6">
                            <input type="password" name="password" id="password" placeholder="Geslo" required>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-4">
                       <button type="submit" name="log_btn" class="btn btn-primary" value="Vpiši se">
                           Prijava
                        </button>
                    </div>

                </form>
            </div>
            <div class="card-footer">
                Nimate računa? Ustvarite ga: <a href="./index.php?page=register">Registracija</a>
            </div>
        </div>
    </div>
</div>

<?=template_footer()?>