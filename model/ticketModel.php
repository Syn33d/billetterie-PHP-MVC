<?php
function getPDO() {
    $host = 'localhost';
    $db = 'ticketAL';
    $user = 'root';
    $password = '';

    try {
        return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
}

class TicketModel
{
    private $pdo;

    public function __construct() {
        $this->pdo = getPDO();
    }

    public function getTickets() {
        $stmt = $this->pdo->query('SELECT * FROM tickets');
        return $stmt->fetchAll();
    }

    public function createTicket($id, $title, $description, $date, $nbTicketsRestants) {
        $stmt = $this->pdo->prepare('INSERT INTO tickets (id, title, description, date, nbTicketsRestants) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$id, $title, $description, $date, $nbTicketsRestants]);
    }

    public function getTicketById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM tickets WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function editTicket($id, $title, $description, $date, $nbTicketsRestants) {
        $stmt = $this->pdo->prepare('UPDATE tickets SET title = ?, description = ?, date = ?, nbTicketsRestants = ? WHERE id = ?');
        $stmt->execute([$title, $description, $date, $nbTicketsRestants, $id]);
    }

    public function buyTicket($id) {
        $stmt = $this->pdo->prepare('SELECT nbTicketsRestants FROM tickets WHERE id = ?');
        $stmt->execute([$id]);
        $ticket = $stmt->fetch();

        if ($ticket && $ticket['nbTicketsRestants'] > 0) {
            $stmt = $this->pdo->prepare('UPDATE tickets SET nbTicketsRestants = nbTicketsRestants - 1, nbTicketsVendus = nbTicketsVendus + 1 WHERE id = ?');
            $stmt->execute([$id]);
        } else {
            throw new Exception('Il ne reste plus de billets disponibles.');
        }
    }

    public function deleteTicket($id) {
        $stmt = $this->pdo->prepare('DELETE FROM tickets WHERE id = ?');
        $stmt->execute([$id]);
    }
}


?>