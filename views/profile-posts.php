<?php include('shared/header.php');?>
    <?php include('profile-header.php') ?>

    <div class="row mx-auto">
        <div class="col-12 mb-2">

            <?php if(count($posts) == 0 ){ ?>
              <div class="text-center mt-3">Aucun post pour le moment</div>
            <?php }else{ ?>
              <?php foreach($posts as $post){ ?>

                <a href="?page=post&id=<?= $post->id ?>" class="no-hover-decoration">
                  <div class="row mt-4 shadow-sm rounded overflow-hidden">
                    <div class="col-12 font-weight-bold py-2 post-title"><?= $post->title ?></div>
                    <div class="col-12 font-weight-light py-1 post-body"><?= $post->body ?></div>
                  </div>
                </a>

              <?php } ?>
            <?php } ?>

        </div>
    </div>
</div>
</div>

<?php include('shared/footer.php'); ?>