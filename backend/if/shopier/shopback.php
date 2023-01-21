<?php

var_dump($_POST);

use Shopier\Models\ShopierResponse;

require_once $_SERVER["DOCUMENT_ROOT"] . '/backend/load.php';
require $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

// $_POST içerisinde aşağıdaki şekilde veriler gelir
//[
//    'platform_order_id' => '10002',
//    'API_key' => '*****',
//    'status' => 'success',
//    'installment' => '0',
//    'payment_id' => '954344654',
//    'random_nr' => '123456',
//    'signature' => 'f3EjDlXoPICsKssHT9iv/5ddCXIwk1ZcItlYXDqyYHrNso=',
//];

$shopierResponse = ShopierResponse::fromPostData();

if (!$shopierResponse->hasValidSignature("3f3fe0000d37b7c46d780339eda3f0bf")) {
    //TODO: Ödeme başarılı değil, hata mesajı göster
    die('Ödemeniz alınamadı');
}

var_dump($_POST);

if ($_POST["status"] == "success")
{
    $res1 = FFDatabase::cfun()->select("payments")->where("id", $_POST["platform_order_id"])->run()->get();

    if ($res1["status"] == "0")
        SubsManager::cfun()->AddSubToUser($res1["user_id"], $res1["day"]);

    FFDatabase::cfun()->update("payments", [["status", 1]])->where("id", $_POST["platform_order_id"])->run();

    $res2 = FFDatabase::cfun()->select("payments")->where("id", $_POST["platform_order_id"])->run()->get();

    if ($res2["status"] == "0")
        SubsManager::cfun()->AddSubToUser($res2["user_id"], $res2["day"]);

    header("Location: ./../../../user/profile.php");
}
else{

}




print_r($shopierResponse->toArray());