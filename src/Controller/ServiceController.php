<?php

namespace App\Controller;

class ServiceController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Item/service.html.twig');
    }
}
