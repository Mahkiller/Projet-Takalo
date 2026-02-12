<!DOCTYPE html>
<html>
<head>
    <title><?= APP_NAME ?> - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Connexion</h2>
    <form method="POST" action="?action=login">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit">Se connecter</button>
        <a href="?action=home" class="btn btn-secondary">Retour</a>
    </form>
</body>
</html>
