<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
    public function register($nom, $email, $password)
    {
        $user = new User();
        
        // Check if email already exists
        if ($user->findByEmail($email)) {
            echo "Erreur: Cet email est déjà utilisé.";
            return false;
        }
        
        if ($user->create($nom, $email, $password)) {
            // Start session only if not already started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user'] = $user->findByEmail($email);
            header('Location: ?action=home');
            exit;
        } else {
            echo "Erreur lors de la création.";
            return false;
        }
    }

    public function login($email, $password)
    {
        $user = new User();
        $u = $user->findByEmail($email);
        if ($u && password_verify($password, $u['mot_de_passe'])) {
            // Start session only if not already started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user'] = $u;
            header('Location: ?action=home');
            exit;
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }
}
