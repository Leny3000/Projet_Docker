<!DOCTYPE html>
<html>
<head>
    <title>Application DM</title>
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
                            <a class="nav-link active" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="salarie.php">Salariés</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="projet.php">Projets</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="jumbotron my-4 p-4 bg-light">
            <h1>Bienvenue dans l'application DM</h1>
            <p class="lead">Cette application démontre l'utilisation de Docker pour la gestion des projets et des salariés.</p>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des salariés</h5>
                        <p class="card-text">Consulter et gérer la liste des salariés.</p>
                        <a href="salarie.php" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des projets</h5>
                        <p class="card-text">Consulter et gérer la liste des projets.</p>
                        <a href="projet.php" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Architecture DM</h5>
                <p class="card-text">Cette application utilise une architecture multi-conteneurs avec :</p>
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