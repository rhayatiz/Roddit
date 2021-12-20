<h4 class="ml-3 my-3 font-weight-light">Profil de <?= $user->username ?></h4>

<ul class="profile-nav nav nav-tabs">

  <li class="nav-item">
    <?php if($page == 'posts'){?>
        <a class="nav-link active" href="#">Posts</a>
      <?php }else{ ?>
        <a class="nav-link" href="?page=profile&user=<?= $_GET['user'] ?>&show=posts">Posts</a>
    <?php } ?>
  </li>

  <li class="nav-item">
    <?php if($page == 'comments'){?>
        <a class="nav-link active" href="#">Commentaires</a>
      <?php }else{ ?>
        <a class="nav-link" href="?page=profile&user=<?= $_GET['user'] ?>&show=comments">Commentaires</a>
    <?php } ?>
  </li>

  <li class="nav-item">
    <?php if($page == 'likes'){?>
        <a class="nav-link active" href="#">Likes</a>
      <?php }else{ ?>
        <a class="nav-link" href="?page=profile&user=<?= $_GET['user'] ?>&show=likes">Likes</a>
    <?php } ?>
  </li>
</ul>