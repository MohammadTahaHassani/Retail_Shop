<?php
    class ProcessOnProduct{
        public static function showProducts(){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Products";

            $result = $connection->query($query);     

            $products = array();

            foreach($result as $information){
                $product = new Product(
                                        ProcessOnCategory::getCategoryInformationByCategoyId($information["product_category_id"]),
                                        null,
                                        $information["product_name"],
                                        $information["product_city_published"],
                                        $information["product_image_1"],
                                        null,
                                        null,
                                        $information["product_subject"],
                                        $information["product_price"],
                                        null,
                                        $information["product_description"]);
                $product->__set("product_id" , $information["product_id"]);
                $product->__set("product_status_id" , $information["product_status_id"]);

                $products[] = $product;
            }

            return $products;
        }
        public static function showProductsDetail($product_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Products
                        WHERE product_id = $product_id";

            $result = $connection->query($query);  
            $result = $result->fetch(); 

            $category = ProcessOnCategory::getCategoryInformationByCategoyId($result["product_category_id"]);
            $user = ProcessOnUser::getUserInformationByUserId($result["product_user_id"]);

            $product = new Product($category,
                                    $user,
                                    $result["product_name"],
                                    $result["product_city_published"],
                                    $result["product_image_1"],
                                    $result["product_image_2"],
                                    $result["product_image_3"],
                                    $result["product_subject"],
                                    $result["product_price"],
                                    $result["product_description"]);
            $product->__set("product_id" , $result["product_id"]);

            return $product;
        }

        public static function showProductsByCategoryId($category_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Products
                        WHERE product_category_id = $category_id";

            $result = $connection->query($query);  

            $products = array();

            foreach($result as $information){
                $category = ProcessOnCategory::getCategoryInformationByCategoyId($information["product_category_id"]);
                $user = ProcessOnUser::getUserInformationByUserId($information["product_user_id"]);

                $product = new Product($category,
                                        $user,
                                        $information["product_name"],
                                        $information["product_city_published"],
                                        $information["product_image_1"],
                                        $information["product_image_2"],
                                        $information["product_image_3"],
                                        $information["product_subject"],
                                        $information["product_price"],
                                        $information["product_description"]);
                $product->__set("product_id" , $information["product_id"]);
                $product->__set("product_status_id" , $information["product_status_id"]);

                $products[] = $product;
            }

            return $products;
        }

        public static function addNewProduct($product){
            $connection = ConnectToDatabase::getDatabase();
            $product_category_id = $product->__get("product_category_information")->__get("category_id");
            $product_user_id = $product->__get("product_user_information")->__get("user_id");
            $product_name = $product->__get("product_name");
            $product_city_published = $product->__get("product_city_published");
            $product_image_1 = $product->__get("product_image_1");
            $product_image_2 = $product->__get("product_image_2");
            $product_image_3 = $product->__get("product_image_3");
            $product_subject = $product->__get("product_subject");
            $product_price = $product->__get("product_price");
            $product_description = $product->__get("product_description");
            

            $query = "INSERT INTO `Products`(`product_category_id`,
                            `product_user_id`,
                            `product_name`,
                            `product_city_published`,
                            `product_image_1`,
                            `product_image_2`,
                            `product_image_3`,
                            `product_subject`,
                            `product_description`,
                            `product_price`)
                        VALUES ('$product_category_id',
                                '$product_user_id',
                                '$product_name',
                                '$product_city_published',
                                '$product_image_1',
                                '$product_image_2',
                                '$product_image_3',
                                '$product_subject',
                                '$product_description',
                                '$product_price')";
            $connection->exec($query);
        }

        public static function getProductByUserId($user_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Products
                        WHERE product_user_id = $user_id";

            $result = $connection->query($query);  

            $products = array();

            foreach($result as $information){
                $category = ProcessOnCategory::getCategoryInformationByCategoyId($information["product_category_id"]);
                $user = ProcessOnUser::getUserInformationByUserId($information["product_user_id"]);

                $product = new Product($category,
                                        $user,
                                        $information["product_name"],
                                        $information["product_city_published"],
                                        $information["product_image_1"],
                                        $information["product_image_2"],
                                        $information["product_image_3"],
                                        $information["product_subject"],
                                        $information["product_price"],
                                        $information["product_description"]);
                $product->__set("product_id" , $information["product_id"]);
                $product->__set("product_status_id" , $information["product_status_id"]);

                $products[] = $product;
            }

            return $products;
        }

        public static function editProduct($product){
            $connection = ConnectToDatabase::getDatabase();

            $product_id = $product->__get("product_id");
            $product_category_id = $product->__get("product_category_information")->__get("category_id");
            $product_name = $product->__get("product_name");
            $product_city_published = $product->__get("product_city_published");
            $product_image_1 = $product->__get("product_image_1");
            $product_image_2 = $product->__get("product_image_2");
            $product_image_3 = $product->__get("product_image_3");
            $product_subject = $product->__get("product_subject");
            $product_price = $product->__get("product_price");
            $product_description = $product->__get("product_description");

            $query = "UPDATE Products SET
                        product_category_id ='$product_category_id',
                        product_name='$product_name',
                        product_city_published='$product_city_published',
                        product_image_1='$product_image_1',
                        product_image_2='$product_image_2',
                        product_image_3='$product_image_3',
                        product_subject='$product_subject',
                        product_description='$product_description',
                        product_price='$product_price'
                    WHERE product_id = '$product_id'";
            $connection->exec($query);
        }

        public static function deleteProduct($product_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "DELETE FROM Products
                        WHERE product_id = $product_id";
            $connection->exec($query);
        }

        public static function searchProduct($search_text){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Products
                    WHERE product_name LIKE '%$search_text%'
                        OR
                        product_subject LIKE '%$search_text%'
                        OR
                        product_description LIKE '%$search_text%'
                        OR
                        product_city_published LIKE '%$search_text%'";
                        
            $result = $connection->query($query);  

            $products = array();

            foreach($result as $information){
                $category = ProcessOnCategory::getCategoryInformationByCategoyId($information["product_category_id"]);
                $user = ProcessOnUser::getUserInformationByUserId($information["product_user_id"]);

                $product = new Product($category,
                                        $user,
                                        $information["product_name"],
                                        $information["product_city_published"],
                                        $information["product_image_1"],
                                        $information["product_image_2"],
                                        $information["product_image_3"],
                                        $information["product_subject"],
                                        $information["product_price"],
                                        $information["product_description"]);
                $product->__set("product_id" , $information["product_id"]);

                $products[] = $product;
            }

            return $products;
        }
    }
?>