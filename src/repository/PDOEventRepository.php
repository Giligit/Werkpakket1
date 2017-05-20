<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 17/05/2017
 * Time: 12:30
 */
namespace repository;

class PDOEventRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


}