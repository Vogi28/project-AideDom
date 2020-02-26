<?php

namespace App\Controller;

class ConfidentialiteController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Item/confidentialite.html.twig');
    }
}
