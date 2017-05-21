<?php
/**
 * Created by PhpStorm.
 * User: Gilisen
 * Date: 17/05/2017
 * Time: 15:20
 */

namespace controller;

use repository\PDOEventRepository;
use view\EventJsonView;

class EventController
{
    private $eventView, $eventRepository;

    public function __construct(EventJsonView $eventView,PDOEventRepository $eventRepository)
    {
        $this->eventView = $eventView;
        $this->pdoEventRepository = $eventRepository;
    }

    public function findEventByID($id)
    {
        $event = $this -> eventRepository ->findEventByID($id);
        return $this->eventView->convertEventArrayToJson($event);
    }

    public function findEventsList()
    {
        $events = $this -> eventRepository ->findEventsList();
        return $this->eventView->convertEventArrayToJson($events);
    }
    public function findEventsByPerson($person){
        $eventArray = $this->pdoEventRepository->findEventsByPerson($person);
        return $this-> eventView->convertEventArrayToJson($eventArray);
    }

    public function createEvent($events)
    {
        $this->eventRepository->createEvent($events);

    }
    public function editEvent($events)
    {
        $this->eventRepository->editEvent($events);
    }

    public function deleteEventById($id)
    {
        $this->pdoEventRepository->deleteEventById($id);
    }
}