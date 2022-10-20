<?php 
    class ButtonAndProcessOnButton{
        public static function setButtonArray($button_array){
            foreach($button_array as $name => $url){
                self::showButton($url , $name);
            }
        }

        private static function showButton($url , $name){
            echo "<a href='$url'>$name</a> <br>";
        }

        public static function appendButton(&$buttons_array , $buttons){
            foreach($buttons as $name => $url){
                $buttons_array[$name] = $url;
            }
        }
    }
?>