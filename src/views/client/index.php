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

        <h1 class="my-4">Liste des clients</h1>
        
        <a href="client.php?action=create" class="btn btn-primary mb-3">Ajouter un client</a>
        
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
                <?php foreach($clients as $client): ?>
                <tr>
                    <td><?= $client['id'] ?></td>
                    <td><?= $client['nom'] ?></td>
                    <td><?= $client['prenom'] ?></td>
                    <td><?= $client['email'] ?></td>
                    <td><?= $client['date_inscription'] ?></td>
                    <td>
                        <a href="client.php?action=show&id=<?= $client['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                        <a href="client.php?action=edit&id=<?= $client['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="client.php?action=delete&id=<?= $client['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>