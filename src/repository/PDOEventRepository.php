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
        $id =$events['id']; // nog kijken wat hiermee moet gebeuren.
        $name= $events['name'];
        $startDate = $events['startDate'];
        $endDate = $events['endDate'];
        $person = $events['person'];
        $stmt = $this->pdo->prepare("INSERT INTO events (name, startDate, endDate, person)VALUES (:name, :startDate, :endDate, :person)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':person', $person);
        exec($stmt);
    }
    public function editEvent($events)
    {
        $id = events['id'];
        $name = $events['name'];
        $startDate = $events['startDate'];
        $endDate = $events['endDate'];
        $person = $events['person'];
        $this -> findEventByID($id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':person', $person);
        exec($stmt);
    }
    public function deleteEventById($id)
    {
        $this->findEventByID($id);
        $stmt = $this->pdo->prepare("DELETE FROM events WHERE id = :id");
        exec($stmt);
    }
}