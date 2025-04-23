<!DOCTYPE html>
<html>
<head>
    <title>Application Web Docker</title>
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
                            <a class="nav-link active" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="client.php">Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="commande.php">Commandes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="jumbotron my-4 p-4 bg-light">
            <h1>Bienvenue dans l'application Docker PHP/MySQL</h1>
            <p class="lead">Cette application démontre l'utilisation de Docker pour déployer une architecture web complète.</p>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des clients</h5>
                        <p class="card-text">Consulter et gérer la liste des clients.</p>
                        <a href="client.php" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des commandes</h5>
                        <p class="card-text">Consulter et gérer la liste des commandes.</p>
                        <a href="commande.php" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Architecture Docker</h5>
                <p class="card-text">Cette application utilise une architecture multi-conteneurs avec:</p>
                <ul>
                    <li>Un conteneur Apache/PHP pour le serveur web</li>
                    <li>Un conteneur MySQL pour la base de données</li>
                    <li>Docker Compose pour l'orchestration</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>