<?php

    class Task
    {
        private $description;
        private $id;

        function __construct($new_description, $new_id = null)
        {
            $this->description = $new_description;
            $this->id = $new_id;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getId()
        {
            return $this->id;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO tasks (description) VALUES ('{$this->getDescription()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
            $tasks = [];
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $id = $task['id'];
                $new_task = new Task($description, $id);
                array_push($tasks, $new_task);
            }
            return $tasks;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM tasks *;");
        }

        static function find($search_id)
        {
            $found_task = null;
            $tasks = Task::getAll();
            foreach($tasks as $task) {
                $task_id = $task->getId();
                if ($task_id == $search_id){
                    $found_task = $task;
                }
            }
            return $found_task;
        }

        function update($new_description)
        {
            $GLOBALS['DB']->exec("UPDATE tasks SET description = '{$new_description}' WHERE id = {$this->getId()};");
            $this->setDescription($new_description);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM tasks WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM categories_tasks WHERE task_id = {$this->getId()};");
        }

        function addCategory($new_category)
        {
            //checks to make sure category does not already exist
            //to avoid creating duplicate categories in database
            $existing_category = Category::findByName($new_category->getName());

            if($existing_category == null){
                $new_category->save();
                $GLOBALS['DB']->exec("INSERT INTO categories_tasks (category_id, task_id) VALUES ({$new_category->getId()}, {$this->getId()});");
            }
            else {
                $GLOBALS['DB']->exec("INSERT INTO categories_tasks (category_id, task_id) VALUES ({$existing_category->getId()}, {$this->getId()});");
            }
        }

        function getCategories()
        {
            //select * from cats where task_id = this one
            $query = $GLOBALS['DB']->query("SELECT category_id FROM categories_tasks WHERE task_id = {$this->getId()};");
            $category_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $categories = [];
            foreach($category_ids as $id) {
                $my_category_id = $id['category_id'];
                $result = $GLOBALS['DB']->query("SELECT * FROM categories WHERE id = {$my_category_id};");
                $returned_category = $result->fetchAll(PDO::FETCH_ASSOC);

                $my_name = $returned_category[0]['name'];
                $my_id = $returned_category[0]['id'];
                $new_category = new Category($my_name, $my_id);
                array_push($categories, $new_category);
            }
            return $categories;
        }
    }








?>
