<?php
require 'model/ticketModel.php';

class TicketController{
    private $model;

    public function __construct() {
        $this->model = new TicketModel();
    }

    public function index() {
        $tickets = $this->model->getTickets();
        require 'vue/ticketVue.php';
    }

    public function getTicketById($id) {
        return $this->model->getTicketById($id);
    }

    public function createTicket($id, $title, $description, $date, $nbTicketsRestants) {
        $this->model->createTicket($id, $title, $description, $date, $nbTicketsRestants);
        header('Location: /');
    }

    public function editTicket($id, $title, $description, $date, $nbTicketsRestants) {
        $this->model->editTicket($id, $title, $description, $date, $nbTicketsRestants);
        header('Location: /');
    }

    public function buyTicket($id) {
        $this->model->buyTicket($id);
        header('Location: /');
    }

    public function deleteTicket($id) {
        $this->model->deleteTicket($id);
        header('Location: /');
    }
}
?>