<?php

require_once 'src/autoload.php';
use \repository\PDOPersonRepository;
use \repository\PDOEventRepository;
use \view\PersonJsonView;
use \controller\PersonController;

$user = 'dario';
$password = 'Test123';
$database = 'wp1';
$pdo = null;

try {
    $pdo = new PDO("mysql:host=localhost;dbname=$database",
        $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);

    $personPDORepository = new PDOPersonRepository($pdo);
    $personJsonView = new PersonJsonView();
    $personController = new PersonController($personPDORepository, $personJsonView);
    $eventPDORepository = new \repository\PDOEventRepository($pdo);
    $eventJSonView = new \view\EventJsonView();
    $eventController = new \controller\EventController($eventJSonView, $eventPDORepository);
    $router = new AltoRouter();
    $router->setBasePath('/~user/Web-Project/api');

    include('routes.php');

    $match = $router->match();

    if($match == false) {
        print ($_SERVER['REQUEST_URI']);
    }

    if($match && is_callable($match['target'])){
        call_user_func_array($match['target'], $match['params']);
    }

} catch (Exception $e) {
    echo 'cannot connect to database';
}
