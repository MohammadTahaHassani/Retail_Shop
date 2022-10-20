<?php
    class User{
        private $user_id,
                $user_name,
                $user_family,
                $user_phone,
                $user_address,
                $user_username,
                $user_password,
                $user_status_id;
        public function __construct($user_name,
                                    $user_family,
                                    $user_phone,
                                    $user_address,
                                    $user_username,
                                    $user_password){
                $this->user_name = $user_name;
                $this->user_family = $user_family;
                $this->user_phone = $user_phone;
                $this->user_address = $user_address;
                $this->user_username = $user_username;
                $this->user_password = $user_password;
            }
        public function __set($element, $value){
            $this->$element = $value;
        }
        public function __get($element){
            return $this->$element;
        }
    }
?>