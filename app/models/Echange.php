<?php
require_once __DIR__ . '/../config/services.php';

class Echange
{
    private $db;
    public function __construct() { $this->db = Database::getInstance(); }

    public function proposer($id_objet1, $id_objet2, $id_user1, $id_user2)
    {
        $sql = "INSERT INTO Echange_takalo (id_objet1, id_objet2, id_user1, id_user2) 
                VALUES (:o1, :o2, :u1, :u2)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':o1'=>$id_objet1, ':o2'=>$id_objet2, ':u1'=>$id_user1, ':u2'=>$id_user2
        ]);
    }

    public function changerStatut($id, $statut)
    {
        $stmt = $this->db->prepare("UPDATE Echange_takalo SET statut = :statut WHERE id = :id");
        return $stmt->execute([':statut'=>$statut, ':id'=>$id]);
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM Echange_takalo")->fetchAll();
    }
}
