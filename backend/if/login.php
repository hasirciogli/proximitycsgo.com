<?php

include "../load.php";

if (AuthFunction::cfun()->isLogged()) {
    header("Location: https://proximitycsgo.com/user/login.php");
    exit;
}

if (!$_POST["username"] || !$_POST["password"])
{
    header("Location: https://proximitycsgo.com/user/login.php");
    exit;
}

$username = $_POST["username"];
$password = $_POST["password"];

$get_user = FFDatabase::cfun()->select("users")->where("username", $username)->where("password", $password)->run()->get();

if (!$get_user || $get_user == "no-record"){
    SessionFunctions::setKey("login-error", "Invalid credentials - try again right now");
    header("Location: https://proximitycsgo.com/user/login.php");
    exit;
}

if (!is_array($get_user))
{
    SessionFunctions::setKey("login-error", "Invalid Library error #6484dw1");
    header("Location: https://proximitycsgo.com/user/login.php");
    exit;
}

SessionFunctions::setKey("isLogged", true);
SessionFunctions::setKey("uid", $get_user["id"]);
header("Location: https://proximitycsgo.com/user/login.php");

?>