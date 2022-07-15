<h1>Inscrivez-vous !</h1>

<form action="index.php?ctrl=security&action=register" method="POST" enctype="multipart/form-data">
    <div class="col-md-4 mb-3">
        <label for="pseudo">Créez un pseudo : </label>
        <input type="text" class="form-control" name="pseudo" placeholder="pseudo" required>
    </div>
    <div class="col-md-4 mb-3">
        <label for="email">Entrez votre e-mail : </label>
        <input type="email" class="form-control" name="email" placeholder="email@example.com" required>
    </div>
    <div class="col-md-4 mb-3">
        <label for="password">Créez un mot de passe : </label>
        <input type="password" class="form-control" name="password" placeholder="password" required>
    </div>
    <div class="col-md-4 mb-3">
        <label for="confirmPassword">Confirmez le mot de passe : </label>
        <input type="password" class="form-control" name="confirmPassword" placeholder="confirm password" required>
    </div>
    
    <input type="submit" class="btn btn-lg btn-primary" value="Valider">
</form>