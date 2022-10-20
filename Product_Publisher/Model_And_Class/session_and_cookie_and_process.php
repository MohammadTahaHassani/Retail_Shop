<?php
    class SessionAndCookieAndProcessOnSessionAndCookie{
        public static function setAndStartSession(){
            $expires = 7 * 24 * 60 * 60;
            session_set_cookie_params($expires , "/");
            session_start();
        }

        public static function endAndDeleteSessionAndCookie(){
            $session_name = session_name();
            session_destroy();
            setcookie($session_name , "" , 0 , "/");
        }

        public static function setUserSessionAndCookie($user){
            $user_information_array = array("id" => $user->__get("user_id"),
                                        "user_name" => $user->__get("user_name"),
                                        "user_family" => $user->__get("user_family"),
                                        "user_phone" => $user->__get("user_phone"),
                                        "user_address" => $user->__get("user_address"),
                                        "user_username" => $user->__get("user_username"),
                                        "user_status_id" => $user->__get("user_status_id"));
            $_SESSION["user"] = $user_information_array;
        }
    }
?>