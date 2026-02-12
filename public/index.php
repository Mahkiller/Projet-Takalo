<?php
session_start();

require_once '../app/config/config.php';
require_once '../app/config/services.php';
require_once '../app/config/routes.php';

// Gestion des actions via query string
$action = $_GET['action'] ?? 'home';

switch ($action) {

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../app/controllers/UserController.php';
            $uc = new UserController();
            $uc->register($_POST['nom'], $_POST['email'], $_POST['password']);
        } else {
            require_once 'views/register.php';
        }
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../app/controllers/UserController.php';
            $uc = new UserController();
            $uc->login($_POST['email'], $_POST['password']);
        } else {
            require_once 'views/login.php';
        }
        break;

    case 'objects':
        require_once '../app/controllers/ObjectController.php';
        $oc = new ObjectController();
        $objects = $oc->index();
        require_once 'views/mes_objets.php';
        break;

    case 'exchanges':
        require_once '../app/controllers/EchangeController.php';
        $ec = new EchangeController();
        $exchanges = $ec->index();
        require_once 'views/mes_echanges.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: ?action=home');
        break;

    default:
        require_once 'views/home.php';
        break;

    case 'add_object':
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../app/controllers/ObjectController.php';
        require_once '../app/controllers/PhotoObjetController.php';

        $oc = new ObjectController();

        // Créer l'objet
        $titre = $_POST['titre'];
        $desc = $_POST['description'];
        $prix = $_POST['prix'];
        $cat = $_POST['categorie'];
        $userId = $_SESSION['user']['id'];

        $oc->create($userId, $cat, $titre, $desc, $prix);

        // Récupérer l'id du dernier objet inséré
        $pdo = Database::getInstance();
        $lastId = $pdo->lastInsertId();

        // Upload de la photo
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] === 0){
            $uploadDir = '../public/assets/uploads/';
            if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $fileName = time().'_'.basename($_FILES['photo']['name']);
            $target = $uploadDir.$fileName;

            if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)){
                $photoCtrl = new PhotoObjetController();
                $photoCtrl->add($lastId, 'assets/uploads/'.$fileName, true);
            }
        }

        header('Location: ?action=objects');
    }
    break;

}
