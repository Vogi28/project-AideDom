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
class PrestaManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'prestation';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $prestation
     * @return int
     */
    public function insert(array $prestation): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`id_demandeur`, `id_lieu`, `date`, `etat`)
        VALUES (:demKey, :lieuKey, :dateNow, :state)");
        $statement->bindValue('demKey', $prestation['demKey'], \PDO::PARAM_INT);
        $statement->bindValue('lieuKey', $prestation['lieuKey'], \PDO::PARAM_INT);
        $statement->bindValue('dateNow', $prestation['dateNow'], \PDO::PARAM_STR);
//        $statement->bindParam (":date", strtotime (date ("Y-m-d H:i:s")), PDO::PARAM_STR);
        $statement->bindValue('state', $prestation['state'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

/*$requete = "INSERT INTO beast (`name`, `picture`, `size`, `area`, `id_movie`,`id_planet`) ";
$requete .= "VALUES (:name, :picture, :size, :area, :id_movie, :id_planet)";
$statement = $this->pdo->prepare($requete);
$statement->bindValue('name', $beast['name'], \PDO::PARAM_STR);
$statement->bindValue('picture', $beast['picture'], \PDO::PARAM_STR);
$statement->bindValue('size', $beast['size'], \PDO::PARAM_INT);
$statement->bindValue('area', $beast['area'], \PDO::PARAM_STR);
$statement->bindValue('id_movie', $beast['id_movie'], \PDO::PARAM_INT);
$statement->bindValue('id_planet', $beast['id_planet'], \PDO::PARAM_INT);*/


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
