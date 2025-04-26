<!DOCTYPE html>
<html>
<head>
    <title>Liste des clients</title>
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

        <h1 class="my-4">Liste des salariés</h1>
        
        <a href="client.php?action=create" class="btn btn-primary mb-3">Ajouter un salarié</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($salaries as $salarie): ?>
                <tr>
                    <td><?= $salarie['id'] ?></td>
                    <td><?= $salarie['nom'] ?></td>
                    <td><?= $salarie['prenom'] ?></td>
                    <td><?= $salaire['email'] ?></td>
                    <td><?= $salarie['date_inscription'] ?></td>
                    <td>
                        <a href="salarie.php?action=show&id=<?= $salarie['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                        <a href="salarie.php?action=edit&id=<?= $salarie['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="salarie.php?action=delete&id=<?= $salarie['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>