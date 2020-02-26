<?php

namespace App\Model;

class AdminDemandeManager extends AbstractManager
{
    const TABLE = 'prestation'; /* alias p */
    const TDEMANDEUR = 'demandeur'; /* alias d */
    const TDETPRESTA = 'details_presta'; /* alias dp */
    const TLIEU = 'lieu'; /* alias l*/
    const TCATDEMANDEUR = 'categorie_demandeur';/* alias cd */
    const TCATSERV = 'categorie_service'; /* alias cs*/
    const TARCHIVE = 'archive';
    /**
     *  Initializes this class.
     *
     *  ,
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
    /* le self permet de reperer la constante au niveau de la classe*/
    public function selectAllDemande()
    {
        $requete = "SELECT * FROM 
        $this->table p, ".self::TDEMANDEUR." d, ".self::TDETPRESTA." dp, ".self::TLIEU." l, ".self::TCATDEMANDEUR." cd
        WHERE p.id_demandeur=d.id AND p.id_lieu=l.id AND dp.id_prestation=p.id AND d.id_cat_demandeur=cd.id limit 10";

        return $this->pdo->query($requete)->fetchAll();
    }

    public function selectOneByIdPrestation($id)
    {
        $requete = "SELECT * FROM 
        $this->table p,".self::TCATSERV." cs, ".self::TDEMANDEUR." d, ".self::TDETPRESTA." dp, ".self::TLIEU." l,
        ".self::TCATDEMANDEUR." cd 
        WHERE p.id_demandeur=d.id
        AND p.id_lieu=l.id AND dp.id_prestation=p.id AND p.id=:id AND d.id_cat_demandeur=cd.id
        AND dp.id_categorie_service=cs.id";
        $statement = $this->pdo->prepare($requete);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function delete(int $id)
    {
        $requete = "DELETE FROM 
        $this->table p,".self::TLIEU." l,
        WHERE p.id=:id
        AND p.id_lieu=l.id";
        $statement = $this->pdo->prepare($requete);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function selectStatus($status, $id)
    {
        var_dump($status);
        var_dump($id);
        if ($status['choixEtat'] === 'Pris en charge') {
            $statement = $this->pdo->prepare("update $this->table set etat=1 where id=:id");
            $statement->bindValue('id', $id, \PDO::PARAM_INT);
            $statement->execute();
            header('Location: /AdminDemande/index');
        } elseif ($status['choixEtat'] === 'Archivé') {
            $statement = $this->pdo->prepare("update $this->table set etat=2 where id=:id");
            $statement->bindValue('id', $id, \PDO::PARAM_INT);
            $statement->execute();
            header('Location: /AdminDemande/index');
        }
    }
}
