<?php

namespace App\Controller;

class QuiSommesNousController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Item/quisommesnous.html.twig');
    }
}
