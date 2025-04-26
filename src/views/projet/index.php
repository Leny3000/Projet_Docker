<!DOCTYPE html>
<html>
<head>
    <title>Liste des projets</title>
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
        
        <h1 class="my-4">Liste des projets</h1>
        
        <a href="projet.php?action=create" class="btn btn-primary mb-3">Ajouter un projet</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Salarié</th>
                    <th>Objectif</th>
                    <th>Date du début</th>
                    <th>date de fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($projets as $projet): ?>
                <tr>
                    <td><?= $projet['id'] ?></td>
                    <td><?= $projet['nom'] . ' ' . $projet['prenom'] ?></td>
                    <td><?= $projet['objectif'] ?></td>
                    <td><?= $projet['date_debut'] ?></td>
                    <td><?= $projet['date_fin'] ?> €</td>
                    <td>
                        <a href="projet.php?action=show&id=<?= $projet['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                        <a href="projet.php?action=edit&id=<?= $projet['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="projet.php?action=delete&id=<?= $projet['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>