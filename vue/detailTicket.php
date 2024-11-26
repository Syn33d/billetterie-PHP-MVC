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
</head>
<body>
    <h1>Détails du Ticket</h1>
    <p>ID: <?= htmlspecialchars($ticket['id']) ?></p>
    <p>Titre: <?= htmlspecialchars($ticket['title']) ?></p>
    <p>Description: <?= nl2br(htmlspecialchars($ticket['description'])) ?></p>
    <p>Date: <?= htmlspecialchars($ticket['date']) ?></p>
    <p>Nombre de billets vendus: <?= htmlspecialchars($ticket['nbTicketsVendus']) ?></p>
    <form method="post">
        <button type="submit">Acheter un billet</button>
    </form>
    <button onclick="window.location.href='/'">Retour</button>
    <button onclick="window.location.href='pdf?id=<?= $ticket['id'] ?>'">Générer PDF</button>
</body>
</html>