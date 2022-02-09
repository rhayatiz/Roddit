<?php include('shared/header.php'); ?>

<div style="margin-top:100px" class="container mx-auto">
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


        <?php if (Auth::user()) { //Utilisateur connecté, side navbar
        ?>
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
            <ul class="container">
                <?php
                foreach ($post->remarks as $remark) {
                ?>
                    <div class="comment col-12 text-justify float-left row" style="border-style: none; box-shadow: 10px 5px 5px #B6B6B6; margin: 10px;"> <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                        <h4 class="col-6"><?php echo $remark->user->nom; ?> <?php echo $remark->user->prenom; ?></h4> <span class="col-5 d-flex justify-content-end">- <?php echo $remark->date; ?></span> <br>
                        <p class="col-12"><?php echo $remark->remark; ?></p>
                    </div>
                <?php
                }
                ?>
            </ul>
            <div class="md-form" style="margin: 10px;">
                <i class="fas fa-pencil-alt prefix"></i>
                <label for="remark">Ajouter un commentaire</label>
                <textarea id="remark" class="md-textarea form-control" rows="3"></textarea>
                <button onclick="sendRemark()">Envoyer</button>
            </div>
        </div>

    </div>


</div>
</div>

<script>
    function sendRemark() {
        var remark = document.getElementById("remark").value;
        var param = JSON.stringify({
            'remark': remark
        });
        $.ajax({
            type: "POST",
            url: "index.php?page=post&action=postRemark",
            dataType: 'json',
            data: {
                PARAM: param
            },
            success: function(retour) {
            }
        });
    }
</script>

<?php include('shared/footer.php'); ?>