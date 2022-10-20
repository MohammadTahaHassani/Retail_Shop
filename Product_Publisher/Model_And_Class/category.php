<?php
    class Category{
        private $category_id ,
                $category_name;
        public function __construct($category_id ,
                                    $category_name){
            $this->category_id = $category_id;
            $this->category_name = $category_name;
        }

        public function __set($element, $value){
            $this->$element = $value;
        }
        public function __get($element){
            return $this->$element;
        }
    }
?>