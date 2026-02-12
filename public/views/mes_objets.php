<!DOCTYPE html>
<html>
<head>
    <title><?= APP_NAME ?> - Mes Objets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Mes Objets</h2>
<a href="?action=home" class="btn btn-secondary mb-3">Retour</a>

<!-- Formulaire d'ajout d'objet -->
<h4>Ajouter un objet</h4>
<form method="POST" action="?action=add_object" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Titre</label>
        <input type="text" name="titre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Prix estimatif</label>
        <input type="number" step="0.01" name="prix" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Catégorie</label>
        <select name="categorie" class="form-select" required>
            <?php
            require_once '../app/models/Categorie.php';
            $catModel = new Categorie();
            $categories = $catModel->getAll();
            foreach($categories as $cat){
                echo "<option value='{$cat['id']}'>{$cat['nom_categorie']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Photo principale</label>
        <input type="file" name="photo" class="form-control" accept="image/*" onchange="previewImage(event)">
        <img id="preview" src="#" alt="Preview" class="mt-2" style="display:none; max-width:200px;">
    </div>
    <button class="btn btn-success" type="submit">Ajouter</button>
</form>

<hr>

<!-- Liste des objets -->
<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Prix estimatif</th>
            <th>Catégorie</th>
            <th>Propriétaire</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($objects as $obj): ?>
        <tr>
            <td><?= htmlspecialchars($obj['titre']) ?></td>
            <td><?= htmlspecialchars($obj['description']) ?></td>
            <td><?= htmlspecialchars($obj['prix_estimatif']) ?> €</td>
            <td><?= htmlspecialchars($obj['nom_categorie']) ?></td>
            <td><?= htmlspecialchars($obj['nom_utilisateur']) ?></td>
            <td><?= htmlspecialchars($obj['statut']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="<?= BASE_URL ?>assets/js/script.js"></script>
</body>
</html>
