<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 20:03
 */
require_once "vendor/autoload.php";
include 'repository\PDOEventRepository.php';
include 'view\EventJsonView.php';
include 'controller\EventController.php';
include 'model\event.php';

use \repository\PDOEventRepository;
use \view\EventJsonView;
use \controller\EventController;
use \model\event;

$user= 'root';
$password ='';
$database='wp1';
$hostname ='127.0.0.1';$pdo = null;

try {
    $pdo=new PDO("mysql:host=$hostname;dbname=$database",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $eventPDORepository = new PDOEventRepository($pdo);
    $eventJsonView = new EventJsonView();
    $eventController = new EventController($eventPDORepository,$eventJsonView);

    $router = new AltoRouter();

    $router->setBasePath('/api/wp1');

    $router->map('GET','/event/[i:id]',
        function($id) use (&$eventController) {
            header("Content-Type: application/json");
            $eventController->handleFindEvenementById($id);
        }
    );

    $router->map('GET','/event',
        function() use (&$eventController) {
            header("Content-Type: application/json");
            $eventController->handleFindEvents();
        }
    );

    $router->map('GET','/event/person/[i:id]',
        function($id) use (&$eventController) {
            header("Content-Type: application/json");
            $eventController->handleFindEventByPerson($id);
        }
    );

    $router->map('GET','/event/from/[:from]/until/[:until]',
        function($from, $until) use (&$eventController) {
            header("Content-Type: application/json");
            $eventController->handleFindEventByDate($from, $until);
        }
    );

    $router->map('GET','/event/person/[i:id]/from/[:from]/until/[:until]',
        function($id, $from, $until) use (&$eventController) {
            header("Content-Type: application/json");
            $eventController->handleFindEventByPersonAndDate($id, $from, $until);
        }
    );


    $router->map('POST','/event/add/[:name]/[:startDate]/[:endDate]/[:person]',
        function($naam, $beginDatum, $eindDatum, $contactPersoon) use (&$eventController) {
            header("Content-Type: application/json");
            $event = new Event(null, $naam, $beginDatum, $eindDatum, $contactPersoon);
            $$eventController->handleAddEvent($event);
        }
    );


    $router->map('PUT','/event/update/[i:id]/[:name]/[:startDate]/[:endDate]/[:person]',
        function($id, $naam, $beginDatum, $eindDatum, $contactPersoon) use (&$eventController) {
            header("Content-Type: application/json");
            $event = new Event($id, $naam, $beginDatum, $eindDatum, $contactPersoon);
            $eventController->handleUpdateEvent($event);
        }
    );

    $router->map('DELETE','/event/delete/[i:id]',
        function($id) use (&$eventController) {
            header("Content-Type: application/json");
            $$eventController->handleDeleteEvent($id);
        }
    );

    $match = $router->match();

    if( $match && is_callable( $match['target'] ) ){
        call_user_func_array( $match['target'], $match['params'] );
    }
} catch (Exception $e) {
    echo $e->getMessage();
}