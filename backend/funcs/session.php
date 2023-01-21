<?php

class SessionFunctions {
    public static function checkSession() : bool {
        if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            session_start();
            return true;
        }
        else {
            return true;
        }
    }

    public static function checkKey($key){
        SessionFunctions::checkSession();

        return $_SESSION[$key] ?? null;
    }

    public static function setKey($key, $value){
        SessionFunctions::checkSession();

        return $_SESSION[$key] = $value ?? false;
    }

    public static function destroy(){
        session_destroy();
        header("Location: ./login.php");
    }
}