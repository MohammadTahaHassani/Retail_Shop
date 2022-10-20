<?php
    class ProcessOnCategory{
        public static function getCategoryInformationByCategoyId($category_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Categories
                        WHERE category_id = $category_id";
            $result = $connection->query($query); 
            $result = $result->fetch();

            $category = new Category($result["category_id"],
                                    $result["category_name"]);
            return $category;
        }

        public static function getCategories(){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Categories";
            $result = $connection->query($query);

            $categoris = array();

            foreach($result as $information){
                $category = new Category($information["category_id"],
                                        $information["category_name"]);
                $categoris[] = $category;
            }

            return $categoris;
        }
    }
?>