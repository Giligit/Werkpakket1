<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 20:24
 */

namespace Controller;

use repository\PersonRepository;
use view\View;

class PersonController
{
    private $personRepository;
    private $view;

    /**
     * PersonController constructor.
     * @param $personRepository
     * @param $view
     */
    public function __construct(PersonRepository $personRepository, View $view)
    {
        $this->personRepository = $personRepository;
        $this->view = $view;

    }

    public function handleFindPersonById($id = null){
        $person = $this->personRepository->findPersonById($id);
        $this->view->show(['person' => $person]);
    }


}