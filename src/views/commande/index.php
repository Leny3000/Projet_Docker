<!DOCTYPE html>
<html>
<head>
    <title>Liste des commandes</title>
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
                            <a class="nav-link" href="client.php">Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="commande.php">Commandes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <h1 class="my-4">Liste des commandes</h1>
        
        <a href="commande.php?action=create" class="btn btn-primary mb-3">Ajouter une commande</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($commandes as $commande): ?>
                <tr>
                    <td><?= $commande['id'] ?></td>
                    <td><?= $commande['nom'] . ' ' . $commande['prenom'] ?></td>
                    <td><?= $commande['date_commande'] ?></td>
                    <td><?= $commande['montant'] ?> €</td>
                    <td><?= $commande['statut'] ?></td>
                    <td>
                        <a href="commande.php?action=show&id=<?= $commande['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                        <a href="commande.php?action=edit&id=<?= $commande['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="commande.php?action=delete&id=<?= $commande['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>