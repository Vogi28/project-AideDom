<?php

namespace App\Model;

class AdminManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'admin';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function select()
    {
        $statement = $this->pdo->prepare('SELECT p.id, c.categorie_demandeur,dp.id_categorie_service, d.nom,
        d.societe from demandeur d join categorie_demandeur c on c.id=d.id_cat_demandeur join prestation p
        on p.id_demandeur=d.id join details_presta dp on dp.id_prestation=p.id join categorie_service s on
        s.id=dp.id_categorie_service');
        $statement->execute();
        return $statement->fetchAll();
    }

    public function insert(array $item): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`login_admin`) VALUES (':login_admin')");
        $statement->bindValue('login_admin', $item['login_admin'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function adminConnnection($admin, $pass)
    {
        $adminLogin = $this->pdo->query("SELECT * from $this->table")->fetchAll();
        if ($admin != $adminLogin[0]['login_admin'] || $pass != $adminLogin[0]['mdp_admin']) {
            return false;
        } else {
            return $adminLogin;
        }
    }
}
