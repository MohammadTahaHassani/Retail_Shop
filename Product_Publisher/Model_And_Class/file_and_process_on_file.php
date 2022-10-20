<?php
    class FileAndProcessOnFile{

        private static $file_array = array();
        private static $new_file_name;
        public static function uploadImage($files){
            for ($i=0; $i < 3; $i++) { 
                $file_name = $files["name"][$i];
                $file_source = $files["tmp_name"][$i];
                $file_target = "../../Images/$file_name";
                move_uploaded_file($file_source , $file_target);
                self::$file_array[] = $file_target;
            }
            return self::$file_array;
        }

        public static function uploadNewImage($file , $last_file){
            $file_name = $file["name"];
            $file_source = $file["tmp_name"];
            $file_destination = "../../Images/$file_name";
            move_uploaded_file($file_source , $file_destination);
            unlink($last_file);
            self::$new_file_name = $file_destination;
            return self::$new_file_name;
        }

        public static function deleteImages($images){
            foreach($images as $path){
                unlink($path);
            }
        }
    }
?>