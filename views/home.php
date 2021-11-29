<?php
 include('shared/head.php');
?>


<nav class="navbar navbar-expand-md navbar-dark bg-white shadow fixed-top">
    <div class="container">
        <a id="logo" class="navbar-brand text-dark mr-5" href="index.php">Roddit</a>
        
        <div class="row d-flex">
            <?php if(isset($_SESSION['user'])){ //Utilisateur connecté ?>
                <div class="user-img mr-2">
                    <img src="./img/1/pppalall.png" alt="">
                </div>

                <a class="my-auto text-secondary ml-auto mr-2 underline-none"><?= Auth::user()->getUsername() ?></a>

                <a class="my-auto ml-1 d-flex" href="index.php?page=logout">
                    <i style="font-size:1.3rem" class="fas fa-sign-out-alt text-dark my-auto"></i>
                </a>
            <?php }else{ //Utilisateur non connecté ?>
                <a class="ml-auto btn btn-sm btn-primary" href="index.php?page=login">Connexion</a>
            <?php } ?>
            
        </div>

    </div>
</nav>



<div style="margin-top:100px" class="container mx-auto">
    <div class="row mx-auto">
        <div class="col-12 col-md-9">
            <?php for ($i=0; $i < 8; $i++) { ?>
            <div class="card mt-3">
                <div class="card-header font-weight-bold">
                    POST N°<?= $i ?>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                    </blockquote>
                </div>
            </div>
            <?php } ?>
        </div>
        
        <?php if(isset($_SESSION['user'])){ //Utilisateur connecté ?>
        <!-- Side nav -->
        <div class="card user-side-card d-none d-md-block col-3">
            <div class="row d-flex mt-1">
                <div class="btn btn-sm btn-outline-secondary mx-auto w-75">
                    <i class="far fa-plus-square mr-1"></i>Posts</div>
            </div>

            <div class="row d-flex mt-1">
                <div class="btn btn-sm btn-outline-secondary mx-auto w-75">
                    <i class="far fa-comment-alt mr-1"></i>Commentaires</div>
            </div>

            <div class="row d-flex mt-1">
                <div class="btn btn-sm btn-outline-secondary mx-auto w-75">
                    <i class="far fa-thumbs-up mr-1"></i>Likes</div>
            </div>

        </div>
        <?php } ?>

    </div>


</div>
</div>

<?php include('shared/footer.php'); ?>