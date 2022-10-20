<?php
    class ButtonAndPrcessOnButton{

        public static function setButton($buttons){
            foreach($buttons as $name => $url){
                self::getButton($name , $url);
            }
        }

        public static function getButton($name , $url){
            echo "<a href='$url'>$name</a><br>";
        }
    }
?>