function actionLikePost(idUser, idPost, statut)
{
    console.log(idUser, idPost);
    $.ajax({
        type: 'POST',          //La méthode cible (POST ou GET)
        url : './index.php?page=like&idUser=' + idUser + '&idPost=' + idPost + '&statut=' + statut, //Script Cible
        success:function(data) {
            console.log(data);
        },
    });
}

var btnLike = document.querySelector('#btnLike');
var btnDislike = document.querySelector('#btnDislike');

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

