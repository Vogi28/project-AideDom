<?php

namespace App\Controller;

//var_dump($_POST);

use App\Model\DemManager;
use App\Model\CatDemManager;
use App\Model\DetailsPrestaManager;
use App\Model\LieuManager;
use App\Model\CatServManager;
use App\Model\PrestaManager;

class FormController extends AbstractController
{
    protected $idCatServ;


    public function index()
    {
        return $this->twig->render('Item/_form.html.twig');
    }


    public function add()
    {
//            -------------- Add demandeur + recup id categorie_demandeur----------------
        var_dump($_POST);
        $postAddDem = new DemManager();
        $postCatDem = new CatDemManager();

        $_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['checkPro'] === 'yes' ?
        $catDem = $postCatDem->selectOneById(2): $catDem = $postCatDem->selectOneById(1);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['checkPro'] === 'yes') {
            $catDem = $postCatDem->selectOneById(2);
        } else {
            $catDem = $postCatDem->selectOneById(1);
        }

        $cleCatDem = $catDem['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postAddItemsDem = ['userFirstname' => $_POST['userFirstname'],
            'userLastname' => $_POST['userLastname'],
            'userMail' => $_POST['userMail'],
            'userPhone' => $_POST['userPhone'],
            'checkPro' => $cleCatDem,
            'companyName'=> $_POST['companyName'],
            'numSiret' => $_POST['numSiret']];
            $postAddDem->insert($postAddItemsDem);
        }
//            -------------- Add lieu + recup cle etrangere demandeur----------------
        $postAddLieu = new LieuManager();
        $cleDem = $postAddDem->selectLastId();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postAddItemsLieu = ['adress' => $_POST['adress'],
            'floor' => $_POST['floor'],
            'appartNb' => $_POST['appartNb'],
            'zipCode' => $_POST['zipCode'],
            'town' => $_POST['town'],
            'demKey' => $cleDem['LAST_INSERT_ID()']];
            $postAddLieu->insert($postAddItemsLieu);
        }
//            -------------- Add presta + recup cles etrangeres demandeur et lieu----------------
        $postAddPresta = new PrestaManager();
        $cleDem2 = $postAddDem->selectLastId();
        $cleLieu = $postAddLieu->selectLastId();
        $dateNow = date('d-m-Y');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postAddItemsPresta = ['demKey' => $cleDem2['LAST_INSERT_ID()'],
            'lieuKey' => $cleLieu['LAST_INSERT_ID()'],
            'dateNow' => $dateNow,
            'state' =>'reçu'];

            $postAddPresta->insert($postAddItemsPresta);
        }
//            -------------- Add details presta + recup id categorie_service + recup cle etrangere presta ----------
        $postAddDetailsPresta = new DetailsPrestaManager();
        $postCatServ = new CatServManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->choixServ();
            $catServ = $postCatServ->selectOneById($this->idCatServ);
            $cleCatServ = $catServ['id'];
            $clePresta = $postAddPresta->selectLastId();
            $postAddItDetPresta = ['prestaKey' => $clePresta['LAST_INSERT_ID()'],
            'chooseServ' => $cleCatServ,
            'cleanHoursNb' => $_POST['cleanHoursNb'],
            'cleanSurf' => $_POST['cleanSurf'],
            'cleanComments' => $_POST['cleanComments'],
            'ironHoursNb' => $_POST['ironHoursNb'],
            'cottonClothesWeight' => $_POST['cottonClothesWeight'],
            'otherClothesWeight' => $_POST['otherClothesWeight'],
            'bedLinenWeight' => $_POST['bedLinenWeight'],
            'tableLinenWeight' => $_POST['tableLinenWeight'],
            'gardenHoursNb' => $_POST['gardenHoursNb'],
            'gardenSurf' => $_POST['gardenSurf'],
            'gardenComments' => $_POST['gardenComments']];
            $postAddDetailsPresta->insert($postAddItDetPresta);
        }
        return $this->twig->render('Home/index.html.twig');
    }

    public function choixServ()
    {
        switch ($_POST['services']) {
            case 'cleaning':
                $this->idCatServ = 1;
                break;
            case 'ironing':
                $this->idCatServ = 2;
                break;
            case 'gardening':
                $this->idCatServ = 3;
                break;
            case 'cleaning_ironing':
                $this->idCatServ = 4;
                break;
            case 'cleaning_gardening':
                $this->idCatServ = 5;
                break;
            case 'ironing_gardening':
                $this->idCatServ = 6;
                break;
            case 'cleaning_ironing_gardening':
                $this->idCatServ = 7;
                break;

            return $this->idCatServ;
        }
    }
}
