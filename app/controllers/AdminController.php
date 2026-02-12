<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Categorie.php';

class AdminController
{
    public function users()
    {
        $user = new User();
        return $user->getAll();
    }

    public function categories()
    {
        $cat = new Categorie();
        return $cat->getAll();
    }
}
