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
class DetailsPrestaManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'details_presta';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $prestaDetails
     * @return int
     */
    public function insert(array $prestaDetails): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`id_prestation`, `id_categorie_service`,
            `nb_heures_menage`, `surface_menage`, `details_menage`,
             `nb_heures_repassage`,`poids_coton`,`poids_autres`,`poids_linge_lit`,`poids_linge_table`,
             `nb_heures_jardin`, `surface_jardin`, `details_jardinage`)
        VALUES (:prestaKey, :chooseServ, :cleanHoursNb, :cleanSurf, :cleanComments,
            :ironHoursNb, :cottonClothesWeight, :otherClothesWeight, :bedLinenWeight, :tableLinenWeight,
            :gardenHoursNb, :gardenSurf, :gardenComments)");
        $statement->bindValue('prestaKey', $prestaDetails['prestaKey'], \PDO::PARAM_INT);
        $statement->bindValue('chooseServ', $prestaDetails['chooseServ'], \PDO::PARAM_INT);
        $statement->bindValue('cleanHoursNb', $prestaDetails['cleanHoursNb'], \PDO::PARAM_INT);
        $statement->bindValue('cleanSurf', $prestaDetails['cleanSurf'], \PDO::PARAM_INT);
        $statement->bindValue('cleanComments', $prestaDetails['cleanComments'], \PDO::PARAM_STR);
        $statement->bindValue('ironHoursNb', $prestaDetails['ironHoursNb'], \PDO::PARAM_INT);
        $statement->bindValue('cottonClothesWeight', $prestaDetails['cottonClothesWeight'], \PDO::PARAM_INT);
        $statement->bindValue('otherClothesWeight', $prestaDetails['otherClothesWeight'], \PDO::PARAM_INT);
        $statement->bindValue('bedLinenWeight', $prestaDetails['bedLinenWeight'], \PDO::PARAM_INT);
        $statement->bindValue('tableLinenWeight', $prestaDetails['tableLinenWeight'], \PDO::PARAM_INT);
        $statement->bindValue('gardenHoursNb', $prestaDetails['gardenHoursNb'], \PDO::PARAM_INT);
        $statement->bindValue('gardenSurf', $prestaDetails['gardenSurf'], \PDO::PARAM_INT);
        $statement->bindValue('gardenComments', $prestaDetails['gardenComments'], \PDO::PARAM_STR);

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
