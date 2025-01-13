<?php

require 'vendor/autoload.php';
require_once 'controller/ticketController.php';
require_once 'controller/userController.php';

use Dompdf\Dompdf;

$ticketController = new TicketController();
$userController = new UserController();

$ticket = $ticketController->getTicketById($_GET['id']);


$html = '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Ticket</title>
    <style>
        /* CSS Bootstrap minimaliste */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
            color: #333;
        }

        .card-body p {
            margin: 10px 0;
            font-size: 1rem;
        }

        .card-body p strong {
            font-weight: bold;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }
        
        h1, h2, h3 {
            color: #6a11cb;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #6a11cb;
            color: white;
            text-align: center;
        }

        .card-body p {
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #6a11cb;
            border-color: #6a11cb;
        }
            
        .btn-primary:hover {
            background-color: #2575fc;
            border-color: #2575fc;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Détails du Ticket
            </div>
            <div class="card-body">
                <p><strong>ID :</strong> ' . htmlspecialchars($ticket['id']) . '</p>
                <p><strong>Titre :</strong> ' . htmlspecialchars($ticket['title']) . '</p>
                <p><strong>Description :</strong> ' . nl2br(htmlspecialchars($ticket['description'])) . '</p>
                <p><strong>Date :</strong> ' . htmlspecialchars($ticket['date']) . '</p>
                <p>Ce document fait office de ticket.</p>
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