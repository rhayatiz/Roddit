<?php include('shared/header.php');?>
  <?php include('profile-header.php') ?>

  <div class="row mx-auto">
      <div class="col-12">

        <?php if(count($comments) == 0 ){ ?>
              <div class="text-center mt-3">Aucun commentaire pour le moment</div>
        <?php }else{ ?>
              <?php foreach($comments as $comment){ ?>


              <?php } ?>
        <?php } ?>

      </div>
  </div>
</div>
</div>

<?php include('shared/footer.php'); ?>