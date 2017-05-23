<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 21:09
 */

use controller\EventController;
use repository\PDOEventRepository;
use model\Event;
use model\Person;
use view\EventJsonView;

class EventControllerTest extends \PHPUnit\Framework\TestCase {

    public function testPOST()
    {
        $client = new Client('http://localhost:80');

        $request = $client->get('/api/wp1/events');
        $response = $request->send();
        $this->assertEquals(200, $response->getStatusCode());
    }

}