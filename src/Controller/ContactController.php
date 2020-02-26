<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Item/contact.html.twig');
    }

    public function checking()
    {
        $contact = new ContactManager();
        $contact = $contact->insert($_POST);
        if ($contact === true) {
            echo 'Merci pour votre message';
        }
        
        return $this->twig->render('Item/contact.html.twig');
    }
}
