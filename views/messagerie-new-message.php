<?php 
$page = 'new-message';
require('shared/messagerie-header.php');
?>

<div class="form-group row m-2">
    <h4>Nouveau message</h4>
    <!-- Destinataire -->
    <div class="col-12 p-0">
        <div class="form-group">
            <input class="form-control p-4" type="text" name="destinataire" id="userSearch" placeholder="Destinataire ...">
                <div class="suggestions">
                    <ul class="suggestion"></ul>
                </div>
                <input type="hidden" id="destinataireId" name="destinataireId" value="">
        </div>
    </div>
    <!-- Fin destinataire -->
    <input class="form-control p-4" type="text" placeholder="Sujet" id="subject">
    <textarea class="form-control mt-2" rows="10" id="message"></textarea>

    <span id="errorInputs" class="d-none col-12 px-0 text-danger font-weight-small" style="font-size:12px">Veuillez renseigner tout les champs</span>
    <button onclick="sendMessage()"class="btn btn-sm btn-primary w-100 mt-2">Envoyer</button>

</div>
<?php include('shared/messagerie-footer.php');?>
<script>
    var users = [];
    function fetchUsers(){
    fetch("api/users")
        .then(res => res.json())
        .then(data => users = data);
    };
    fetchUsers();
    const input = document.querySelector('#userSearch');
    const suggestions = document.querySelector('.suggestions ul');


    function search(str) {
        let results = [];
        const val = str.toLowerCase();
        for (i = 0; i < users.length; i++) {
            if (users[i]['username'].toLowerCase().indexOf(val) > -1) {
                results.push(users[i]['username']);
            }
        }
        return results;
    }

    function getUserId(str){
        const val = str.toLowerCase();
        for (i = 0; i < users.length; i++) {
            if (users[i]['username'].toLowerCase().indexOf(val) > -1) {
                return users[i]['id'];
            }
        }
    }

    function searchHandler(e) {
        const inputVal = e.currentTarget.value;
        let results = [];
        if (inputVal.length > 0) {
            results = search(inputVal);
        }
        showSuggestions(results, inputVal);
    }

    function showSuggestions(results, inputVal) {
        suggestions.innerHTML = '';
        if (results.length > 0) {
            for (i = 0; i < results.length; i++) {
                let item = results[i];
                // Highlights only the first match
                // TODO: highlight all matches
                const match = item.match(new RegExp(inputVal, 'i'));
                item = item.replace(match[0], `<strong>${match[0]}</strong>`);
                suggestions.innerHTML += `<li>${item}</li>`;
            }
            suggestions.classList.add('has-suggestions');
        } else {
            results = [];
            suggestions.innerHTML = '';
            suggestions.classList.remove('has-suggestions');
        }
    }

    function useSuggestion(e) {
        input.value = e.target.innerText;
        input.focus();
        suggestions.innerHTML = '';
        suggestions.classList.remove('has-suggestions');
        // Mettre l'id de l'utilisateur dans l'input caché destinataireId
        $("#destinataireId").val(getUserId(e.target.innerText))
    }
    
    // attendre un peu avant de charger les suggestions
    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
            callback.apply(context, args);
            }, ms || 0);
        };
    }
    $("#userSearch").keyup(
        delay(function (e) {
        searchHandler(e);
        }, 150)
    );

    function validateForm(){
        let destinataireId = $('#destinataireId').val();
        let subject = $('#subject').val();
        let message = $('#message').val();

        if(destinataireId == "" ||
            subject == "" ||
            message == ""){
                if(destinataireId == ""){
                    $('#userSearch').addClass('is-invalid');
                }else{
                    $('#userSearch').removeClass('is-invalid');
                }
                
                if(subject == ""){
                    $('#subject').addClass('is-invalid');
                }else{
                    $('#subject').removeClass('is-invalid');
                }
                
                if(message == ""){
                    $('#message').addClass('is-invalid');
                }else{
                    $('#message').removeClass('is-invalid');
                }
            return false;
        }else{
            return data =
                {
                    "destinataireId": destinataireId,
                    "subject": subject,
                    "message": message
                }
        }
    }

    function sendMessage(){
        if(data = validateForm()){
            // Envoyer le message
            console.log('sending message');
            console.log(data);
        }else{
            $("#errorInputs").removeClass('d-none');
        }
    }

    suggestions.addEventListener('click', useSuggestion);
</script>

