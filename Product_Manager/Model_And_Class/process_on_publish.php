<?php
    class ProcessOnPublish{
        public static function getAllPublish(){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Publish";
            $result = $connection->query($query);

            $publishs = array();
            foreach($result as $information){
                $publish = new Publish($information["publish_id"],
                                    $information["publish_description"]);
                $publishs[] = $publish;
            }
            return $publishs;
        }
    }
?>