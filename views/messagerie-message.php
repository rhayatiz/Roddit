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
            <div class="px-3 pb-1 h5 font-weight-light border-bottom font-weight-bold">Sujet : <?= $message->subject ?></div>
            <div class="conversation-wrapper px-3">
                <?php if(count($message->previousMessages)>0){
                    foreach($message->previousMessages as $message){ ?>
                        <div class="older message-sent text-justify message col-7 <?= $message->sender_id == $Auth->id ? 'ml-auto text-right' : '' ?>">
                            <div class="font-weight-light message-date" style="font-size:.875rem">— <?= $message->created_at ?></div>
                            <div class="message" style="font-size: .925rem">
                                <?= $message->body ?>
                            </div>
                        </div>
                <?php }
                } 
                ?>
                <div class="OG message col-7">
                    <div class="font-weight-light message-date" style="font-size:.875rem">— <?= $message->created_at ?></div>
                    <div class="message" style="font-size: .925rem">
                        <?= $message->body ?>
                    </div>
                </div>
            </div>
        </main>

        <input type="hidden" id="parent-message-id" value="<?= $message->id ?>">
        <input type="hidden" id="sender-id" value="<?= $message->sender_id ?>">

        <section id="reply-wrapper" class="px-3">
            <div class="h5 font-weight-light mb-3">Répondre</div>
            <div class="form-group d-flex mb-0">
                <textarea id="reply-textarea" onkeyup="checkReplyLength()" class="form-control" name="" id="" cols="30" rows="5"></textarea>
                <button id="reply-btn" disabled="true" onclick="sendNewMessage()" class="ml-2 btn btn-info">Send</button>
            </div>
        </section>
    </div>
</div>



<?php include('shared/messagerie-footer.php');?>
<script>
    function checkReplyLength(){
        if($('#reply-textarea').val().length > 0){
            $('#reply-btn').prop('disabled',false);  
        }else{
            $('#reply-btn').prop('disabled',true);  
        }
    }

    function sendNewMessage(){
        let reply = $('#reply-textarea').val();
        let sender_id = $('#sender-id').val();
        let parent_id = $('#parent-message-id').val();
        console.log(reply, sender_id, parent_id);
        $.ajax({
            method: 'POST',          //La méthode cible (POST ou GET)
            url : 'api/messages/index.php', //Script Cible
            dataType: 'json',
            data: {
                recipient_id: sender_id,
                parent_id: parent_id,
                body: reply
            },
            success:function(response) {
                console.log(response);
                // messages = response.data;
                // renderMessages();
            },
            error:function(err){
                console.log(err);
            }
        });
    }
    /********************************************
     *
     ************ Document ready *****************
    *
    ********************************************/
    $(document).ready(function() {
    });
</script>