<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
    public function register($nom, $email, $password)
    {
        $user = new User();
        if ($user->create($nom, $email, $password)) {
            echo "Utilisateur créé avec succès !";
        } else {
            echo "Erreur lors de la création.";
        }
    }

    public function login($email, $password)
    {
        $user = new User();
        $u = $user->findByEmail($email);
        if ($u && password_verify($password, $u['mot_de_passe'])) {
            session_start();
            $_SESSION['user'] = $u;
            echo "Connexion réussie !";
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }
}
