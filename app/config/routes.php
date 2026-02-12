<?php
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/ObjectController.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'register':
        $controller = new UserController();
        $controller->register($_POST['nom'] ?? '', $_POST['email'] ?? '', $_POST['password'] ?? '');
        break;

    case 'login':
        $controller = new UserController();
        $controller->login($_POST['email'] ?? '', $_POST['password'] ?? '');
        break;

    case 'objects':
        $controller = new ObjectController();
        print_r($controller->index());
        break;

    default:
        echo "Bienvenue sur Takalo";
        break;
}
