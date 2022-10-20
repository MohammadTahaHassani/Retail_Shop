<?php
    class ProcessOnProduct{
        public static function showProducts(){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Products";

            $result = $connection->query($query);     

            $products = array();

            foreach($result as $information){
                $product = new Product(
                                        ProcessOnCategory::getCategoryInformationByCategoryId($information["product_category_id"]),
                                        ProcessOnUser::getUserInformationByUserId($information["product_user_id"]),
                                        $information["product_name"],
                                        $information["product_city_published"],
                                        $information["product_image_1"],
                                        $information["product_image_2"],
                                        $information["product_image_3"],
                                        $information["product_subject"],
                                        $information["product_price"],
                                        $information["product_description"],
                                        $information["product_publish"],
                                        $information["product_status_id"]);
                $product->__set("product_id" , $information["product_id"]);

                $products[] = $product;
            }

            return $products;
        }

        public static function editStatus($product_id , $status_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "UPDATE Products
                        SET product_status_id = $status_id
                        WHERE product_id = $product_id";
            $connection->exec($query);
        }

        public static function searchProducts($search_text){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Products
                        WHERE
                        product_id LIKE '%$search_text%'
                        OR
                        product_name LIKE '%$search_text%'
                        OR
                        product_city_published LIKE '%$search_text%'
                        OR
                        product_subject LIKE '%$search_text%'
                        OR
                        product_description LIKE '%$search_text%'";

            $result = $connection->query($query);     

            $products = array();

            foreach($result as $information){
                $product = new Product(
                                        ProcessOnCategory::getCategoryInformationByCategoryId($information["product_category_id"]),
                                        ProcessOnUser::getUserInformationByUserId($information["product_user_id"]),
                                        $information["product_name"],
                                        $information["product_city_published"],
                                        $information["product_image_1"],
                                        $information["product_image_2"],
                                        $information["product_image_3"],
                                        $information["product_subject"],
                                        $information["product_price"],
                                        $information["product_description"],
                                        $information["product_publish"],
                                        $information["product_status_id"]);
                $product->__set("product_id" , $information["product_id"]);

                $products[] = $product;
            }

            return $products;
        }
    }
?>