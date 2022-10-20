<?php
    class Database{
        private static $host = "localhost";
        private static $database = "Retail";
        private static $data_source_name;
        protected static function setDataSourceName(){
            self::$data_source_name = "mysql:host=".self::$host.";dbname=".self::$database;
            return self::$data_source_name;
        }
    }
    class ConnectToDatabase extends Database{
        private static $username = "root";
        private static $password = "";
        private static $connection;

        public static function getDatabase(){
            if(!isset(self::$connection)){
                try{
                    self::$connection = new PDO(self::setDataSourceName(),
                                                self::$username,
                                                self::$password);
                }catch(PDOException $error){
                    $error_message = $error->getMessage();
                    include("../View/error_logs.php");
                    exit;
                }
            }
            return self::$connection;
        }
    }
?>