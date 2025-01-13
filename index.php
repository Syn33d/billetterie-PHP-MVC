<?php
session_start();
require_once 'vendor/autoload.php';

require_once 'controller/ticketController.php';

// Vérifie si l'utilisateur est connecté
function checkAuth($requiredRole = null) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: /index.php/login');
        exit();
    }
    if ($requiredRole === 'admin' && (!isset($_SESSION['loggedinAsAdmin']) || $_SESSION['loggedinAsAdmin'] !== true)) {
        echo '<html><body><h1>Erreur: Vous n\'êtes pas administrateur</h1></body></html>';
        exit();
    }
    if ($requiredRole === 'user' && (!isset($_SESSION['loggedinAsUser']) || $_SESSION['loggedinAsUser'] !== true)) {
        header('Location: /index.php/login');
        exit();
    }
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$controller = new TicketController();

if ($uri == '/') {
    $controller->index();
} elseif ($uri == '/index.php/login') {
    require 'vue/login.php';
} elseif ($uri == '/index.php/logout') {
    require 'vue/logout.php';
} elseif (str_starts_with($uri, '/index.php/admin')) {
    checkAuth('admin');
    if ($uri == '/index.php/admin/create') {
        require 'vue/createTicket.php';
    } 
    
    elseif ($uri == '/index.php/admin/edit') {
        require 'vue/editTicket.php';
    } 
    
    elseif ($uri == '/index.php/admin/delete') {
        require 'vue/deleteTicket.php';
    } 

    elseif($uri == '/index.php/admin') {
        $controller->index();
    }
    
    else {
        header('HTTP/1.1 404 Not Found');
        echo '<html><body><h1>Page Not Found</h1></body></html>';
        exit();
    }
} elseif (str_starts_with($uri, '/index.php/user')) {
    checkAuth('user');
    if ($uri == '/index.php/user/detail') {
        require 'vue/detailTicket.php';
    } 

    elseif ($uri == '/index.php/user') {
        $controller->index();
    }
    
    else {
        header('HTTP/1.1 404 Not Found');
        echo '<html><body><h1>Page Not Found</h1></body></html>';
        exit();
    }
} 

elseif ($uri == '/index.php/detail') {
    require 'vue/detailTicket.php';
} 

elseif ($uri == '/index.php/pdf') {
    require 'vue/pdfTicket.php';
} 

elseif ($uri == '/index.php/pdfUser') {
    require 'vue/pdfTicketUser.php';
}

else {
    header('HTTP/1.1 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
    exit();
}
?>