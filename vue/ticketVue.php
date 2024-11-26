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
        <div class="mb-3 text-end">
            <button class="btn btn-primary" onclick="window.location.href='index.php/create'">Créer un ticket</button>
        </div>
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
                            <button class="btn btn-warning btn-sm" onclick="window.location.href='/index.php/edit?id=<?= $ticket['id'] ?>'">Modifier</button>
                            <button class="btn btn-danger btn-sm" onclick="window.location.href='/index.php/delete?id=<?= $ticket['id'] ?>'">Supprimer</button>
                            <button class="btn btn-info btn-sm" onclick="window.location.href='/index.php/detail?id=<?= $ticket['id'] ?>'">Détail</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
