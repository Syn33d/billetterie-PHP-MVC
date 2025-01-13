<?php

require_once 'controller/userController.php';

$controller = new UserController();

// Délai d'expiration de session (30 minutes)
$sessionTimeout = 1800;

// Vérifie si la session est active
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessionTimeout)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $userType = $controller->login($username);
    if ($userType) {
        $_SESSION['loggedin'] = true;
        if ($userType === 'admin') {
            $_SESSION['loggedinAsAdmin'] = true;
            header('Location: /index.php/admin');
        } elseif ($userType === 'user') {
            $_SESSION['loggedinAsUser'] = true;
            header('Location: /index.php/user');
        }
        exit();
    } else {
        $error = "Nom d'utilisateur incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vue/asset/css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            font-family: Arial, sans-serif;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
<body>
<div class="container login-container">
        <h1>Connexion</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</body>
</html>