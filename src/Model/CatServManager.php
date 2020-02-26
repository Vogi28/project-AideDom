<?php


namespace App\Model;

class CatServManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'categorie_service';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
