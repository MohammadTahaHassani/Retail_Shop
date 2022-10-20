<?php
    class ProcessOnAssignment{
        public static function getAllAssignment(){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Assignments";
            $result = $connection->query($query);

            $assignments = array();
            foreach($result as $information){
                $assignment = new Assignment($information["assignment_id"],
                                    $information["assignment_description"]);
                $assignments[] = $assignment;
            }
            return $assignments;
        }
    }
?>