<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 20:04
 */

namespace Controller;


class EventController
{
    private $eventRepository;
    private $view;

    /**
     * EventController constructor.
     * @param $eventRepository
     * @param $view
     */
    public function __construct($eventRepository, $view)
    {
        $this->eventRepository = $eventRepository;
        $this->view = $view;
    }


}