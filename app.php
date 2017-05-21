<?php


use repository\PDOPersonRepository;
use repository\PDOEventRepository;
use view\PersonJsonView;
use view\EventJsonView;
use controller\PersonController;

$user = 'root';
$password = '';
$database = 'wp1';
$pdo = null;

try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=wp1",
        $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);

    $personPDORepository = new PDOPersonRepository($pdo);
    $personJsonView = new PersonJsonView();
    $personController = new PersonController($personPDORepository, $personJsonView);
    $eventPDORepository = new PDOEventRepository($pdo);
    $eventJSonView = new EventJsonView();
    $eventController = new EventJsonView($eventJSonView, $eventPDORepository);

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
    echo $e;
}
?>