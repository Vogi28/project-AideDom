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
class LieuManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'lieu';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $place
     * @return int
     */
    public function insert(array $place): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`adresse`, `etage`,`num_appart`,
        `code_postal`, `commune`, `id_demandeur`)
        VALUES (:adress, :floor, :appartNb, :zipCode, :town, :demKey)");
        $statement->bindValue('adress', $place['adress'], \PDO::PARAM_STR);
        $statement->bindValue('floor', $place['floor'], \PDO::PARAM_INT);
        $statement->bindValue('appartNb', $place['appartNb'], \PDO::PARAM_STR);
        $statement->bindValue('zipCode', $place['zipCode'], \PDO::PARAM_STR);
        $statement->bindValue('town', $place['town'], \PDO::PARAM_STR);
        $statement->bindValue('demKey', $place['demKey'], \PDO::PARAM_INT);


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
