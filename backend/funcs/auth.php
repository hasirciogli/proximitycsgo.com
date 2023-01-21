<?php

class AuthFunction{
    public function isLogged() : bool {
        if (!SessionFunctions::checkSession())
            return false;

        if(!SessionFunctions::checkKey("isLogged"))
            return false;
        else
            return true;
    }

    public function isBanned() : bool {
        if (!SessionFunctions::checkSession())
            return false;

        if(!SessionFunctions::checkKey("isLogged"))
            return false;
        else
        {
            $user = $this->getAuthedUser();

            if ($user)
                return $user["user_status"] == "0" ? true : false;
            else
                return false;
        }
    }

    public function getAuthedUser() : array | bool {
        if (!SessionFunctions::checkSession())
            return false;

        if(!SessionFunctions::checkKey("isLogged") || !SessionFunctions::checkKey("uid"))
            return false;
        else
        {
            $uid = SessionFunctions::checkKey("uid");

            $result = FFDatabase::cfun()->select("users")->where("id", $uid)->run()->get();

            if(!$result)
                return false;
            else if ($result == "ro-record")
                return false;
            else return $result;
        }
    }

    public function getUser($uid) : array | bool
    {
        $result = FFDatabase::cfun()->select("users")->where("id", $uid)->run()->get();

        if (!$result)
            return false;
        else if ($result == "ro-record")
            return false;
        else return $result;
    }

    public static function cfun() : AuthFunction {
        return new AuthFunction();
    }
}