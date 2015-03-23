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

        function setName($new_description)
        {
            $this->description = (string) $new_description;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

    }

?>
