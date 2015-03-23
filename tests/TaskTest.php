<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    // require_once "src/Category.php";

    // $DB = new PDO('pgsql:host=localhost;dbname=to_do_test');

    class TaskTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Category::deleteAll();
        //     Task::deleteAll();
        // }

        function testGetDescription()
        {
            //Arrange
            $description = "Make a character";
            $test_task = new Task($description);

            //Act
            $result = $test_task->getDescription();

            //Assert
            $this->assertEquals($description, $result);
        }

        function testGetId()
        {
            //Arrange
            $description = "magic_quotes_runtime";
            $id = 66;
            $test_task = new Task($description, $id);

            //Act
            $result = $test_task->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function testSetDescription()
        {
            //Arrange
            $description = "Make a character";
            $id = 9000;
            $test_task = new Task ($description);

            //Act
            $test_task->setDescription("Level up!");

            //Assert
            $result = $test_task->getDescription();
            $this->assertEquals("Level up!", $result);
        }

        function testSetId()
        {
            //Arrange
            $description = "Beat the kobolds";
            $id = 23;
            $test_task = new Task($description, $id);

            //Act
            $test_task->setId(1);

            //Assert
            $result = $test_task->getId();
            $this->assertEquals(1, $result);

        }
    }





















?>
