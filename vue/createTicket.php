<?php
require_once 'controller/ticketController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $nbTicketsRestants = $_POST['nbTicketsRestants'];
    $controller = new TicketController();
    $controller->createTicket($id, $title, $description, $date, $nbTicketsRestants);
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un post</title>
</head>
<body>
    <h1>Créer un post</h1>
    <form method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        <label for="title">Titre:</label>
        <input type="text" id="title" name="title" required>
        <label for="description">description:</label>
        <textarea id="description" name="description" required></textarea>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <label for="nbTicketsRestants"> nombre de tickets restants:</label>
        <input type="number" id="nbTicketsRestants" name="nbTicketsRestants" required>
        <button type="submit">Créer</button>
    </form>
</body>
</html>