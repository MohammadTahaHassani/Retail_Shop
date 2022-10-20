<?php
    class Database{
        protected static $host_name = "localhost";
        protected static $database_name = "Retail";

        public static function setDatabaseSourceName(){
            $database_source_name = "mysql:host=".self::$host_name.";dbname=".self::$database_name;
            return $database_source_name;
        }
    }
    class ConnectToDatabase extends Database{
        private static $username = "root";
        private static $password = "";
        private static $connection;
        public static function getDatabase(){
            if(!isset(self::$connection)){
                try{
                    self::$connection = new PDO(self::setDatabaseSourceName(),
                                                self::$username,
                                                self::$password);
                }catch(PDOExeption $error){
                    $error_message = $e->getMessage();
                    include("../View/error_logs.php");
                    exit;
                }
            }
            return self::$connection;
        }
    }
?>