<?php
    class ProcessOnCategory{
        public static function getCategoryInformationByCategoryId($category_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Categories
                        WHERE category_id = $category_id";
            $result = $connection->query($query); 
            $result = $result->fetch();

            $category = new Category($result["category_id"],
                                    $result["category_name"]);
            return $category;
        }

        public static function getAllCategories(){
            $connection = ConnectToDatabase::getDatabase();
    
                
            $query = "SELECT * FROM Categories";
            $result = $connection->query($query); 

            $categories = array();

            foreach($result as $information){
                $category = new Category($information["category_id"],
                                        $information["category_name"]);
                $categories[] = $category;
            }

            return $categories;

        }

        public static function addCategory($category_name){
            $connection = ConnectToDatabase::getDatabase();

            $query = "INSERT INTO Categories(category_name)
                        VALUES
                        ('$category_name')";
            $connection->exec($query);
        }
    }
?>