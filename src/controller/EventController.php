<?php
/**
 * Created by PhpStorm.
 * User: Gilisen
 * Date: 17/05/2017
 * Time: 15:20
 */

namespace controller;


class EventController
{
    private $eventView, $eventRepository;

    public function __construct($eventView, $eventRepository)
    {
        $this->eventView = $eventView;
        $this->pdoEventRepository = $eventRepository;
    }

    public function handleFindEventById($id)
    {
        $event = $this -> eventRepository ->handleFindEventById($id);
        return $this->eventView->convertEventArrayToJson($event);
    }

    public function handleFindEvents()
    {
        $events = $this -> eventRepository -> handleFindEvents();
        return $this->eventView->convertEventArrayToJson($events);
    }

    public function handleCreateEvent($events)
    {
        $this->eventRepository->handleCreateEvent($events);

    }
    public function handleEditEvent($events)
    {
        $this->eventRepository->handleEditEvent($events);
    }

    public function handleDeleteEventById($id)
    {
        $this->pdoEventRepository->handleDeleteEventById($id);
    }
}