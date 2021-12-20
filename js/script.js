

function actionLikePost(idUser, idPost, statut)
{
    $.ajax({
        type: 'POST',          //La méthode cible (POST ou GET)
        url : './index.php?page=like&idUser=' + idUser + '&idPost=' + idPost + '&statut=' + statut, //Script Cible
        dataType: 'json',
        success:function(data) {
            if(data)
            {
                var btnLike = document.querySelector('#btnLike_' + idPost);
                var btnDislike = document.querySelector('#btnDislike_' + idPost);
                console.log(data.data)
                if(data.data == '2')
                {
                    if (btnDislike.classList.contains('red')) {
                        btnDislike.classList.remove('red');
                    }
                    btnLike.classList.add('green');
                }
                else if(data.data == '1')
                {
                    if (btnLike.classList.contains('green')) {
                        btnLike.classList.remove('green');
                    }
                    btnDislike.classList.add('red');
                }
                else if(data.data == '0')
                {
                    if (btnLike.classList.contains('green')) {
                        btnLike.classList.remove('green');
                    }
                    if (btnDislike.classList.contains('red')) {
                        btnDislike.classList.remove('red');
                    }
                }
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
                // code
                console.log(d);
                var btnLike = document.querySelector('#btnLike_' + d.idPost);
                var btnDislike = document.querySelector('#btnDislike_' + d.idPost);

                if(d.statut == '2')
                {
                    if (btnDislike.classList.contains('red')) {
                        btnDislike.classList.remove('red');
                    }
                    btnLike.classList.add('green');
                }
                else if(d.statut == '1')
                {
                    if (btnLike.classList.contains('green')) {
                        btnLike.classList.remove('green');
                    }
                    btnDislike.classList.add('red');
                }
                else if(d.statut == '0')
                {
                    if (btnLike.classList.contains('green')) {
                        btnLike.classList.remove('green');
                    }
                    if (btnDislike.classList.contains('red')) {
                        btnDislike.classList.remove('red');
                    }
                }
            });
        },
    });
}

// if (btnLike !== null)
// {
//     btnLike.addEventListener('click', function() {
//
//         if (btnLike.classList.contains('red')) {
//             btnDislike.classList.remove('red');
//         }
//         this.classList.toggle('green');
//     });
// }
//
// if (btnDislike !== null)
// {
//     btnDislike.addEventListener('click', function() {
//
//         if (btnLike.classList.contains('green')) {
//             btnLike.classList.remove('green');
//         }
//         this.classList.toggle('red');
//
//     });
// }




