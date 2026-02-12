<?php
require_once __DIR__ . '/../models/Objet.php';
require_once __DIR__ . '/../models/PhotoObjet.php';
require_once __DIR__ . '/../models/Categorie.php';

class ObjectController
{
    public function index()
    {
        $objet = new Objet();
        return $objet->getAllWithUserAndCategorie();
    }

    public function create($id_user, $id_categorie, $titre, $description, $prix, $photos = [])
    {
        $objetModel = new Objet();
        $photoModel = new PhotoObjet();

        // Créer l'objet
        $objetModel->create($id_user, $id_categorie, $titre, $description, $prix);

        // Récup dernier id créé
        $lastId = Database::getInstance()->lastInsertId();

        // Upload des photos
        foreach($photos['tmp_name'] as $key => $tmp_name){
            if($photos['error'][$key] === 0){
                $filename = uniqid() . '_' . basename($photos['name'][$key]);
                $target = __DIR__ . '/../../public/assets/uploads/' . $filename;
                move_uploaded_file($tmp_name, $target);

                // Ajouter en DB
                $photoModel->add($lastId, 'assets/uploads/' . $filename, $key === 0);
            }
        }
    }
}
