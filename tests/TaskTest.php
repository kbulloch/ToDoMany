<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once "src/Task.php";
    require_once "src/Category.php";

    // $DB = new PDO('pgsql:host=localhost;dbname=to_do_test');

    class CategoryTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Category::deleteAll();
        //     Task::deleteAll();
        // }

        function testGetName()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $test_category = new Category($name);

            //Act
            $result = $test_category->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testGetid()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 11;
            $test_category = new Category($name, $id);

            //Act
            $result = $test_category->getId();

            //Assert
            $this->assertEquals($id, $result);
        }
    }

?>
