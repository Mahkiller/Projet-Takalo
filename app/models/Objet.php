<?php
require_once __DIR__ . '/../config/services.php';

class Objet
{
    private $db;
    public function __construct() { $this->db = Database::getInstance(); }

    public function create($id_user, $id_categorie, $titre, $description, $prix)
    {
        $sql = "INSERT INTO Objet_takalo (id_utilisateur, id_categorie, titre, description, prix_estimatif)
                VALUES (:user, :cat, :titre, :desc, :prix)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user'=>$id_user, ':cat'=>$id_categorie, ':titre'=>$titre, ':desc'=>$description, ':prix'=>$prix
        ]);
    }

    public function getAllWithUserAndCategorie()
    {
        $sql = "SELECT o.*, u.nom AS nom_utilisateur, c.nom_categorie 
                FROM Objet_takalo o
                JOIN Utilisateur_takalo u ON o.id_utilisateur = u.id
                JOIN Categorie_takalo c ON o.id_categorie = c.id";
        return $this->db->query($sql)->fetchAll();
    }
}
