<?php require('head.php'); ?>
<body>
    <div id="main" class="d-flex flex-row">
    <!-- SIDE BAR -->
    <nav id="nav-secondary" class="text-white">
        <div id="nav-secondary-head">
        <div class="text-center">
            <span class="">Bonjour, <?= $_SESSION['user']['prenom'] ?></span>
        </div>
        </div>
        <div id="nav-secondary-body">
            <div class="nav-secondary-item">
                <i class="far fa-calendar-alt"></i>
                <a href="index.php?page=categories" class="text-white">Catégories</a>
            </div>

            
            <div class="nav-secondary-item" >
                <i class="far fa-list-alt"></i>
                <a href="index.php?page=produits" class="text-white">Produits</a>
            </div>

            <hr class="bg-muted">
            
            <div class="nav-secondary-item">
                <i class="fas fa-shopping-cart"></i>
                <a href="index.php?page=orders" class="text-white">Commandes</a>
            </div>
        </div>
    </nav>
    <!-- SIDE BAR -->
    <div class="main w-100 d-flex flex-column">
        <!-- TOP NAVBAR  -->
        <nav id="nav-main" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="navbar ml-auto my-auto p-0">
                <div class="mt-lg-0 d-flex flew-row">
                    <div class="nav-item">
                        <a class="nav-link" href="index.php?page=logout">Se déconnecter</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- TOP NAVBAR -->