<?php

namespace App\Controller;

class MentionsController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Item/mentions.html.twig');
    }
}
