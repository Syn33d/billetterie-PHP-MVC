<?php
require_once 'controller/ticketController.php';

$controller = new TicketController();
$ticket = $controller->getTicketById($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->buyTicket($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vue/asset/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Détails du Ticket</h1>
        <div class="card p-4 shadow-sm">
            <p><strong>ID :</strong> <?= htmlspecialchars($ticket['id']) ?></p>
            <p><strong>Titre :</strong> <?= htmlspecialchars($ticket['title']) ?></p>
            <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($ticket['description'])) ?></p>
            <p><strong>Date :</strong> <?= htmlspecialchars($ticket['date']) ?></p>
            <p><strong>Nombre de billets vendus :</strong> <?= htmlspecialchars($ticket['nbTicketsVendus']) ?></p>
            <div class="mt-3">
                <form method="post" class="d-inline">
                    <button type="submit" class="btn btn-success">Acheter un billet</button>
                </form>
                <button class="btn btn-secondary" onclick="window.location.href='/'">Retour</button>
                <button class="btn btn-info" onclick="window.location.href='pdf?id=<?= $ticket['id'] ?>'">Générer PDF</button>
            </div>
        </div>
    </div>
</body>
</html>