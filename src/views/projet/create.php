<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un projet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Application DM</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="salarie.php">Salariés</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="projet.php">Projets</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <h1 class="my-4">Ajouter un projet</h1>
        
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="post" action="projet.php?action=create">
            <div class="mb-3">
                <label for="salarie_id" class="form-label">ID du salarié</label>
                <input type="number" class="form-control" id="salarie_id" name="salarie_id" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du projet</label>
                <input type="text" class="form-control" id="nom_projet" name="nom_projet" required>
            </div>
            <div class="mb-3">
                <label for="objectif" class="form-label">Objectif</label>
                <input type="text" class="form-control" id="email" name="objectif" required>
            </div>
            <div class="mb-3">
                <label for="date_debut" class="form-label">Date du début</label>
                <input type="date" class="form-control" id="date_debut" name="date_debut" required>
            </div>
            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de fin</label>
                <input type="date" class="form-control" id="date_fin" name="date_fin" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="projet.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>