<?php 
$page = 'inbox';
require('shared/messagerie-header.php');
?>
<div class="col p-0 h-100" style="overflow:hidden">
    <div class="wrapper h-100">
        <div class="row menu border-bottom p-2">
            <div class="col-1 ml-1">
                <div class="btn">
                    <input type="checkbox" onclick="selectAllMessages(this)" style="transform: scale(1.5);">
                </div>
            </div>
            <div class="col-1">
                <button class="btn" onclick="loadMessages()">
                    <i class="fas fa-sync" style="font-size:24px"></i>
                </button>
            </div>
            <div class="col-1">
                <button class="btn" onclick="">
                    <i class="fas fa-trash-alt" style="font-size:24px"></i>
                </button>
            </div>
        </div>

        
        <main class="h-100" style="">
                <!-- Spinner (chargement) -->
                <div id="spinner" class="" style="height:100%">
                    <div class="wrapper-spinner">
                    <div class="spinner">
                            <div class="spinner-1"></div>
                            <div class="spinner-2"></div>
                            <div class="spinner-3"></div>
                        </div>
                    </div>
                </div>
                <!-- Cas Aucun message -->
                <div id="no-messages" class="d-none mt-3 text-center h4 font-weight-light">Aucun message...</div>

                <div id="messages" class="d-none">

                </div>
        </main>
    </div>
</div>



<?php include('shared/messagerie-footer.php');?>
<script>
    var messages = [];
    //chercher les messages
    function loadMessages(){
        $('#spinner').removeClass('d-none');
        $('#messages').addClass('d-none');
        $('#no-messages').addClass('d-none');

        $.ajax({
            type: 'GET',          //La méthode cible (POST ou GET)
            url : 'api/messages/index.php', //Script Cible
            dataType: 'json',
            success:function(response) {
                messages = response.data;
                renderMessages();
            },
        });
    }

    function renderMessages(){
        if(messages.length == 0){
            $('#no-messages').removeClass('d-none');
        }else{
            $('#messages').removeClass('d-none');
            var wrapper = document.getElementById('messages');
            wrapper.innerHTML = '';
            messages.forEach(message => {
                wrapper.innerHTML += messageCardTemplate(message);
            });
        }
        $('#spinner').addClass('d-none');
    }

    function messageCardTemplate(message){
        let el = `
        <div class="col-12 d-flex message-wrapper py-2 border-bottom ${message.is_read == 0 ? 'message-not-read' : ''}">
            <div class="d-flex no-click">
                <input class="message-checkbox mx-2" data-message-id="${message.id}" type="checkbox" class="mr-3 my-auto" style="transform:scale(1.5)">
            </div>
            <div>
                <a href="index.php?page=message&id=${message.id}" aria-current="page">
                    <div class="ml-4">
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">${message.subject}</span>
                            <span class="text-secondary font-weight-light">${message.created_at}</span>
                        </div>
                        <div class="font-weight-light">De : ${message.sender}</div>
                        <div class="message-preview text-secondary">
                            ${message.body}
                        </div>
                    </div>
                </a>
            </div>
        </div>
        `;
        return el;
    }

    function selectAllMessages(e){
        $('.message-checkbox').each(function(){
            $(this)[0].checked = e.checked;
        })
    }

    /********************************************
     *
     ************ Document ready *****************
    *
    ********************************************/
    $(document).ready(function() {
        loadMessages();
    });
</script>