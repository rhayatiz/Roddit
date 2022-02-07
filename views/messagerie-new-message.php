<?php 
$page = 'new-message';
require('shared/messagerie-header.php');
?>

<div class="form-group row m-2">
    <h4>Nouveau message</h4>
    <input class="form-control p-4" type="text" placeholder="Destinataire ...">
    <input class="form-control p-4 mt-2" type="text" placeholder="Sujet">
    <textarea class="form-control mt-2" name="" id="" cols="30" rows="10"></textarea>

    <button class="btn btn-sm btn-primary w-100 mt-2">Envoyer</button>

</div>
<?php include('shared/messagerie-footer.php');?>

