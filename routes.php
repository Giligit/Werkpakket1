<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 21/05/2017
 * Time: 16:15
 */

//Get person by ID
$router->map('GET','/persons/[i:id]',
    function($id) use (&$personController) {
        print($personController->findPersonById($id));
    }
);

//GET event by ID
$router->map('GET', '/events/[i:id]',
    function($id) use (&$eventController) {
        print ($eventController->findEventById($id));
    }
);

//GET all events
$router->map('GET', '/events',
    function() use (&$eventController){
        print($eventController->findEventsList());
    }
);

//GET events by person
$router->map('GET', '/events/person/[i:id]',
    function ($id) use (&$eventController, &$personController){
        $person = $personController->findPersonById($id);
        print($eventController->findEventsByPerson($person));
    });

//GET events by date


//GET events by person and date


//POST event
$router->map('POST', '/events',
    function ($eventArray)
    use(&$eventController){
        $eventController->createEvent($eventArray);
    });

//DELETE event by ID
$router->map('DELETE','/events/[i:id]',
    function ($id) use (&$eventController){
        $eventController->deleteEventById($id);
    }
);
