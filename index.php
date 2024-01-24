<?php

require "../settings.php";
require "ozonApi.php";
require "db.php";
require "../func.php";

$ozon = new OzonApi(CLIENT_ID, API_KEY);

$getOrders = $ozon->getOrder();

_p($getOrders["result"]["postings"]);

$db = new Db();

_p((array)$db);

foreach($getOrders["result"]["postings"] as $order){
    $posting = json_encode($order['financial_data']['posting_services']);

    $financial = $order['financial_data'];
    unset($financial['posting_services']);
    $financial = json_encode($financial);

    foreach($order['products'] as $i => $prod){
        $products[$i]["price"] = $prod["price"];
        $products[$i]["offer_id"] = $prod["offer_id"];
        $products[$i]["quantity"] = $prod["quantity"];
    }
    $products = json_encode($products);

    // $analytics = json_encode($order['financial_data']['posting_services']);

    $query = "INSERT INTO orders (`order_id`,`products`,`analytics_data`,`financial_data`,`	posting_services`)
    VALUES ('{$oreder['order_id']}',{$oreder['products']},{$order['analytics_data']},{$order['financial_data']},{$posting})";
}