<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 12:22
 */

namespace repository;


interface PersonRepository
{
    public function findPersonById($id);

}