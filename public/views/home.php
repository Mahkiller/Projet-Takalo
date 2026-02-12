<!DOCTYPE html>
<html>
<head>
    <title><?= APP_NAME ?> - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h1 class="mb-4">Bienvenue sur <?= APP_NAME ?></h1>

    <?php if(isset($_SESSION['user'])): ?>
        <p>Bonjour, <?= $_SESSION['user']['nom'] ?> !</p>
        <a href="?action=objects" class="btn btn-primary">Mes Objets</a>
        <a href="?action=exchanges" class="btn btn-secondary">Mes Échanges</a>
        <a href="?action=logout" class="btn btn-danger">Déconnexion</a>
    <?php else: ?>
        <a href="?action=register" class="btn btn-success">S'inscrire</a>
        <a href="?action=login" class="btn btn-primary">Se connecter</a>
    <?php endif; ?>

</body>
</html>
