<?php

namespace App\Model;

class ReviewManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'review';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function reviewSelect()
    {
        return $this->pdo->query("SELECT d.nom, d.prenom, r.note, r.commentaire  from demandeur d join
        $this->table r on r.id_demandeur=d.id")->fetchAll();
    }
}
