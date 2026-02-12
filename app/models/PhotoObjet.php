<?php
require_once __DIR__ . '/../config/services.php';

class PhotoObjet
{
    private $db;
    public function __construct() { $this->db = Database::getInstance(); }

    public function add($id_objet, $chemin, $est_principale = false)
    {
        $sql = "INSERT INTO PhotoObjet_takalo (id_objet, chemin_photo, est_principale) 
                VALUES (:id_objet, :chemin, :principale)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_objet' => $id_objet,
            ':chemin' => $chemin,
            ':principale' => $est_principale
        ]);
    }

    public function getByObjet($id_objet)
    {
        $stmt = $this->db->prepare("SELECT * FROM PhotoObjet_takalo WHERE id_objet = :id");
        $stmt->execute([':id' => $id_objet]);
        return $stmt->fetchAll();
    }
}
