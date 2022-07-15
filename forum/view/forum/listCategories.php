<?php

$categories = $result["data"]['category'];

?>

<h1>Categories:</h1>

<ul>
    <?php
    foreach($categories as $category){ ?>
        <li><a href="index.php?ctrl=forum&action=topicsByCategory&id=<?= $category->getId()?>"><?= $category->getCategoryName() ?></a></li><?php
    }?>
</ul>

<a href="index.php?ctrl=forum&action=formAddCategory" class="btn btn-secondary">Add a Category</a>

