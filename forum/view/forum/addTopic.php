<?php

$categories = $result["data"]['categories'];

?>

<h1>Add a Topic:</h1>

<form action="index.php?ctrl=forum&action=addTopic" method="POST">
  
  <div class="col-md-4 mb-3">
    <label for="title">Topic title:</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Type a title">
  </div>

  <div class="col-md-4 mb-3">
    <label for="categories">Sélectionner une catégorie : </label>

      <?php
      foreach ($categories as $category) : ?>
        <br><input type="radio" value="<?= $category->getId() ?>" name="category"> <?= $category->getCategoryName() ?>
      <?php endforeach ?>
  </div>

  <div class="col-md-4 mb-3">
    <label for="content">Contenu</label>
    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
  </div>
  
  <button class="btn btn-lg btn-primary" type="submit">Add topic</button>

</form>