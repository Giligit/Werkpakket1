<?php

namespace model;

class Person
{
    private $id;
    private $name;
    private $person_email;

    public function __construct($id, $name, $person_email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->person_email = $person_email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPersonEmail()
    {
        return $this->person_email;
    }

    /**
     * @param mixed $person_email
     */
    public function setPersonEmail($person_email)
    {
        $this->person_email = $person_email;
    }


}
