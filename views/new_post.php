<?php include('shared/header.php');?>

<div class="card">
	<div class="card-header">form</div>
	<div class="card-body">
		<form method="POST" action="index.php?page=creatPost">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input required type="text" class="form-control" name="titre" id="titre" placeholder="Votre titre...">
            </div>

            <div class="form-group">
                <label for="post">Post</label>
                <textarea required onkeyup="countChar(this)" class="form-control" rows="9" name="postText" id="post" maxlength="5000"></textarea>
                <div><a id="charNum"></a>/5000</div>
            </div>
            <button type="submit" class="btn btn-warning" name="postForm">Créer</button>
		</form>
	</div>
</div>
<?php include('shared/footer.php'); ?>

<script>
    function countChar(val) 
    {
        var len = val.value.length;
        $('#charNum').text( len);
    };
</script>