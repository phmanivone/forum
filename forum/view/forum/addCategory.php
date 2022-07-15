<h1>Add a new Category:</h1>

<form action="index.php?ctrl=forum&action=addCategory" method="POST">
  <div class="col-md-4 mb-3">
    <label for="categoryName">Category name:</label>
    <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Type the name of your new category">
  </div>
  <button type="submit" class="btn btn-lg btn-primary">Add category</button>
</form>