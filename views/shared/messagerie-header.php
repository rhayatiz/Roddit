<?php require_once('header.php');?>
    <style>
    body{
        height: calc(100vh - 46px);
    }
</style>
<div class="h-100">
    <div class="row mx-auto h-100">

            <div class="col-2 bg-light h-100 shadow menu-messagerie" style="z-index:100000">
                <div class="col mb-2 mt-2 p-2 font-weight-light btn-msg-inactive">
                    <?php $color = $page == 'new-message' ? 'btn-primary' : 'btn-secondary' ?>
                    <a class="btn btn-sm <?= $color ?> w-100 rounded-lg" href="?page=messages-new">
                        Nouveau message
                    </a>
                </div>

                
                <div class="col mb-2 mt-2 p-2 font-weight-light btn-msg-inactive">
                    <?php $color = $page == 'inbox' ? 'btn-primary' : 'btn-secondary' ?>
                    <a class="btn btn-sm <?= $color ?> w-100 rounded-lg" href="?page=messages-inbox">
                        Boîte de reception
                    </a>
                </div>

                
                <div class="col mb-2 mt-2 p-2 font-weight-light btn-msg-inactive">
                    <?php $color = $page == 'sent' ? 'btn-primary' : 'btn-secondary' ?>
                    <a class="btn btn-sm <?= $color ?> w-100 rounded-lg" href="?page=messages-sent">
                        Envoyé
                    </a>
                </div>

                
                <div class="col mb-2 mt-2 p-2 font-weight-light btn-msg-inactive">
                    <?php $color = $page == 'deleted' ? 'btn-primary' : 'btn-secondary' ?>
                    <a class="btn btn-sm <?= $color ?> w-100 rounded-lg" href="?page=messages-deleted">
                        Supprimé
                    </a>
                </div>
            </div>
            <div class="col">