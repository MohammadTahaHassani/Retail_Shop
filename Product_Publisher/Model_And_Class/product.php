<?php
    class Product{
        private $product_id,
                $product_category_information,
                $product_user_information,
                $product_name,
                $product_city_published,
                $product_image_1,
                $product_image_2,
                $product_image_3,
                $product_subject,
                $product_price,
                $product_description,
                $product_status_id;

        public function __construct($product_category_information,
                                    $product_user_information,
                                    $product_name,
                                    $product_city_published,
                                    $product_image_1,
                                    $product_image_2,
                                    $product_image_3,
                                    $product_subject,
                                    $product_price,
                                    $product_description){
            $this->product_category_information = $product_category_information;
            $this->product_user_information = $product_user_information;
            $this->product_name = $product_name;
            $this->product_city_published = $product_city_published;
            $this->product_image_1 = $product_image_1;
            $this->product_image_2 = $product_image_2;
            $this->product_image_3 = $product_image_3;
            $this->product_subject = $product_subject;
            $this->product_price = $product_price;
            $this->product_description = $product_description;
        }

        public function __set($element, $value){
            $this->$element = $value;
        }
        public function __get($element){
            return $this->$element;
        }
    }
?>