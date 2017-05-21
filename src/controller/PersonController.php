<?php

namespace controller;

use repository\PDOPersonRepository;
use view\PersonJsonView;

class PersonController
{
    private $PDOPersonRepository;
    private $view;

    public function __construct(PDOPersonRepository $PDOPersonRepository, PersonJsonView $view)
    {
        $this->PDOPersonRepository = $PDOPersonRepository;
        $this->view = $view;
    }

    public function findPersonById($id = null)
    {
        $person = $this->PDOPersonRepository->findPersonById($id);
        return $this->view->convertPersonArrayToJson($person);
    }

}
