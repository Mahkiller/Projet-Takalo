<?php
require_once __DIR__ . '/../models/PhotoObjet.php';

class PhotoObjetController
{
    public function add($id_objet, $chemin, $est_principale = false)
    {
        $photo = new PhotoObjet();
        return $photo->add($id_objet, $chemin, $est_principale);
    }

    public function index($id_objet)
    {
        $photo = new PhotoObjet();
        return $photo->getByObjet($id_objet);
    }
}
