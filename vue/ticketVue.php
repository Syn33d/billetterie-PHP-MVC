<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vue/asset/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Gestion des Tickets</h1>
        <div>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <?php if (isset($_SESSION['loggedinAsAdmin']) && $_SESSION['loggedinAsAdmin'] === true): ?>
                    <p class="mb-0">Connecté en tant qu'administrateur</p>
                <?php elseif (isset($_SESSION['loggedinAsUser']) && $_SESSION['loggedinAsUser'] === true): ?>
                    <p class="mb-0">Connecté en tant qu'utilisateur</p>
                <?php endif; ?>
                <a class="btn btn-danger" href='/index.php/logout'>Déconnexion</a>
            <?php else: ?>
                <a class="btn btn-primary" href='/index.php/login'>Connexion</a>
            <?php endif; ?>
        </div>
        <?php if (isset($_SESSION['loggedinAsAdmin']) && $_SESSION['loggedinAsAdmin'] === true): ?>
            <div class="mb-3 text-end">
                <a class="btn btn-primary" href='/index.php/admin/create'>Créer un ticket</a>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php foreach ($tickets as $ticket): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">#<?= $ticket['id'] ?> - <?= htmlspecialchars($ticket['title']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($ticket['description'])) ?></p>
                        <p class="text-muted"><?= $ticket['date'] ?></p>
                        <p><strong>Vendues : </strong><?= $ticket['nbTicketsVendus'] ?></p>
                        <p><strong>Restantes : </strong><?= $ticket['nbTicketsRestants'] ?></p>
                        <div class="d-flex justify-content-between">
                            <?php if (isset($_SESSION['loggedinAsAdmin']) && $_SESSION['loggedinAsAdmin'] === true): ?>
                                <a class="btn btn-warning btn-sm" href='/index.php/admin/edit?id=<?= $ticket['id'] ?>'>Modifier</a>
                                <a class="btn btn-danger btn-sm" href='/index.php/admin/delete?id=<?= $ticket['id'] ?>'>Supprimer</a>
                                <a class="btn btn-info btn-sm" href='/index.php/detail?id=<?= $ticket['id'] ?>'>Détail</a>
                            <?php elseif (isset($_SESSION['loggedinAsUser']) && $_SESSION['loggedinAsUser'] === true): ?>
                                <a class="btn btn-info btn-sm" href='/index.php/detail?id=<?= $ticket['id'] ?>'>Détail</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
