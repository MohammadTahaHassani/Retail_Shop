<?php
    include("../../Product_Publisher/Model_And_Class/datebase.php");

    $connection = ConnectToDatabase::getDatabase();
    
    $query = "CREATE DATABASE Retail;
                USE Retail;
                CREATE TABLE Products(
                    product_id INT PRIMARY KEY AUTO_INCREMENT,
                    product_category_id INT NOT NULL,
                    product_user_id INT NOT NULL,
                    product_name VARCHAR(128) NOT NULL,
                    product_city_published VARCHAR(128) NOT NULL,
                    product_image_1 VARCHAR(128) NOT NULL,
                    product_image_2 VARCHAR(128) NOT NULL,
                    product_image_3 VARCHAR(128) NOT NULL,
                    product_subject VARCHAR(256) NOT NULL,
                    product_description TEXT NOT NULL,
                    product_status_id VARCHAR(128) NOT NULL DEFAULT 1,
                    product_publish DATE NOT NULL DEFAULT CURRENT_DATE
                );
                CREATE TABLE Categories(
                    category_id INT PRIMARY KEY AUTO_INCREMENT,
                    category_name VARCHAR(128) NOT NULL
                );
                CREATE TABLE Users(
                    user_id INT PRIMARY KEY AUTO_INCREMENT,
                    user_name VARCHAR(128) NOT NULL,
                    user_family VARCHAR(128) NOT NULL,
                    user_phone VARCHAR(128) NOT NULL,
                    user_address VARCHAR(128) NOT NULL,
                    user_username VARCHAR(128) NOT NULL,
                    user_password VARCHAR(128) NOT NULL,
                    user_status_id INT NOT NULL DEFAULT 1
                );
                CREATE TABLE Assignments(
                    assignment_id INT PRIMARY KEY NOT NULL,
                    assignment_description VARCHAR(128) NOT NULL
                );
                CREATE TABLE Publish(
                    publish_id INT PRIMARY KEY NOT NULL,
                    publish_description VARCHAR(128) NOT NULL
                );

                ALTER TABLE Products ADD FOREIGN KEY (product_status_id) REFERENCES Publish(publish_id);
                ALTER TABLE Products ADD FOREIGN KEY (product_category_id) REFERENCES Categories(category_id);
                ALTER TABLE Users ADD FOREIGN KEY (user_status_id) REFERENCES Assignments(assignment_id);";

    $connection->exec($query);
?>