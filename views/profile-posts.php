<?php include('shared/header.php');?>

<style>
  .post-title {
    background-color: #d9d9d9;
    color: #000;
  }
  .post-body {
    max-height: 80px;
    overflow: hidden;
    background-color: #f7f7f7;
    color: #141414;
  }
  .no-hover-decoration:hover{
    text-decoration: none !important;
  }
</style>

<div style="margin-top:80px; min-height:calc(100vh - 46px - 80px - 10px) !important;" class="container mx-auto">
<h4 class="ml-3 my-3 font-weight-light">Profil de <?= $user->username ?></h4>

<ul class="profile-nav nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="#">Posts</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="?page=profile&user=<?= $_GET['user'] ?>&show=comments">Commentaires</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="?page=profile&user=<?= $_GET['user'] ?>&show=likes">Likes</a>
  </li>
</ul>

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