<?php

require "./../backend/load.php";

$day = $_GET["day"] ?? header("Location: ./../");

switch ($day){
    case "30":
        require "../backend/if/shopier/pay.php";

        $user = AuthFunction::cfun()->getAuthedUser();

        if (!$user)
            header("Location: ./../");

        $basement_money = 83.69;

        $bindirme = ($basement_money * 3.1) / 100 + 2;

        makePayment($user["username"], $user["email"], $user["id"],30, $basement_money + $bindirme);
        break;

    case "700":
        require "../backend/if/shopier/pay.php";

        $user = AuthFunction::cfun()->getAuthedUser();

        if (!$user)
            header("Location: ./../");

        $basement_money = 700;

        $bindirme = ($basement_money * 3.1) / 100 + 2;

        makePayment($user["username"], $user["email"], $user["id"],700, $basement_money + $bindirme);
        break;

    case "1200":
        require "../backend/if/shopier/pay.php";

        $user = AuthFunction::cfun()->getAuthedUser();

        if (!$user)
            header("Location: ./../");

        $basement_money = 1200;

        $bindirme = ($basement_money * 3.1) / 100 + 2;

        makePayment($user["username"], $user["email"], $user["id"],1200, $basement_money + $bindirme);
        break;
    default:
        header("Location: ./../");
        break;
}