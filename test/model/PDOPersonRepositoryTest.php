<?php

use \model\Person;
use \model\PDOPersonRepository;

class PDORepositoryTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockPDO = $this->getMockBuilder('PDO')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockPDOStatement = $this->getMockBuilder('PDOStatement')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
    }

    public function testFindPersonById_idExists_PersonObject()
    {
        $person = new Person(1, 'testperson');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['id' => $person->getId(), 'name' => $person->getName()]]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPerson = $pdoRepository->findPersonById($person->getId());
        $this->assertEquals($person, $actualPerson);
    }

    public function testFindPersonById_idDoesNotExist_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPerson = $pdoRepository->findPersonById(1);
        $this->assertNull($actualPerson);
    }


    public function testFindPersonById_exeptionThrownFromPDO_Null()
    {
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')->will($this->throwException(new Exception()));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPerson = $pdoRepository->findPersonById(1);
        $this->assertNull($actualPerson);
    }


    public function testFindPersons_personsInResultSet_ArrayPersonObjects()
    {
        $person1 = new Person(1, 'testperson1');
        $person2 = new Person(2, 'testperson2');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([['id' => $person1->getId(), 'name' => $person1->getName()], ['id' => $person2->getId(), 'name' => $person2->getName()]]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPersons = $pdoRepository->findPersons();
        $this->assertEquals([$person1, $person2], $actualPersons);
    }


    public function testFindPersons_noData_EmptyArray()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPersons = $pdoRepository->findPersons();
        $this->assertEmpty($actualPersons);
    }

    public function testFindPersons_exeptionThrownFromPDO_EmptyArray()
    {
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')->will($this->throwException(new Exception()));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPersons = $pdoRepository->findPersons(1);
        $this->assertEmpty($actualPersons);
    }

}
