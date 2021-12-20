var btnLike = document.querySelector('#btnLike');
var btnDislike = document.querySelector('#btnDislike');

function actionLikePost(idUser, idPost, statut)
{
    $.ajax({
        type: 'POST',          //La méthode cible (POST ou GET)
        url : './index.php?page=like&idUser=' + idUser + '&idPost=' + idPost + '&statut=' + statut, //Script Cible
        dataType: 'json',
        success:function(data) {
            var msg = JSON.parse(JSON.stringify(data));
            console.log(msg);
            console.log(msg.data);
            if(msg.data == 1)
            {
                console.log('lol');
            }
            else
            {
                console.log('rip');
            }
        },
    });
}

function getAllLikePostByUser(idUser, statut)
{
    $.ajax({
        type: 'POST',          //La méthode cible (POST ou GET)
        url : './index.php?page=like&idUser=' + idUser + '&statut=' + statut, //Script Cible
        dataType: 'json',
        success:function(data) {
            var msg = JSON.parse(JSON.stringify(data));
            console.log(msg);
            console.log(msg.data);
            if(msg.data == 1)
            {
                console.log('lol');
            }
            else
            {
                console.log('rip');
            }
        },
    });
}



btnLike.addEventListener('click', function() {

    if (btnLike.classList.contains('red')) {
        btnDislike.classList.remove('red');
    }
    this.classList.toggle('green');

});

btnDislike.addEventListener('click', function() {

    if (btnLike.classList.contains('green')) {
        btnLike.classList.remove('green');
    }
    this.classList.toggle('red');

});

