<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class DemManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'demandeur';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $person
     * @return int
     */
    public function insert(array $person): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`prenom`, `nom`, `email`, `telephone`,
            `id_cat_demandeur`, `societe`,`siret`)
        VALUES (:userFirstname, :userLastname, :userMail, :userPhone, :checkPro, :companyName, :numSiret)");
        $statement->bindValue('userFirstname', $person['userFirstname'], \PDO::PARAM_STR);
        $statement->bindValue('userLastname', $person['userLastname'], \PDO::PARAM_STR);
        $statement->bindValue('userMail', $person['userMail'], \PDO::PARAM_STR);
        $statement->bindValue('userPhone', $person['userPhone'], \PDO::PARAM_STR);
        $statement->bindValue('checkPro', $person['checkPro'], \PDO::PARAM_INT);
        $statement->bindValue('companyName', $person['companyName'], \PDO::PARAM_STR);
        $statement->bindValue('numSiret', $person['numSiret'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $item
     * @return bool
     */
    public function update(array $item):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function selectLastId()
    {
        $statement = $this->pdo->prepare("SELECT LAST_INSERT_ID() FROM $this->table");
        $statement->execute();

        return $statement->fetch();
    }
}
