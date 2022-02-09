<?php 
$page = 'inbox';
require('shared/messagerie-header.php');
?>
<div class="col p-0 h-100" style="overflow:hidden">
    <div class="wrapper h-100">
        <div class="row menu border-bottom px-3 py-2">
            <a class="col d-flex" href="index.php?page=messages-inbox">
                <i class="fa fa-arrow-left" style="font-size:24px"></i>
                <span class="ml-2">Retour</span>
            </a>
        </div>

        
        <main class="pb-3 pt-1" style="height: calc(100% - 253px);overflow-y:auto">
            <div class="px-3 pb-1 h5 font-weight-light border-bottom">Sujet : <?= $message->subject ?></div>
            <div class="conversation-wrapper px-3">
                <div class="font-weight-light message-date" style="font-size:.875rem">— <?= $message->created_at ?></div>
                <div class="message" style="font-size: .925rem">
                    <?= $message->body ?>
                </div>
            </div>
        </main>

        <section id="reply-wrapper" class="px-3">
            <div class="h5 font-weight-light mb-3">Répondre</div>
            <div class="form-group d-flex mb-0">
                <textarea id="reply-textarea" class="form-control" name="" id="" cols="30" rows="5"></textarea>
                <button class="ml-2 btn btn-info">Send</button>
            </div>
        </section>
    </div>
</div>



<?php include('shared/messagerie-footer.php');?>
<script>

    /********************************************
     *
     ************ Document ready *****************
    *
    ********************************************/
    $(document).ready(function() {
    });
</script>