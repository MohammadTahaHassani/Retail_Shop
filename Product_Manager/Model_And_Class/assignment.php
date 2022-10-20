<?php
    class Assignment{
        private $assignment_id ,
                $assignment_description;

        public function __construct($assignment_id ,
                                    $assignment_description){
            $this->assignment_id = $assignment_id;
            $this->assignment_description = $assignment_description;
        }

        public function __set($element, $value){
            $this->$element = $value;
        }
        public function __get($element){
            return $this->$element;
        }
    }
?>