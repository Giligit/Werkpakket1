<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 18:11
 */

namespace repository;


use model\Event;

class PDOEventRepository implements eventRepository
{
    private $connection = null;

    /**
     * PDOEventRepository constructor.
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findEvents()
    {
        try{
            $statement=$this->connection->prepare('SELECT * FROM events');
            $statement->execute();
            $results=$statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = null;
            if(count($results) > 0) {
                foreach ($results as $event) {
                    array_push($arrayResults, new Event($event['id'], $event['name'], $event['startDate'], $event['endDate'], $event['person']));
                }
                return $arrayResults;
            }else{
                return null;
            }
        }catch (\Exception $exception) {
            return $exception;
        }
    }

    public function findEventsById($id)
    {

        try{
            $statement = $this->connection->prepare("SELECT * FROM events WHERE eventID =".$id);
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);


            if (count($results) > 0) {
                return new Event($results[0]['id'], $results[0]['name'], $results[0]['startDate'], $results[0]['endDate'], $results[0]['person']);

            } else {
                return null;
            }
        }catch(\Exception $exception){
            return $exception;
        }
    }

    public function findEventByPerson($personId)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM events WHERE contactPersoon ='.$personId);
            $statement->bindParam(1, $personId, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = null;

            if(count($results) > 0) {
                foreach($results as $event) {
                    array_push($arrayResults, new Event($event['id'],$event['name'], $event['startDate'], $event['endDate'],$event['person']));

                }
                return $arrayResults;
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function findEventByDate($startDate, $endDate)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM Events WHERE startDate = ? AND endDate = ?');
            $statement->bindParam(1, $startDate, \PDO::PARAM_STR);
            $statement->bindParam(2, $endDate, \PDO::PARAM_STR);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            $arrayResults = array();

            if (count($results) > 0) {
                foreach ($results as $event) {
                    array_push($arrayResults, new Event($event['id'], $event['name'], $event['startDate'], $event['endDate'], $event['person']));
                }
                return $arrayResults;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function findEventByPersonAndDate($personId, $startDate, $endDate)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM Events WHERE startDate = ? AND endDate = ? AND contactPersoon = ?');
            $statement->bindParam(1, $startDate, \PDO::PARAM_STR);
            $statement->bindParam(2, $endDate, \PDO::PARAM_STR);
            $statement->bindParam(3, $personId, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            $arrayResults = null;

            if (count($results) > 0) {
                foreach ($results as $event) {
                    array_push($arrayResults, new Event($event['id'], $event['name'], $event['startDate'], $event['endDate'], $event['person']));
                }
                return $arrayResults;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function addEvent($event)
    {
        $event->setName(str_replace('%20',' ', $event->getName()));
        $event->setStartDate(str_replace('%20', ' ', $event->getStartDate()));
        $event->setEndDate(str_replace('%20', ' ', $event->getEndDate()));
        $event->setPerson(str_replace('%20', ' ', $event->getPerson()));

        try {
            $statement = $this->connection->prepare('INSERT INTO Events(name, startDate, endDate, Person) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $statement->bindParam(1, $event->getName(), \PDO::PARAM_STR);
            $statement->bindParam(2, $event->getStartDate(), \PDO::PARAM_STR);
            $statement->bindParam(3, $event->getEndDate(), \PDO::PARAM_STR);
            $statement->bindParam(4, $event->getPerson(), \PDO::PARAM_INT);

            $statement->execute();
            return 'finished';
        }catch (\Exception $exception){
            return $exception;
        }

    }

    public function updateEvent($event)
    {
        $event->setName(str_replace('%20',' ', $event->getName()));
        $event->setStartDate(str_replace('%20', ' ', $event->getStartDate()));
        $event->setEndDate(str_replace('%20', ' ', $event->getEndDate()));
        $event->setPerson(str_replace('%20', ' ', $event->getPerson()));

        try {
            $statement = $this->connection->prepare('UPDATE events SET name = ?, startDate = ?, endDate = ?,contactpersoon = ? WHERE eventID = ?');
            $statement->bindParam(1, $event->getName(), \PDO::PARAM_STR);
            $statement->bindParam(2, $event->getStartDate(), \PDO::PARAM_STR);
            $statement->bindParam(3, $event->getEndDate(), \PDO::PARAM_STR);
            $statement->bindParam(4, $event->getPerson(), \PDO::PARAM_INT);

            $statement->execute();
            return 'finished';
        }catch (\Exception $exception){
            return $exception;
        }


    }

    public function deleteEvent($id)
    {
        try {
            $statement = $this->connection->prepare('DELETE FROM Events WHERE eventID = ?');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            echo 'done!';
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}