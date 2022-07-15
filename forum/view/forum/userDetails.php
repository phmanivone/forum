<?php

$users = $result["data"]['users'];
    
?>
<div class="card border-primary mb-3" style="max-width: 20rem;">
  <div class="card-header"><h3 class="text-primary">User: <?= $users->getPseudo()?></h3></div>
  <div class="card-body">
    <p class="card-text">
        Adresse e-mail : <?= $users->getEmail()?><br>
        inscrit(e) le : <?= $users->getSignupDate()?>
        <?= $users->getStatus()?>
    </p>
  </div>
</div>