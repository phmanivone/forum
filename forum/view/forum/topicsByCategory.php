<?php

$categories = $result["data"]['category'];
$topics = $result["data"]['topic'];

?>

<h1><?= $categories->getCategoryName() ?></h1><br>

<ul><?php
    if (!empty($topics)) {
        foreach ($topics as $topic) { ?>
            <li><a href="index.php?ctrl=forum&action=topicDetails&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a></li>
    <?php
        }
    } else {
        "Aucun résultat";
    } ?>
</ul>

<a href="index.php?ctrl=forum&action=formAddTopic" class="btn btn-secondary">Add a Topic</a>