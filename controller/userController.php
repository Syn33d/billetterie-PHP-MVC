<?php
require_once 'model/userModel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function login($username) {
        return $this->model->getUserType($username);
    }

    public function getUsername($username) {
        return $this->model->getUsername($username);
    }
}
?>