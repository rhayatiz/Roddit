<?php include('shared/header.php');?>

<div style="margin-top:30px" class="container mx-auto">
    <div class="row mx-auto">
        <div class="col-12 col-md-9">

            <?php foreach ($posts as $post) { ?>
                <div class="card mt-3">
                    <div class="card-header font-weight-bold">
                        <a href="?page=post&id=<?= $post->id ?>">
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
            <?php } ?>

        </div>
        
        <?php if(Auth::user()){ //Utilisateur connecté, side navbar?>
            <!-- Side nav -->
            <div class="card user-side-card d-none d-md-block col-3">
                <div class="row d-flex mt-1">
                    <div class="btn btn-sm btn-outline-secondary mx-auto w-75">
                        <a class="no-link-decoration" href="?page=profile&user=<?= Auth::user()->username ?>&show=posts">
                            <i class="far fa-plus-square mr-1"></i>Posts
                        </a>
                    </div>
                </div>

                <div class="row d-flex mt-1">
                    <div class="btn btn-sm btn-outline-secondary mx-auto w-75">
                        <a class="no-link-decoration" href="?page=profile&user=<?= Auth::user()->username ?>&show=comments">
                            <i class="far fa-comment-alt mr-1"></i>Commentaires
                        </a>
                    </div>
                </div>

                <div class="row d-flex mt-1">
                    <div class="btn btn-sm btn-outline-secondary mx-auto w-75">
                        <a class="no-link-decoration" href="?page=profile&user=<?= Auth::user()->username ?>&show=likes">
                            <i class="far fa-thumbs-up mr-1"></i>Likes
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>


</div>
</div>

<?php include('shared/footer.php'); ?>