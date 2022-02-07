<?php include('shared/header.php');?>

<div style="margin-top:30px" class="container mx-auto">
    <div class="row mx-auto">
        <div class="col-12 col-md-9">

            <div class="card mt-3">
                <div class="card-header font-weight-bold">
                    <a href="?post=<?= $post->id ?>">
                        <?= $post->title ?>
                    </a>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <p><?= $post->body ?></p>
                    <footer class="blockquote-footer">Créé le <?= $post->created_at ?> par <cite title="Source Title"><?= $post->created_by ?></cite></footer>
                    </blockquote>
                </div>
            </div>

        </div>

        
        <?php if(Auth::user()){ //Utilisateur connecté, side navbar?>
            <!-- Side nav -->
            <div class="card user-side-card d-none d-md-block col-3">
                <div class="row d-flex mt-1">
                    <div class="btn btn-sm btn-outline-secondary mx-auto w-75">
                        <a class="no-link-decoration" href="?page=posts"><i class="far fa-plus-square mr-1"></i>Posts</a>
                    </div>
                </div>

                <div class="row d-flex mt-1">
                    <div class="btn btn-sm btn-outline-secondary mx-auto w-75">
                        <a class="no-link-decoration" href="?page=comments"><i class="far fa-comment-alt mr-1"></i>Commentaires</a>
                    </div>
                </div>

                <div class="row d-flex mt-1">
                    <div class="btn btn-sm btn-outline-secondary mx-auto w-75">
                        <a class="no-link-decoration" href="?page=likes"><i class="far fa-thumbs-up mr-1"></i>Likes</a>
                    </div>
                </div>
            </div>
        <?php } ?>

        
        <div class="col-12 col-md-9">
            <ul>
                <li>comment 1</li>
                <li>comment 2</li>
                <li>comment 3</li>
                <li>comment 4</li>
            </ul>
        </div>

    </div>


</div>
</div>

<?php include('shared/footer.php'); ?>