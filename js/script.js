

function actionLikePost(idUser, idPost, statut)
{
    $.ajax({
        type: 'POST',          //La méthode cible (POST ou GET)
        url : './index.php?page=like&idUser=' + idUser + '&idPost=' + idPost + '&statut=' + statut, //Script Cible
        dataType: 'json',
        success:function(data) {
            if(data)
            {
                var nbLike = data.nbLike - data.nbDislike;
                changebtnLike(idPost, data.data, nbLike);
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
            data.forEach(function(d) {
                // if(d.nbLike != null && d.nbDislike != null)
                // {
                //     var nbLike = d.nbLike - d.nbDislike;
                // }
                // else if (d.nbLike == null && d.nbDislike != null)
                // {
                //     var nbLike = 0 - d.nbDislike;
                // }
                // else if (d.nbLike != null && d.nbDislike == null)
                // {
                //     var nbLike = d.nbLike - 0;
                // }
                // else
                // {
                //     var nbLike = 0;
                // }
                // console.log(nbLike);
                changebtnLike(d.idPost, d.statut, null);
            });
        },
    });
}

function changebtnLike(idPost, statut, like = "0")
{
    var btnLike = document.querySelector('#btnLike_' + idPost);
    var btnDislike = document.querySelector('#btnDislike_' + idPost);
    var nbLike = document.querySelector('#allLike_' + idPost);

    if(statut == '2')
    {
        if (btnDislike.classList.contains('red')) {
            btnDislike.classList.remove('red');
        }
        btnLike.classList.add('green');
    }
    else if(statut == '1')
    {
        if (btnLike.classList.contains('green')) {
            btnLike.classList.remove('green');
        }
        btnDislike.classList.add('red');
    }
    else if(statut == '0')
    {
        if (btnLike.classList.contains('green')) {
            btnLike.classList.remove('green');
        }
        if (btnDislike.classList.contains('red')) {
            btnDislike.classList.remove('red');
        }
    }

    if (like === undefined) {
        like = 0;
        nbLike.innerHTML = like;
    }
    else if(like == null)
    {

    }
    else
    {
        nbLike.innerHTML = like;
    }




}


// Inbox
function getUnreadMessagesCount(){
    let currentVal = document.getElementById('inbox-unread').textContent;
    $.ajax({
        type: 'GET',          //La méthode cible (POST ou GET)
        url : 'api/messages/index.php?get=unreadCount', //Script Cible
        dataType: 'json',
        success:function(data) {
            if (data.unreadCount != currentVal){
                $('#inbox-unread').text(data.unreadCount);
                $('#inbox-logo').addClass('orange');
            }
        },
    });
}


/********************************************
 *
 ************ Document ready *****************
 *
 ********************************************/
$(document).ready(function() {

    getUnreadMessagesCount();
    const interval = setInterval(function() {
        getUnreadMessagesCount();
    }, 5000);

});
