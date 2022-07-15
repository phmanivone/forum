<?php

$topics = $result["data"]['topics'];
?>

<h1>Topics:</h1>

<ul>
    <?php
    foreach($topics as $topic){ ?>
        <li><a href="index.php?ctrl=forum&action=topicDetails&id=<?=$topic->getId()?>"><?= $topic->getTitle().", ".$topic->getUser()." (".$topic->getCreationDate().")"?></a></li><?php
    } ?>
</ul>

<a href="index.php?ctrl=forum&action=formAddTopic" class="btn btn-secondary">Add a Topic</a>