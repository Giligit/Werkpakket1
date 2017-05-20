<?php

namespace model;

class Person
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
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

    public function jsonSerialize()
    {
        return [
            'person_id' => $this->id,
            'person_name' => $this->name
        ];
    }

}
