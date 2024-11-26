<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tickets</title>
</head>
<body>
    <h1>Gestion des Tickets</h1>
    <button onclick="window.location.href='index.php/create'">Créer un ticket</button>
    <?php foreach ($tickets as $ticket): ?>
        <div class="ticket">
            <h2>#<?= $ticket['id'] ?> - <?= htmlspecialchars($ticket['title']) ?></h2>
            <p><?= nl2br(htmlspecialchars($ticket['description'])) ?></p>
            <p><?= $ticket['date'] ?></p>
            <p><?= $ticket['nbTicketsVendus'] ?></p>
            <p><?= $ticket['nbTicketsRestants'] ?></p>
            <button onclick="window.location.href='/index.php/edit?id=<?= $ticket['id'] ?>'">Modifier</button>
            <button onclick="window.location.href='/index.php/delete?id=<?= $ticket['id'] ?>'">Supprimer</button>
            <button onclick="window.location.href='/index.php/detail?id=<?= $ticket['id'] ?>'">Détail</button>
        </div>
    <?php endforeach; ?>
</body>
</html>
