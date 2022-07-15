<?php

$topics = $result["data"]['topic'];
$posts = $result["data"]['posts'];

?>

<!-- affiche les détails du topic -->
<div class="card border-primary mb-3">
    <div class="card-header">
        <h1 class="card-title"> <?= $topics->getTitle() ?> </h1>
        <p>Catégorie : <a href="index.php?ctrl=forum&action=topicsByCategory&id=<?= $topics->getCategory()->getId() ?>"><?= $topics->getCategory() ?></a></p>
    </div>
    <div class="card-body">
        <p class="card-text">
        <h5> <?= $topics->getContent() ?> </h5>
        </p>
    </div>
    <div class="card-footer text-muted">
        <span> publié par : <a href="index.php?ctrl=forum&action=userDetails&id=<?= $topics->getUser()->getId() ?>"><?= $topics->getUser() ?></a>, le : <?= $topics->getCreationDate() ?></span>
        <!-- ne fonctionne pas --><a href="index.php?ctrl=forum&action=updateTopic&id=<?= $topics->getId() ?>" class="btn btn-outline-primary">Modifier le topic</a>
    </div>
</div>

<!-- affiche les posts sous le topic -->
<?php
if (!empty($posts)) {
    foreach ($posts as $post) { ?>

        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">
                    <h6><?= $post->getContent() ?></h6>
                    <a href="index.php?ctrl=forum&action=formUpdatePost&id=<?php $post->getId() ?>" class="badge bg-primary">Modifier</a>
                    <a href="index.php?ctrl=forum&action=deletePost&id=<?php $post->getId() ?>" class="badge bg-secondary">Supprimer</a>
                </p>
            </div>
            <div class="card-footer text-muted">
                <span>publié par : <a href="index.php?ctrl=forum&action=userDetails&id=<?= $post->getUser()->getId() ?>"><?= $post->getUser() ?></a></span> 
                <span>écrit le : <?= $post->getPostDate() ?></span>
            </div>
        </div>
<?php }
} ?>

<!-- formulaire pour écrire un post sous le topic -->
<form action="index.php?ctrl=forum&action=addPost&id=<?= $topics->getId() ?>" method="POST">
    <div class="col-md-4 mb-3">
        <label for="content">Ecrire un commentaire : </label>
        <textarea class="form-control" rows="3" id="content" name="content" placeholder="Taper votre message"></textarea>
    </div>
    <input type="submit" value="Ajouter" class="btn btn-lg btn-primary"><br><br>
</form>