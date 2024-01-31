<?php

require "../settings.php";
require "ozonApi.php";
require "db.php";
require "../func.php";

$ozon = new OzonApi(CLIENT_ID, API_KEY);

$dateStart = "2023-12-01T00:00:11Z";
$dateEnd = "2024-01-24T00:00:11Z";

$getOrders = $ozon->getOrder($dateStart, $dateEnd);

// _p($getOrders["result"]["postings"]);

$db = new Db();

foreach($getOrders["result"]["postings"] as $order){
    $posting = json_encode($order['financial_data']['posting_services']);

    $financial = $order['financial_data'];
    unset($financial['posting_services']);
    $financial = json_encode($financial);

    $products = [];
    foreach($order['products'] as $i => $prod){
        $products[$i]["price"] = $prod["price"];
        $products[$i]["offer_id"] = $prod["offer_id"];
        $products[$i]["quantity"] = $prod["quantity"];
    }
    $products = json_encode($products);

    $analytics = json_encode($order['analytics_data']);

    $date = str_replace(array("T","Z"), " ", $order['in_process_at']) ;
    $date_create = date("Y-m-d H:i:s", strtotime(trim($date)));

    $query = "INSERT INTO orders (`order_id`,`date_create`,`products`,`analytics_data`,`financial_data`,`posting_services`)
    VALUES ('{$order['order_id']}','{$date_create}','{$products}','{$analytics}','{$financial}','{$posting}')";

    // $db->queryDB($query);
}