<?php


namespace App\Controller;

use App\Model\AdminDemandeManager;
use App\Model\PrestaManager;

class AdminDemandeController extends AbstractController
{
    public function index()
    {
        $adminDemandeManager = new AdminDemandeManager();
        $demandes = $adminDemandeManager->selectAllDemande();
        return $this->twig->render('Admin/Demandes/index.html.twig', ['demandes'=>$demandes]);
    }

    public function show(int $id)
    {
        $adminInfosManager = new AdminDemandeManager();
        $adminInfos = $adminInfosManager->selectOneByIdPrestation($id);

        return $this->twig->render('Admin/Demandes/show.html.twig', ['adminInfos'=>$adminInfos]);
    }

    public function delete(int $id)
    {
        $deleteManager = new PrestaManager();
        $deleteManager->delete($id);
        header('Location:/AdminDemande/index');
    }

    public function status($id)
    {
        $status = new AdminDemandeManager();
        $status = $status->selectStatus($_POST, $id);
    }
    public function logOut()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
    }
}
