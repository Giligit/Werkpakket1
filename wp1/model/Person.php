<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 22/05/2017
 * Time: 12:09
 */

namespace model;


class Person
{
    private $id;
    private $name;
    private $e_mail;

    /**
     * Person constructor.
     * @param $id
     * @param $name
     * @param $e_mail
     */
    public function __construct($id, $name, $e_mail)
    {
        $this->id = $id;
        $this->name = $name;
        $this->e_mail = $e_mail;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEMail()
    {
        return $this->e_mail;
    }

    /**
     * @param mixed $e_mail
     */
    public function setEMail($e_mail)
    {
        $this->e_mail = $e_mail;
    }



}