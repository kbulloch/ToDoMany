<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once "src/Task.php";
    require_once "src/Category.php";

    $DB = new PDO('pgsql:host=localhost;dbname=to_do_test');

    class CategoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Category::deleteAll();
            Task::deleteAll();
        }

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

        function testGetId()
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

        function testSetName()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 123;
            $test_category = new Category($name, $id);

            //Act
            $test_category->setName("Mutants and Masterminds");

            //Assert
            $result = $test_category->getName();
            $this->assertEquals("Mutants and Masterminds", $result);
        }

        function testSetId()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 111;
            $test_category = new Category($name, $id);

            //Act
            $test_category->setId(777);

            //Assert
            $result = $test_category->getId();
            $this->assertEquals(777, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 14;
            $test_category = new Category($name, $id);
            $test_category->save();

            //Act
            $result = Category::getAll();

            //Assert
            $this->assertEquals($test_category, $result[0]);
        }

        function testSaveSetsId()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 14;
            $test_category = new Category($name, $id);

            //Act
            $test_category->save();

            //Assert
            $this->assertEquals(true, is_numeric($test_category->getId()));
        }

        function testGetAll()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 14;
            $test_category = new Category($name, $id);
            $test_category->save();

            $name2 = "Mermaids and Murders";
            $id2 = 99;
            $test_category2 = new Category($name2, $id2);
            $test_category2->save();

            //Act
            $result = Category::getAll();

            //Assert
            $this->assertEquals([$test_category, $test_category2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 14;
            $test_category = new Category($name, $id);
            $test_category->save();

            $name2 = "Mermaids and Murders";
            $id2 = 99;
            $test_category2 = new Category($name2, $id2);
            $test_category2->save();

            //Act
            Category::deleteAll();

            //Assert
            $result = Category::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 14;
            $test_category = new Category($name, $id);
            $test_category->save();

            $name2 = "Mermaids and Murders";
            $id2 = 99;
            $test_category2 = new Category($name2, $id2);
            $test_category2->save();

            //Act
            $result = Category::find($test_category->getId());

            //Assert
            $this->assertEquals($test_category, $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 14;
            $test_category = new Category($name, $id);
            $test_category->save();

            $new_name = "Software Development";

            //Act
            $test_category->update($new_name);

            //Assert
            $result = $test_category->getName();
            $this->assertEquals($new_name, $result);
        }

        function testAddTask()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 14;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Slay dragon";
            $id2 = 2;
            $test_task = new Task($description, $id2);
            $test_task->save();

            //Act
            $test_category->addTask($test_task);

            //Assert
            $this->assertEquals($test_category->getTasks(), [$test_task]);
        }

        function testGetTasks()
        {
            //Arrange
            $name = "Dungeons and Dragons";
            $id = 14;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Slay dragon";
            $id2 = 2;
            $test_task = new Task($description, $id2);
            $test_task->save();

            $description2 = "Get treasure";
            $id3 = 3;
            $test_task2 = new Task($description2, $id3);
            $test_task2->save();

            //Act
            $test_category->addTask($test_task);
            $test_category->addTask($test_task2);

            //Assert
            $this->assertEquals($test_category->getTasks(), [$test_task, $test_task2]);
        }

        function testDelete()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "File reports";
            $id2 = 2;
            $test_task = new Task($description, $id2);
            $test_task->save();

            //Act
            $test_category->addTask($test_task);
            $test_category->delete();

            //Assert
            $this->assertEquals([], $test_task->getCategories());
        }

    }

?>
