<?php include('shared/header.php');?>


<div style="margin-top:80px; min-height:calc(100vh - 46px - 80px - 10px) !important;" class="container mx-auto">
  <h4 class="ml-3 my-3 font-weight-light">Profil de <?= $user->username ?></h4>

  <ul class="profile-nav nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="?page=profile&user=<?= $_GET['user'] ?>&show=posts">Posts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Commentaires</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="?page=profile&user=<?= $_GET['user'] ?>&show=likes">Likes</a>
    </li>
  </ul>

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