
<nav class="navbar navbar-expand-md navbar-dark bg-white shadow fixed-top">
    <div class="container">
        <a id="logo" class="navbar-brand text-dark mr-5" href="index.php">Roddit</a>
        
        <div class="row d-flex">
            <?php if(Auth::user() != null){ //Utilisateur connecté ?>
                <div class="user-img mr-2">
                    <img src="./img/1/pppalall.png" alt="">
                </div>

                <a class="my-auto text-secondary ml-auto mr-2 underline-none"><?= Auth::user()->username ?></a>

                <a class="my-auto ml-1 d-flex" href="index.php?page=logout">
                    <i style="font-size:1.3rem" class="fas fa-sign-out-alt text-dark my-auto"></i>
                </a>
            <?php }else{ //Utilisateur non connecté ?>
                <a class="ml-auto btn btn-sm btn-primary" href="index.php?page=login">Connexion</a>
            <?php } ?>
            
        </div>

    </div>
</nav>