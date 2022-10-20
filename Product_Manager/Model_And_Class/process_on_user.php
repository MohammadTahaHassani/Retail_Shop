<?php
    class ProcessOnUser{
        public static function getUserInformationByUserId($user_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Users
                        WHERE user_id = $user_id";
            
            $result = $connection->query($query);

            $information = $result->fetch();

            $user = new User($information["user_name"],
                            $information["user_family"],
                            $information["user_phone"],
                            $information["user_address"],
                            $information["user_username"],
                            null);
            return $user;
        }

        public static function getAllUser(){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Users";

            $result = $connection->query($query);

            $users = array();

            foreach($result as $information){
                $user = new User($information["user_name"],
                                $information["user_family"],
                                $information["user_phone"],
                                $information["user_address"],
                                $information["user_username"],
                                null);
                $user->__set("user_id" , $information["user_id"]);
                $user->__set("user_status_id" , $information["user_status_id"]);
                $users[] = $user;
            }
            return $users;
        }

        public static function editUserStatus($user_id , $status){
            $connection = ConnectToDatabase::getDatabase();

            $query = "UPDATE Users
                SET user_status_id = $status
                WHERE user_id = $user_id";

            $connection->exec($query);
        }

        public static function searchUser($search_text){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Users
                        WHERE 
                        user_id LIKE '%$search_text%'
                        OR
                        user_name LIKE '%$search_text%'
                        OR
                        user_phone LIKE '%$search_text%'
                        OR
                        user_username LIKE '%$search_text%'";

            $result = $connection->query($query);

            $users = array();

            foreach($result as $information){
                $user = new User($information["user_name"],
                                $information["user_family"],
                                $information["user_phone"],
                                $information["user_address"],
                                $information["user_username"],
                                null);
                $user->__set("user_id" , $information["user_id"]);
                $user->__set("user_status_id" , $information["user_status_id"]);
                $users[] = $user;
            }
            return $users;
        }
    }
?>