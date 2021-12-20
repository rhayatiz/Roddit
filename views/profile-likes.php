<?php include('shared/header.php');?>
    <?php include('profile-header.php') ?>

    <div class="row mx-auto">
        <div class="col-12">

        <?php if(count($likes) == 0 ){ ?>
              <div class="text-center mt-3">Aucun like pour le moment</div>
        <?php }else{ ?>
              <?php foreach($likes as $like){ ?>

                <a href="?page=post&id=<?= $like->id ?>" class="no-hover-decoration">
                  <div class="row mt-4 shadow-sm rounded overflow-hidden">
                    <div class="col-12 font-weight-bold py-2 post-title"><?= $like->title ?></div>
                    <div class="col-12 font-weight-light py-1 post-body"><?= $like->body ?></div>
                  </div>
                </a>

              <?php } ?>
        <?php } ?>

        </div>
    </div>
</div>
</div>

<?php include('shared/footer.php'); ?>