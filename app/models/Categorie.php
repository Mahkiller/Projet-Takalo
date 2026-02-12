<?php
require_once __DIR__ . '/../config/services.php';

class Categorie
{
    private $db;
    public function __construct() { $this->db = Database::getInstance(); }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM Categorie_takalo")->fetchAll();
    }

    public function create($nom, $description)
    {
        $stmt = $this->db->prepare("INSERT INTO Categorie_takalo (nom_categorie, description) VALUES (:nom, :desc)");
        return $stmt->execute([':nom'=>$nom, ':desc'=>$description]);
    }
}
