<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 12:16
 */

namespace repository;


interface EventRepository
{
    public function findEvents();
    public function findEventsById($id);
    public function findEventByPerson($personId);
    public function findEventByDate($startDate,$endDate);
    public function findEventByPersonAndDate($personId, $startDate, $endDate);

    public function addEvent($event);
    public function updateEvent($event);
    public function deleteEvent($id);

}