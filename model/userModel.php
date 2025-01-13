<?php
class UserModel {
    private $pdo;

    public function __construct() {
        $this->pdo = getPDO();
    }

    public function userExists($username) {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch() !== false;
    }

    public function getUserType($username) {
        $stmt = $this->pdo->prepare('SELECT type FROM user WHERE username = ?');
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result ? $result['type'] : false;
    }

    public function getUsername($username) {
        $stmt = $this->pdo->prepare('SELECT username FROM user WHERE username = ?');
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result ? $result['username'] : 'Utilisateur inconnu' ;
        dd($result);
    }
}
?>