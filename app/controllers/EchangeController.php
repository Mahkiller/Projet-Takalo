<?php
require_once __DIR__ . '/../models/Echange.php';

class EchangeController
{
    public function proposer($id_objet1, $id_objet2, $id_user1, $id_user2)
    {
        $echange = new Echange();
        return $echange->proposer($id_objet1, $id_objet2, $id_user1, $id_user2);
    }

    public function changerStatut($id, $statut)
    {
        $echange = new Echange();
        return $echange->changerStatut($id, $statut);
    }

    public function index()
    {
        $echange = new Echange();
        return $echange->getAll();
    }
}
