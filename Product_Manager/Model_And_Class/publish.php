<?php
    class Publish{
        private $publish_id ,
                $publish_description;

        public function __construct($publish_id ,
                                    $publish_description){
            $this->publish_id = $publish_id;
            $this->publish_description = $publish_description;
        }

        public function __set($element, $value){
            $this->$element = $value;
        }
        public function __get($element){
            return $this->$element;
        }
    }
?>