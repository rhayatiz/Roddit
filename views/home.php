<?php
 include('shared/head.php');
?>

<nav class="navbar navbar-expand-md navbar-dark bg-white shadow fixed-top">
    <div class="container">
        <a class="navbar-brand abs text-dark mr-5" href="index.php">Roddit</a>
        
        <div>
            <a class="ml-auto btn btn-primary" href="index.php?page=login">Connexion</a>
        </div>

    </div>
</nav>



<div style="margin-top:100px" class="container mx-auto">
    <div class="row mx-auto" data-masonry='{"percentPosition": true }'>

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
</div>


</div>

<?php include('shared/footer.php'); ?>