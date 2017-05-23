<?php
/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 22-5-2017
 * Time: 21:48
 */
class testEventController extends PHPUnit
{

    public function testPOST()
    {
        $client = new Client('http://localhost:80');

        $request = $client->get('/api/wp1/events');
        $response = $request->send();
        $this->assertEquals(200, $response->getStatusCode());
    }
}