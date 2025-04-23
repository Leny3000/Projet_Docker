<!DOCTYPE html>
<html>
<head>
    <title>Détails du client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Application Docker</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="client.php">Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="commande.php">Commandes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <h1 class="my-4">Détails du client</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $this->client->prenom ?> <?= $this->client->nom ?></h5>
                <p class="card-text"><strong>Email:</strong> <?= $this->client->email ?></p>
                <p class="card-text"><strong>Date d'inscription:</strong> <?= $this->client->date_inscription ?></p>
                <a href="client.php" class="btn btn-primary">Retour à la liste</a>
                <a href="client.php?action=edit&id=<?= $this->client->id ?>" class="btn btn-warning">Modifier</a>
            </div>
        </div>
    </div>
</body>
</html>