<?php

$users = $result["data"]['users'];
    
?>

<h1>Users:</h1>

<ul>
    <?php
    foreach($users as $user){ ?>

        <li><a href="index.php?ctrl=forum&action=userDetails&id=<?=$user->getId()?>"><?=$user->getPseudo()?></a></li>
        <?php
    } ?>
</ul>

