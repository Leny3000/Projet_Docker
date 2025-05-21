<!DOCTYPE html>
<html>
<head>
    <title>Détails du projet</title>
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
        
        <h1 class="my-4">Détails du projet</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $this->projet->nom_projet ?></h5>
                <p class="card-text"><strong>Objectif :</strong> <?= $this->projet->objectif ?></p>
                <p class="card-text"><strong>Date du début :</strong> <?= $this->projet->date_debut ?></p>
                <p class="card-text"><strong>Date de fin :</strong> <?= $this->projet->date_fin ?></p>
                <a href="projet.php" class="btn btn-primary">Retour à la liste</a>
                <a href="projet.php?action=edit&id=<?= $this->projet->id ?>" class="btn btn-warning">Modifier</a>
            </div>
        </div>
    </div>
</body>
</html>