<!DOCTYPE html>
<html>
<head>
    <title><?= APP_NAME ?> - Ajouter Objet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Ajouter un objet</h2>
<a href="?action=home" class="btn btn-secondary mb-3">Retour</a>

<form method="POST" action="?action=add_object" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Titre</label>
        <input type="text" name="titre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Prix estimatif (€)</label>
        <input type="number" step="0.01" name="prix" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Catégorie</label>
        <select name="id_categorie" class="form-select" required>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom_categorie']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Photos</label>
        <input type="file" name="photos[]" class="form-control" multiple accept="image/*" onchange="previewImages()">
    </div>

    <div id="preview" class="mb-3 d-flex gap-2 flex-wrap"></div>

    <button type="submit" class="btn btn-success">Ajouter</button>
</form>

<script src="<?= BASE_URL ?>assets/js/script.js"></script>

</body>
</html>
