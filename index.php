<?php
require_once 'vendor/autoload.php';

require_once 'controller/ticketController.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$controller = new TicketController();

if ($uri == '/'){
    $controller->index();
}

elseif ($uri == '/index.php/create'){
    require 'vue/createTicket.php';
}

elseif ($uri == '/index.php/edit'){
    require 'vue/editTicket.php';
}

elseif ($uri == '/index.php/delete'){
    require 'vue/deleteTicket.php';
}

elseif ($uri == '/index.php/detail'){
    require 'vue/detailTicket.php';
}

elseif ($uri == '/index.php/pdf'){
    require 'vue/pdfTicket.php';
}

else {
    header('HTTP/1.1 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
    exit();
}
?>