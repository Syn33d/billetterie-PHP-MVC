<?php
require 'vendor/autoload.php';
require_once 'controller/ticketController.php';

use Dompdf\Dompdf;

$controller = new TicketController();
$ticket = $controller->getTicketById($_GET['id']);

$html = '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Ticket</title>
</head>
<body>
    <h1>Détails du Ticket</h1>
    <p>ID: ' . htmlspecialchars($ticket['id']) . '</p>
    <p>Titre: ' . htmlspecialchars($ticket['title']) . '</p>
    <p>Description: ' . nl2br(htmlspecialchars($ticket['description'])) . '</p>
    <p>Date: ' . htmlspecialchars($ticket['date']) . '</p>
    <p>Nombre de billets vendus: ' . htmlspecialchars($ticket['nbTicketsVendus']) . '</p>
    <p>Nombre de billets restants: ' . htmlspecialchars($ticket['nbTicketsRestants']) . '</p>
</body>
</html>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('ticket_details.pdf', ['Attachment' => 0]);
?>