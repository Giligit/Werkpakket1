<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 13:00
 */

namespace repository;


use model\Person;

class PDOPersonRepository implements PersonRepository
{

    private $connection = null;
    /**
     * PDOPersonRepository constructor.
     */
    public function __construct(\PDO $connection)
    {
        $this->connection  = $connection;
    }

    public function findPersonById($id)
    {

        try{
            $statement = $this->connection->prepare('SELECT * FROM personen WHERE personID='.$id);
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if(count($results) > 0) {
                return new Person($results[0]['id'], $results[0]['name'],$results[0]['e_mail']);
            }else{
                return null;
            }
        } catch (\Exception $exception){
            print $exception;
        }
    }
}