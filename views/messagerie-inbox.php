<?php 
$page = 'inbox';
require('shared/messagerie-header.php');
?>
<div class="col p-0 h-100" style="overflow:hidden">
    <div class="wrapper p-2 h-100">
        <div class="row menu border-bottom pb-2">
            <div class="col-1 mx-2"><input type="checkbox" onclick="selectAllMessages(this)" style="transform: scale(1.5);"></div>
            <div class="col-1"><i class="fas fa-sync" style="font-size:24px"></i></div>
            <div class="col-1"><i class="fas fa-trash-alt" style="font-size:24px"></i></div>
        </div>

        
        <main class="h-100" style="">
            <div class="row">
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
            </div>
        </main>
    </div>
</div>



<?php include('shared/messagerie-footer.php');?>
<script>
    var messages = [];
    //chercher les messages
    function fetchMessages(){
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
        console.log('renderMessages');
        console.log(messages);
        if(messages.length == 0){
            $('#spinner').addClass('d-none');
            $('#no-messages').removeClass('d-none');
        }else{
            console.log('here');
            $('#spinner').addClass('d-none');
            $('#messages').removeClass('d-none');
            var wrapper = document.getElementById('messages');
            messages.forEach(message => {
                console.log(message.is_read);
                wrapper.innerHTML += messageCardTemplate(message);
            });
        }
    }

    function messageCardTemplate(message){
        let el = `
        <div class="col-12 d-flex message-wrapper py-2 border-bottom ${message.is_read == 0 ? 'message-not-read' : ''}">
            <div class="d-flex no-click">
                <input class="message-checkbox mx-2" data-message-id="${message.id}" type="checkbox" class="mr-3 my-auto" style="transform:scale(1.5)">
            </div>
            <div>
                <a href="#" target="_blank" aria-current="page">
                    <div class="ml-4">
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">${message.subject}</span>
                            <span class="text-secondary font-weight-light">${message.created_at}</span>
                        </div>
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
            console.log($(this));
            $(this)[0].checked = e.checked;
        })
    }
    /********************************************
     *
     ************ Document ready *****************
    *
    ********************************************/
    $(document).ready(function() {
        fetchMessages();
    });
</script>