<?php
require_once 'controller/ticketController.php';

$controller = new TicketController();
$controller->deleteTicket($_GET['id']);
exit();