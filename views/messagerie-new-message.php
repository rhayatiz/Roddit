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
                    <ul></ul>
                </div>
        </div>
    </div>
    <!-- Fin destinataire -->
    <input class="form-control p-4" type="text" placeholder="Sujet">
    <textarea class="form-control mt-2" name="" id="" cols="30" rows="10"></textarea>

    <button class="btn btn-sm btn-primary w-100 mt-2">Envoyer</button>

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

    suggestions.addEventListener('click', useSuggestion);
</script>

