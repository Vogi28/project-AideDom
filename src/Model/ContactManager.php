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
class ContactManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'contact';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $var
     * @return bool
     */
    public function insert(array $var)
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`nom`, `email`,`message`)
        VALUES (:nom, :email, :message)");
        $statement->bindValue('nom', $var['nom'], \PDO::PARAM_STR);
        $statement->bindValue('email', $var['email'], \PDO::PARAM_STR);
        $statement->bindValue('message', $var['message'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return true;
        }
    }
}
