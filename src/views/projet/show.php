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
                            <a class="nav-link active" href="salarie.php">Salariés</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="projet.php">Projets</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <h1 class="my-4">Détails du projet</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $this->projet->prenom ?> <?= $this->projet->nom ?></h5>
                <p class="card-text"><strong>Email:</strong> <?= $this->salarie->email ?></p>
                <p class="card-text"><strong>Rôle:</strong> <?= $this->salarie->role ?></p>
                <p class="card-text"><strong>Date d'inscription:</strong> <?= $this->salarie->date_inscription ?></p>
                <a href="projet.php" class="btn btn-primary">Retour à la liste</a>
                <a href="projet.php?action=edit&id=<?= $this->salarie->id ?>" class="btn btn-warning">Modifier</a>
            </div>
        </div>
    </div>
</body>
</html>