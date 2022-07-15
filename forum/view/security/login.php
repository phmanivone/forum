<h1>Connectez-vous !</h1>

<form action="index.php?ctrl=security&action=login" method="POST" enctype="multipart/form-data">
    <div class="col-md-4 mb-3">
        <label for="email">Adresse e-mail : </label>
        <input type="email" class="form-control" name="email" placeholder="email@example.com" required>
    </div>
    <div class="col-md-4 mb-3">
        <label for="password">Mot de passe : </label>
        <input type="password" class="form-control" name="password" placeholder="password" required>
    </div>
    
    <input type="submit" class="btn btn-lg btn-primary" name="submit" value="Valider">
</form>