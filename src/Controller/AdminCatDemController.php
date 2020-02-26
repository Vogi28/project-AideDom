<?php

namespace App\Controller;

use App\Model\CatDemManager;

class AdminCatDemController extends AbstractController
{
    public function index()
    {
        $managerCatDem = new CatDemManager();
        $catDems = $managerCatDem->selectAll();

        return $this->twig->render("Admin/CatDem/index.html.twig", ['catDems'=>$catDems]);
    }
}
