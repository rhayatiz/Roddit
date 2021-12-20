<?php include('shared/header.php');?>



<div style="margin-top:80px; min-height:calc(100vh - 46px - 80px - 10px) !important;" class="container mx-auto">

    <?php include('profile-header.php') ?>

    <div class="row mx-auto">
        <div class="col-12">

        <?php if(count($likes) == 0 ){ ?>
              <div class="text-center mt-3">Aucun like pour le moment</div>
        <?php }else{ ?>
              <?php foreach($likes as $like){ ?>


              <?php } ?>
        <?php } ?>

        </div>
    </div>
</div>
</div>

<?php include('shared/footer.php'); ?>