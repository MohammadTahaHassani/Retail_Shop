<?php
    class ProcessOnUser{
        public static function getUserInformationByUserId($user_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Users
                        WHERE user_id = $user_id";
            $result = $connection->query($query);
            $result = $result->fetch(); 

            $user = new User($result["user_name"],
                            $result["user_family"],
                            $result["user_phone"],
                            $result["user_address"],
                            $result["user_username"],
                            $result["user_password"]);
            $user->__set("user_id" , $result["user_id"]);
            $user->__set("user_status_id" , $result["user_status_id"]);

            return $user;
        }

        public static function validateUser($username){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Users
                        WHERE user_username = '$username'";
            $result = $connection->query($query);
            $information = $result->fetch();
            if(!empty($information)){
                $user = new User($information["user_name"],
                                $information["user_family"],
                                $information["user_phone"],
                                $information["user_address"],
                                $information["user_username"],
                                $information["user_password"]);
                $user->__set("user_id" , $information["user_id"]);
                $user->__set("user_status_id" , $information["user_status_id"]);
                return $user;
            }
        }

        public static function checkForExistUsername($username){
            $connection = ConnectToDatabase::getDatabase();
            $query = "SELECT * FROM Users
                        WHERE user_username = '$username'";
            $result = $connection->query($query);
            $result = $result->fetch();

            if(!empty($result)){
                return false;
            }
            return true;

        }

        public static function addNewUser($user){
            $connection = ConnectToDatabase::getDatabase();

            $user_name = $user->__get("user_name");
            $user_family = $user->__get("user_family");
            $user_phone = $user->__get("user_phone");
            $user_address = $user->__get("user_address");
            $user_username = $user->__get("user_username");
            $user_password = $user->__get("user_password");

            $query = "INSERT INTO `Users`(user_name,
                                user_family,
                                user_phone,
                                user_address,
                                user_username,
                                user_password) 
                        VALUES ('$user_name',
                                    '$user_family',
                                    '$user_phone',
                                    '$user_address',
                                    '$user_username',
                                    '$user_password')";
            $connection->exec($query);
        }

        public static function editUserInformation($user , $user_id){
            $connection = ConnectToDatabase::getDatabase();

            $user_name = $user->__get("user_name");
            $user_family = $user->__get("user_family");
            $user_phone = $user->__get("user_phone");
            $user_address = $user->__get("user_address");
            $user_username = $user->__get("user_username");

            $query = "UPDATE `Users` SET 
                    user_name ='$user_name',
                    user_family='$user_family',
                    user_phone='$user_phone',
                    user_address='$user_address',
                    user_username='$user_username'
                    WHERE user_id = $user_id";

            $connection->exec($query);
        }

        public static function validateUserByOtherWay($username , $phone){
            $connection = ConnectToDatabase::getDatabase();
            $query = "SELECT * FROM Users
                        WHERE user_username = '$username'
                        AND
                        user_phone = '$phone'";
            $result = $connection->query($query);
            $result = $result->fetch();
            if(empty($result)){
                return false;
            }
            return $result["user_id"];
        }

        public static function changePassword($user_id , $user_password){
            $connection = ConnectToDatabase::getDatabase();

            $query = "UPDATE Users
                        SET user_password = '$user_password'
                        WHERE user_id = '$user_id'";

            $connection->exec($query);
        }
    }
?>