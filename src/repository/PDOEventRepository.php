<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 17/05/2017
 * Time: 12:30
 */
namespace repository;

class PDOEventRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findEventByID($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM events WHERE ID = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $record=$stmt->fetch();
        if($record != false)
        {
            $id = $record['id'];
            $startDate = $record['startdate'];
            $endDate = $record['enddate'];
            $name = $record['name'];
            $person = $record['person'];
            $event = new Event();
            $event->setId($id);
            $event->setStartDate($startDate);
            $event->setEndDate($endDate);
            $event->setName($name);
            $event->setPerson($person);

        }
        return $event;
    }

    public function findEventsList()
    {
        $events = array();
        $counter = 0;
        $stmt = $this -> pdo ->query('SELECT * FROM events');
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $event){
            $events[$counter++] = $event;
        }
        return $events;
    }

    public function findEventsByPerson($person)
    {
        $person= json_decode($person);
        $stmt = $this ->pdo ->query('SELECT * FROM events WHERE person =:person');
        $stmt -> bindParam(':person', $person['id'], PDO::PARAM_INT);
        $stmt -> execute();
        $events = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        return $events;

    }

    public function createEvent($events)
    {
        $id =$events['id'];
        $name= $events['name'];
    }
}