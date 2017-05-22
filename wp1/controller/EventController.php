<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 20:04
 */

namespace Controller;

use repository\EventRepository;
use view\EventJsonView;
use model\event;


class EventController
{
    private $eventRepository;
    private $view;

    /**
     * EventController constructor.
     * @param $eventRepository
     * @param $view
     */
    public function __construct(EventRepository $eventRepository,  EventJsonView $view)
    {
        $this->eventRepository = $eventRepository;
        $this->view = $view;
    }

    public function handleFindEvents(){
        $event = $this->eventRepository->findEvents();
        echo json_encode($event, JSON_PRETTY_PRINT);

    }

    public function handleFindEvenementById($id){
        $event = $this->eventRepository->findEventsById($id);
        echo json_encode($event, JSON_PRETTY_PRINT);
    }

    public function handleFindEventByPerson($person){
        $event = $this->eventRepository->findEventByPerson($person);
        echo json_encode($event, JSON_PRETTY_PRINT);
    }

    public function handleFindEventByDate($startDate, $endDate){
        $event = $this->eventRepository->findEventByDate($startDate,$endDate);
        echo json_encode($event, JSON_PRETTY_PRINT);
    }

    public function handleFindEventByPersonAndDate($person,$startDate, $endDate){
        $event = $this->eventRepository->findEventByPersonAndDate($person,$startDate,$endDate);
        echo json_encode($event, JSON_PRETTY_PRINT);
    }

    public function handleAddEvent($event){
        $event = $this->eventRepository->addEvent($event);
        echo json_encode($event,JSON_PRETTY_PRINT);
    }

    public function handleUpdateEvent($event){
        $event = $this->eventRepository->updateEvent($event);
        echo json_encode($event,JSON_PRETTY_PRINT);
    }

    public function handleDeleteEvent($id){
        $event = $this->eventRepository->deleteEvent($id);
        echo json_encode($event,JSON_PRETTY_PRINT);
    }




}