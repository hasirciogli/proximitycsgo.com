<?php

class SubsManager
{
    public function GetSubsStatus() : array {
        if (!AuthFunction::cfun()->getAuthedUser())
        {
            header("./exit.php");
            exit;
        }

        $user = AuthFunction::cfun()->getAuthedUser() ?? header("./exit.php");

        date_default_timezone_set('Europe/Istanbul');

        //if ($user["username"] == "admin")
        //    return [true, 999999, "<span class='font-bold'>it will never end :)</span>"];

        if (!$user["subs_till"])
        {
            return [false, 0];
        }
        else{
            date_default_timezone_set('Europe/Istanbul');

            $baslangicTarihi = strtotime(date("y-m-d"));

            $bitisTarihi = strtotime($user["subs_till"]);

            $tday = ($bitisTarihi - $baslangicTarihi) / 86400;

            $fark = $tday >= 1 ? floor($tday) : number_format($tday, 2, '.', ',');

            if ($fark > 0)
                return [true, $fark, $user["subs_till"]];
            else
                return [false, 0, ""];
        }
    }

    public function AddSubToUser($uid, $day) : array {

        $user = AuthFunction::cfun()->getUser($uid) ?? header("./exit.php");

        date_default_timezone_set('Europe/Istanbul');

        //if ($user["username"] == "admin")
        //    return [true, 999999, "<span class='font-bold'>it will never end :)</span>"];

        if (!$user["subs_till"])
        {
            $newDate = date('Y-m-d H:i:s' , strtotime($day. ' day', strtotime(date("Y-m-d H:i:s"))));
            FFDatabase::cfun()->update("users", [["subs_till", $newDate]])->where("id", $uid)->run();
            return [true, $day, $newDate];
        }
        else{
            date_default_timezone_set('Europe/Istanbul');

            $baslangicTarihi = strtotime(date("y-m-d"));

            $bitisTarihi = strtotime($user["subs_till"]);

            $tday = ($bitisTarihi - $baslangicTarihi) / 86400;

            $fark = $tday >= 1 ? floor($tday) : number_format($tday, 2, '.', ',');

            if ($fark > 0)
            {
                $newDate = date('Y-m-d H:i:s' , strtotime($day. ' day', strtotime($user["subs_till"])));
                FFDatabase::cfun()->update("users", [["subs_till", $newDate]])->where("id", $uid)->run();
                return [true, $day, $newDate];
            }
            else
            {
                $newDate = date('Y-m-d H:i:s' , strtotime($day. ' day', strtotime(date("Y-m-d H:i:s"))));
                FFDatabase::cfun()->update("users", [["subs_till", $newDate]])->where("id", $uid)->run();
                return [true, $day, $newDate];
            }
        }
    }

    public static function cfun() : SubsManager {
        return new SubsManager();
    }
}