<?php
require_once 'controller/ticketController.php';

$controller = new TicketController();
$controller->deleteTicket($_GET['id']);
exit();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->deleteTicket($_GET['id']);
}