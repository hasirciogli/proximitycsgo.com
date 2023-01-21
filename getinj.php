<?php

include $_SERVER["DOCUMENT_ROOT"] . "/backend/load.php";

if(!AuthFunction::cfun()->isLogged())
{
    header("Location: ./user/login.php");
    exit;
}


$file = $_SERVER["DOCUMENT_ROOT"] . "/___loaderdata___/pLoader.exe";


function randomName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}

$cheat = randomName(20);
header('Content-type: application/x-dosexec');
header('Content-Disposition: attachment; filename="'.$cheat.'".exe"');
readfile($file);

header("Location: ./user/profile.php");


?>