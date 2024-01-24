<?php

// require "settings.php";
require "ozonApi.php";
require "db.php";
require "func.php";

$ozon = new OzonApi("626516", "ca136e0a-de7b-4512-a15f-b763e682d9dd");

$getOrders = $ozon->getOrder();

_p($getOrders);