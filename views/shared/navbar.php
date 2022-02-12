
<nav class="navbar navbar-expand-md navbar-dark bg-white shadow sticky-top">
    <div class="container">
        <a id="logo" class="navbar-brand text-dark mr-5" href="index.php">Roddit</a>
        
        <div class="row d-flex">
            <?php if($Auth != null){ //Utilisateur connecté ?>
                <div class="text-secondary font-weight-light my-auto mr-4">
                    <a id="btn-messages" href="?page=messages-inbox" class="no-link-decoration">
                        <span>
                            <i id="inbox-logo" class="fas fa-inbox"></i>
                        </span>
                        Messages (<span id="inbox-unread">0</span>)
                    </a>
                </div>


                <div class="user-img mr-1">
                    <a href="?page=profile&user=<?= $Auth->username ?>">
                        <img src="./img/1/pppalall.png" alt="">
                    </a>
                </div>
                <a class="my-auto text-secondary ml-auto mr-4 underline-none" href="?page=profile&user=<?= $Auth->username ?>"><?= $Auth->username ?></a>

                <a class="my-auto ml-1 d-flex" href="index.php?page=logout">
                    <i style="font-size:1.3rem" class="fas fa-sign-out-alt text-dark my-auto"></i>
                </a>
            <?php }else{ //Utilisateur non connecté ?>
                <a class="ml-auto btn btn-sm btn-primary" href="index.php?page=login">Connexion</a>
            <?php } ?>
            
        </div>

    </div>
</nav>