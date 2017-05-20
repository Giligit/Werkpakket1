<?php

namespace controller;

use repository\PDOPersonRepository;
use view\View;

class PersonController
{
    private $PDOPersonRepository;
    private $view;

    public function __construct(PDOPersonRepository $PDOPersonRepository, View $view)
    {
        $this->PDOPersonRepository = $PDOPersonRepository;
        $this->view = $view;
    }

    public function handleFindPersonById($id = null)
    {
        $person = $this->PDOPersonRepository->findPersonById($id);
        $this->view->show(['persons' => [$person]]);
    }


}
