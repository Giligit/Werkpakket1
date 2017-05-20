<?php

use \model\Person;
use \controller\PersonController;

class PersonControllerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockPersonRepository = $this->getMockBuilder('model\PersonRepository')
            ->getMock();
        $this->mockView = $this->getMockBuilder('view\View')
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockPersonRepository = null;
        $this->mockView = null;
    }

    public function testHandleFindPersonById_personFound_stringWithIdName()
    {
        $person = new Person(1, 'testperson');
        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('findPersonById')
            ->will($this->returnValue($person));
        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $person = $object['persons'];
                printf("[{\"id\"=>%d, \"name\"=>%s}]", $person[0]->getId(), $person[0]->getName());
            }));
        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindPersonById($person->getId());
        $this->expectOutputString(sprintf("[{\"id\"=>%d, \"name\"=>%s}]", $person->getId(), $person->getName()));
    }

    public function test_handleFindPersonById_personFound_returnStringEmpty()
    {
        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('findPersonById')
            ->will($this->returnValue(null));

        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                echo '';
            }));
        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindPersonById(1);
        $this->expectOutputString('');
    }

    public function testHandleFindPersons_personsFound_stringWithIdName()
    {
        $person1 = new Person(1, 'testperson1');
        $person2 = new Person(2, 'testperson2');
        $persons = [$person1, $person2];
        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('findPersons')
            ->will($this->returnValue([$person1, $person2]));
        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                $persons = $object['persons'];
                echo json_encode($persons);
            }));
        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindPersons();
        $this->expectOutputString(json_encode($persons));
    }

    public function test_handleFindPersons_NoPersonFound_returnStringEmpty()
    {

        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('findPersons')
            ->will($this->returnValue([]));

        $this->mockView->expects($this->atLeastOnce())
            ->method('show')
            ->will($this->returnCallback(function ($object) {
                echo '[]';
            }));
        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindPersons();
        $this->expectOutputString('[]');
    }


}
