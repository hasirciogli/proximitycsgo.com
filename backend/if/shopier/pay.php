<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
// example/index.php

use Shopier\Enums\ProductType;
use Shopier\Enums\WebsiteIndex;
use Shopier\Exceptions\NotRendererClassException;
use Shopier\Exceptions\RendererClassNotFoundException;
use Shopier\Exceptions\RequiredParameterException;
use Shopier\Models\Address;
use Shopier\Models\Buyer;
use Shopier\Renderers\AutoSubmitFormRenderer;
use Shopier\Renderers\IframeRenderer;
use Shopier\Renderers\ShopierButtonRenderer;
use Shopier\Shopier;

require_once $_SERVER["DOCUMENT_ROOT"] . '/backend/load.php';

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

function makePayment($username, $email, $user_uid, $day, $money){
    $shopier = new Shopier("babdc80a4c7504b1ab836805718857f5", "3f3fe0000d37b7c46d780339eda3f0bf");


    $result = FFDatabase::cfun()->insert("payments", [["status", 0],["day", $day], ["user_id", $user_uid]])->run();

    $payment_internal_id = $result->connection->lastInsertId();


    $buyer = new Buyer([
        'id' => $payment_internal_id,
        'name' => 'Proximity-user',
        'surname' => $username,
        'email' => $email,
        'phone' => "0005487899"
    ]);

    $address = new Address([
        'address' => 'null',
        'city' => 'null',
        'country' => 'null',
        'postcode' => 'null',
    ]);

    $params = $shopier->getParams();

    $params->setWebsiteIndex(WebsiteIndex::SITE_1);

    $params->setBuyer($buyer);

    $params->setAddress($address);

    $params->setOrderData($payment_internal_id, $money);

    $params->setProductData('Proximity CS:GO 30 day access', ProductType::DOWNLOADABLE_VIRTUAL);


    try {

        $renderer = new AutoSubmitFormRenderer($shopier);


        $shopier->goWith($renderer);

    } catch (RequiredParameterException $e) {

    } catch (NotRendererClassException $e) {

    } catch (RendererClassNotFoundException $e) {

    }
}