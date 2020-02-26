<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{

    public function login()
    {

        if (session_status() === 1) {
            session_start();
            
            session_regenerate_id(true);
            
            return $this->twig->render('Admin/adminLogin.html.twig', ['session' => $_SESSION]);
        } else {
            return $this->twig->render('Admin/adminPage.html.twig');
        }
    }

    public function index()
    {
        $adminHome = new AdminManager();
        $adminHome = $adminHome->select();

        return $this->twig->render('Admin/adminPage.html.twig', ['adminHome' => $adminHome]);
    }

    public function checking()
    {
        session_start();

        if ($_POST) {
            $_SESSION['admin'] = $_POST['admin'];
            $_SESSION['password'] = $_POST['password'];
            
            $adminManager = new AdminManager();
            $adminLogin = $adminManager->AdminConnnection($_SESSION['admin'], $_SESSION['password']);
            
            if ($adminLogin === false) {
                return $this->twig->render('/Admin/adminLogin.html.twig', ['admin' => 'Login or password incorrect!']);
            } else {
                header('Location: ../AdminDemande/index');
                // return $this->twig->render('/Admin/Demandes/index.html.twig', ['admin' => $adminLogin]);
            }
        }
    }

    // public function mailing()
    // {
    //     var_dump($_POST);
    //     die();
    //     function sanitizeMyEmail($field)
    //     {
    //         $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    //         if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     }
        
    //     $toEmail = 'name @ company . com';
    //     $subject = 'Testing PHP Mail';
    //     $message = 'This mail is sent using the PHP mail ';
    //     $headers = 'From: noreply @ company. com';
    //     //check if the email address is invalid $secure_check
    //     $secureCheck = sanitize_my_email($toEmail);
    //     if ($secureCheck == false) {
    //         echo "Invalid input";
    //     } else { //send email
    //         mail($toEmail, $subject, $message, $headers);
    //         echo "This email is sent using PHP Mail";
    //     }
    // }
}
