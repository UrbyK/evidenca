<!DOCTYPE htmL>
<html>
    <head>
        <meta charset="utf-8" content="text/html">
        <meta name="viewport" content="width=device-width, initi">

    <!-- JAVASCRIPT -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js" 
        integrity="sha256-eiohPQlDytO6qQO+k+xX6LyVgfXcTzlPCy9t/VjceYo=" 
        crossorigin="anonymous"></script>

    <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.js" 
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" 
        crossorigin="anonymous"></script>

    <!-- BOOTSTRAP -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
        crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" 
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" 
        integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" 
        crossorigin="anonymous"></script>
            
    <!-- FONT AWSEMOE -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"
        integrity="sha256-MAgcygDRahs+F/Nk5Vz387whB4kSK9NXlDN3w58LLq0=" crossorigin="anonymous"></script>
        
    <!-- CSS -->
        <link rel="stylesheet" href="./css/style.css">

    <!-- Active menu item -->
        <script src="./js/active-menu.js" crossorigin="anonymous"></script>

    </head>

    <body>
        <header>
            <div class="banner"><img src="./DB/img/animal-banner.png" alt="banner"><!--<img src="https://via.placeholder.com/1900x250" alt="banner">--></div>
        </header>
        
       <!-- <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light ">-->
        <nav class="navbar sticky-top navbar-expand-lg">
            <a class="navbar-brand" href="./index.php">Evidenca živali</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="dropbtn">Živalis</button>
                            <div class="dropdown-content">
                                <a class="nav-link" href="./index.php?page=animals">Vse živali</a>
                                <a href="#">Govedo</a>
                                <a href="#">Koze</a>
                                <a href="#">Ovce</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="dropbtn"><i class="fas fa-user"></i> Uporabnik</button>
                            <div class="dropdown-content">
                                <?php if(empty($_SESSION['user_id'])): ?>
                                    <a class="nav-link" href="./index.php?page=login" title="Login"><i class="fas fa-sign-in-alt"></i></i> Prijava</a>
                                    <a class="nav-link" href="./index.php?page=register" title="Register"><i class="fas fa-user-plus"></i> Registracija</a>
                                <?php endif; ?>
                                <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
                                    <a class="nav-link" href="./index.php?page=profile" title="Profil"><i class="fas fa-address-card"></i> Profil</a>
                                    <a class="nav-link" href="./index.php?page=animal-add" title="Dodaj žival">Dodaj žival</a>
                                    <a class="nav-link" href="./index.php?page=logout" title="Logout"><i class="fas fa-sign-out-alt"></i> Izpis</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

    <div class="container-fluid">