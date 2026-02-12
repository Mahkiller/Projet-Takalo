<?php
require_once __DIR__ . '/../config/services.php';

class User
{
    private $db;
    public function __construct() { $this->db = Database::getInstance(); }

    public function create($nom, $email, $mot_de_passe)
    {
        $sql = "INSERT INTO Utilisateur_takalo (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':mot_de_passe' => password_hash($mot_de_passe, PASSWORD_BCRYPT)
        ]);
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM Utilisateur_takalo WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM Utilisateur_takalo")->fetchAll();
    }
}
