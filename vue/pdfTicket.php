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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vue/asset/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header text-center bg-primary text-white">
                <h1>Détails du Ticket</h1>
            </div>
            <div class="card-body">
                <p><strong>ID :</strong> ' . htmlspecialchars($ticket['id']) . '</p>
                <p><strong>Titre :</strong> ' . htmlspecialchars($ticket['title']) . '</p>
                <p><strong>Description :</strong> ' . nl2br(htmlspecialchars($ticket['description'])) . '</p>
                <p><strong>Date :</strong> ' . htmlspecialchars($ticket['date']) . '</p>
                <p><strong>Nombre de billets vendus :</strong> ' . htmlspecialchars($ticket['nbTicketsVendus']) . '</p>
                <p><strong>Nombre de billets restants :</strong> ' . htmlspecialchars($ticket['nbTicketsRestants']) . '</p>
            </div>
        </div>
    </div>
</body>
</html>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('ticket_details.pdf', ['Attachment' => 0]);
?>