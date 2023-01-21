<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../load.php";

function goReturUrl($var = false){
    header("Location: https://proximitycsgo.com/user/register.php");
}

if (AuthFunction::cfun()->isLogged()) {
    goReturUrl();
    exit;
}

if (!$_POST["username"] || !$_POST["email"] || !$_POST["password"] || !$_POST["confirm-password"])
{
    goReturUrl();
    exit;
}

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$repassword = $_POST["confirm-password"];

if (strlen($username) < 3)
{
    SessionFunctions::setKey("register-error", "Minimum username lenght is  => 3");
    goReturUrl();
}

if (strlen($password) < 6)
{
    SessionFunctions::setKey("register-error", "Minimum password lenght is  => 6");
    goReturUrl();
}

if (strlen($email) < 5)
{
    SessionFunctions::setKey("register-error", "Use correct email address please!");
    goReturUrl();
}

if ($repassword != $password)
{
    SessionFunctions::setKey("register-error", "Password's does not match");
    goReturUrl();
}

$get_user = FFDatabase::cfun()->select("users")->where("username", $username)->run()->get();

if (!$get_user || $get_user != "no-record"){
    SessionFunctions::setKey("register-error", "User allready registered...");
    goReturUrl();
    exit;
}
if ($get_user == "no-record"){

    $isOK = false;

    $targetToken = "";

    {


        while ($isOK == false)
        {
            $characters = '0123456789abcdefghijklmnoprstuvyz';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 168; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $callResponse2 = FFDatabase::cfun()->select("users")->where("token", $randomString)->run()->get();


            if ($callResponse2 == "no-record") {
                $targetToken = $randomString;
                $isOK = true;
            }
            else if ($callResponse2 == false)
            {
                SessionFunctions::setKey("register-error", "Token generation error...");
                goReturUrl();
            }
        }
    }


    $get_user = FFDatabase::cfun()->insert("users", [["username", $username], ["password", $password], ["email", $email], ["token", $targetToken]])->run();

    if (!$get_user->x){
        SessionFunctions::setKey("register-error", "Invalid credentials - try again right now");
        goReturUrl();
        exit;
    }

    if (!is_array($get_user))
    {
        SessionFunctions::setKey("register-success", "Succesfully registered please login");
        goReturUrl(true);
        exit;
    }
    exit;
}
else{
    SessionFunctions::setKey("register-error", "Ivalid internal error occurred #q4w84e2s1dqw4e84qwe");
    goReturUrl();
    exit;
}




?>