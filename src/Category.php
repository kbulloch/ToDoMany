<?php

    class Category
    {
        private $name;
        private  $id;

        function __construct($new_name, $new_id = null)
        {
            $this->name = $new_name;
            $this->id = $new_id;
        }


    }

?>
