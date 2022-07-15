<?php

$posts = $result["data"]['posts'];

?>

<form action="index.php?ctrl=forum&action=updatePost&id=<?= $posts->getId() ?>" method="POST">
    <div class="col-md-4 mb-3">
        <label for="content">Modifier le commentaire : </label>
        <textarea class="form-control" id="content" name="content" placeholder="Modifier votre message"></textarea>
    </div>
    <input type="submit" value="Valider" class="btn btn-lg btn-primary">
</form>