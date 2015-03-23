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

        // function testGetId()
        // {
        //     //Arrange
        //
        //     //Act
        //
        //     //Assert
        // }
        //
        // function testSetName()
        // {
        //     //Arrange
        //
        //     //Act
        //
        //     //Assert
        // }
        //
        // function testSetId()
        // {
        //     //Arrange
        //
        //
        //     //Act
        //
        //     //Assert
        //
        // }
    }





















?>
