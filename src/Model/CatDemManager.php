<?php


namespace App\Model;

class CatDemManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'categorie_demandeur';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
