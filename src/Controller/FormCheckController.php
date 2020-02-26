<?php

namespace App\Controller;

class FormCheckController extends AbstractController
{
    public function check()
    {
        $formErrors = [];
//        var_dump($_POST);
        foreach ($_POST as $item => $value) {
            if ($value !== '') {
                if ($item === 'floor' || substr($item, -7) === 'HoursNb' || substr($item, -6) === 'Weight'
                || substr($item, -4) === 'Surf') {
                    if (!$this->checkNumValue($value)) {
                        $error = $item . 'Error';
                        $formErrors[] = $error;
                    }
                }
            }
        }
        $formErrors[] = $this->checkNumberS('numSiret', 9, 14);
        $formErrors[] = $this->checkNumberS('userPhone', 10, 14);
        $formErrors[] = $this->checkNumberS('zipCode', 5, 5);
        $this->checkService();
        $itemPosted = array_filter($_POST);
        $keyPosted = array_keys($itemPosted);
        $formErrors = array_filter($formErrors);
//        var_dump($formErrors);
        return $this->twig->render(
            'Item/_formCheck.html.twig',
            ['itemPosted' => $itemPosted,'keyPosted' => $keyPosted, 'formErrors' => $formErrors]
        );
    }


    public function checkNumberS($item2, $min, $max)
    {
        if ($_POST[$item2] !=='') {
            $filteredNumber = filter_var($_POST[$item2], FILTER_SANITIZE_NUMBER_INT);
            $numberToCheck = str_replace("-", "", $filteredNumber);
            if (strlen($numberToCheck) < $min || strlen($numberToCheck) > $max) {
                return $item2.'Error';
            }
            return null;
        }
        return null;
    }

    public function checkService()
    {
        if ($_POST['services'] === '') {
            $_POST['services'] === $_POST['services2'];
        }
        unset($_POST['services2']);
    }


    public function checkNumValue($number)
    {
        if (!(int)$number) {
            return false;
        } else {
            if ($number === 0) {
                return false;
            }
            return true;
        }
    }
}
