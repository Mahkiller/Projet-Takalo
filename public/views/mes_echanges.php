<!DOCTYPE html>
<html>
<head>
    <title><?= APP_NAME ?> - Mes Échanges</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Mes Échanges</h2>
<a href="?action=home" class="btn btn-secondary mb-3">Retour</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Objet 1</th>
            <th>Objet 2</th>
            <th>Utilisateur 1</th>
            <th>Utilisateur 2</th>
            <th>Date proposition</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($exchanges as $ex): ?>
        <tr>
            <td><?= htmlspecialchars($ex['id_objet1']) ?></td>
            <td><?= htmlspecialchars($ex['id_objet2']) ?></td>
            <td><?= htmlspecialchars($ex['id_user1']) ?></td>
            <td><?= htmlspecialchars($ex['id_user2']) ?></td>
            <td><?= htmlspecialchars($ex['date_proposition']) ?></td>
            <td><?= htmlspecialchars($ex['statut']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
